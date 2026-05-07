<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trek;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Contact;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats for cards
        $treksCount = Trek::count();
        $treksActiveCount = Trek::where('is_active', true)->count();
        $treksInactiveCount = Trek::where('is_active', false)->count();
        $treksActivePercentage = $treksCount > 0 ? ($treksActiveCount / $treksCount) * 100 : 0;

        $destinationsCount = Destination::count();
        $destinationsActiveCount = Destination::where('is_active', true)->count();
        $destinationsInactiveCount = Destination::where('is_active', false)->count();
        $destinationsActivePercentage = $destinationsCount > 0 ? ($destinationsActiveCount / $destinationsCount) * 100 : 0;

        $packagesCount = Package::count();
        $packagesActiveCount = Package::where('is_active', true)->count();
        $packagesInactiveCount = Package::where('is_active', false)->count();
        $packagesActivePercentage = $packagesCount > 0 ? ($packagesActiveCount / $packagesCount) * 100 : 0;

        $inquiriesCount = Contact::count();
        $unreadInquiries = Contact::where('is_read', false)->count();
        $readInquiries = Contact::where('is_read', true)->count();
        $inquiriesUnreadPercentage = $inquiriesCount > 0 ? ($unreadInquiries / $inquiriesCount) * 100 : 0;

        // Monthly data for charts
        $monthlyTreksData = Trek::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyInquiriesData = Contact::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Fill missing months with 0
        $monthlyTreks = [];
        $monthlyInquiries = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyTreks[] = $monthlyTreksData[$i] ?? 0;
            $monthlyInquiries[] = $monthlyInquiriesData[$i] ?? 0;
        }

        // Region distribution for treks
        $regionStats = Trek::select('difficulty', DB::raw('COUNT(*) as count'))
            ->groupBy('difficulty')
            ->get();

        $regionLabels = $regionStats->pluck('difficulty')->toArray();
        $regionData = $regionStats->pluck('count')->toArray();

        // Recent activities (combine recent creations)
        $recentTreks = Trek::latest()->take(3)->get()->map(function ($trek) {
            return [
                'title' => 'New Trek Added',
                'description' => $trek->name,
                'time' => $trek->created_at->diffForHumans(),
                'icon' => 'fas fa-hiking',
                'color' => '#0ea5e9'
            ];
        });

        $recentDestinations = Destination::latest()->take(3)->get()->map(function ($destination) {
            return [
                'title' => 'New Destination Added',
                'description' => $destination->name,
                'time' => $destination->created_at->diffForHumans(),
                'icon' => 'fas fa-map-marker-alt',
                'color' => '#10b981'
            ];
        });

        $recentContacts = Contact::latest()->take(3)->get()->map(function ($contact) {
            return [
                'title' => 'New Inquiry',
                'description' => 'From: ' . $contact->name . ' - ' . $contact->subject,
                'time' => $contact->created_at->diffForHumans(),
                'icon' => 'fas fa-envelope',
                'color' => '#f59e0b'
            ];
        });

        $recentActivities = $recentTreks->concat($recentDestinations)->concat($recentContacts)
            ->sortByDesc('time')
            ->take(10);

        // Recent inquiries for sidebar
        $recentInquiries = Contact::latest()->take(5)->get();

        // Additional stats
        $todayBookings = Booking::whereDate('created_at', today())->count();
        $activeUsers = \App\Models\User::where('is_active', true)->count();

        return view('admin.dashboard.index', compact(
            'treksCount',
            'treksActiveCount',
            'treksInactiveCount',
            'treksActivePercentage',
            'destinationsCount',
            'destinationsActiveCount',
            'destinationsInactiveCount',
            'destinationsActivePercentage',
            'packagesCount',
            'packagesActiveCount',
            'packagesInactiveCount',
            'packagesActivePercentage',
            'inquiriesCount',
            'unreadInquiries',
            'readInquiries',
            'inquiriesUnreadPercentage',
            'monthlyTreks',
            'monthlyInquiries',
            'regionLabels',
            'regionData',
            'recentActivities',
            'recentInquiries',
            'todayBookings',
            'activeUsers'
        ));
    }

    public function chartData(Request $request)
    {
        $year = $request->get('year', date('Y'));

        $treks = Trek::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $inquiries = Contact::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $treksData = [];
        $inquiriesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $treksData[] = $treks[$i] ?? 0;
            $inquiriesData[] = $inquiries[$i] ?? 0;
        }

        return response()->json([
            'treks' => $treksData,
            'inquiries' => $inquiriesData
        ]);
    }
}
