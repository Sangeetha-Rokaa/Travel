<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Destination;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now       = Carbon::now();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // ── Stat cards ────────────────────────────────────────────────────────

        $totalBookings   = Booking::count();
        $totalRevenue    = Booking::where('status', '!=', 'cancelled')->sum('total_price');
        $totalUsers      = User::count();
        $totalEnquiries  = Contact::count();

        // Month-over-month growth (%)
        $bookingsThisMonth = Booking::where('created_at', '>=', $thisMonth)->count();
        $bookingsLastMonth = Booking::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();
        $bookingsGrowth    = $bookingsLastMonth > 0
            ? round((($bookingsThisMonth - $bookingsLastMonth) / $bookingsLastMonth) * 100, 1)
            : 0;

        $revenueThisMonth = Booking::where('created_at', '>=', $thisMonth)
            ->where('status', '!=', 'cancelled')->sum('total_price');
        $revenueLastMonth = Booking::whereBetween('created_at', [$lastMonth, $lastMonthEnd])
            ->where('status', '!=', 'cancelled')->sum('total_price');
        $revenueGrowth    = $revenueLastMonth > 0
            ? round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100, 1)
            : 0;

        $usersThisMonth = User::where('created_at', '>=', $thisMonth)->count();
        $usersLastMonth = User::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();
        $usersGrowth    = $usersLastMonth > 0
            ? round((($usersThisMonth - $usersLastMonth) / $usersLastMonth) * 100, 1)
            : 0;

        $enquiriesThisMonth = Contact::where('created_at', '>=', $thisMonth)->count();
        $enquiriesLastMonth = Contact::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();
        $enquiriesGrowth    = $enquiriesLastMonth > 0
            ? round((($enquiriesThisMonth - $enquiriesLastMonth) / $enquiriesLastMonth) * 100, 1)
            : 0;

        // ── Bookings by status (donut) ────────────────────────────────────────

        $bookingsByStatus = Booking::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Ensure all keys exist with defaults
        $bookingsByStatus = array_merge(
            ['confirmed' => 0, 'pending' => 0, 'cancelled' => 0, 'completed' => 0],
            array_change_key_case($bookingsByStatus, CASE_LOWER)
        );

        // ── Chart data: last 30 days grouped by date ─────────────────────────

        $start = $now->copy()->subDays(29)->startOfDay();

        $bookingRows = Booking::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', $start)
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        $revenueRows = Booking::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->where('created_at', '>=', $start)
            ->where('status', '!=', 'cancelled')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        // Build full 30-day series (fill 0 for missing days)
        $chartLabels      = [];
        $bookingsChartData = [];
        $revenueChartData  = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i)->format('Y-m-d');
            $label = $now->copy()->subDays($i)->format('M j');
            $chartLabels[]       = $label;
            $bookingsChartData[] = (int) ($bookingRows[$date] ?? 0);
            $revenueChartData[]  = (float) ($revenueRows[$date] ?? 0);
        }

        // ── Top destinations ──────────────────────────────────────────────────

        $topDestinations = DB::table('destinations')
            ->join('treks', 'treks.destination_id', '=', 'destinations.id')
            ->join('bookings', 'bookings.trek_id', '=', 'treks.id')
            ->select(
                'destinations.id',
                'destinations.name',
                DB::raw('COUNT(bookings.id) as bookings_count')
            )
            ->groupBy('destinations.id', 'destinations.name')
            ->orderByDesc('bookings_count')
            ->limit(5)
            ->get();

        // Fallback: if Destination doesn't have a bookings() relation,
        // you can replace with a raw query like:
        // DB::table('destinations')
        //     ->join('bookings', 'bookings.destination_id', '=', 'destinations.id')
        //     ->selectRaw('destinations.name, COUNT(bookings.id) as bookings_count')
        //     ->groupBy('destinations.id', 'destinations.name')
        //     ->orderByDesc('bookings_count')
        //     ->limit(5)
        //     ->get();

        // ── Recent bookings ───────────────────────────────────────────────────

        $recentBookings = Booking::with(['user', 'package', 'trek'])
            ->latest()
            ->limit(4)
            ->get();

        // ── Date range label (topbar) ─────────────────────────────────────────

        $dateRangeLabel = $start->format('M j') . ' – ' . $now->format('M j, Y');

        return view('admin.dashboard.index', compact(
            'totalBookings',
            'totalRevenue',
            'totalUsers',
            'totalEnquiries',
            'bookingsGrowth',
            'revenueGrowth',
            'usersGrowth',
            'enquiriesGrowth',
            'bookingsByStatus',
            'chartLabels',
            'bookingsChartData',
            'revenueChartData',
            'topDestinations',
            'recentBookings',
            'dateRangeLabel'
        ));
    }
}
