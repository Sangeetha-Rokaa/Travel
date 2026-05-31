<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(string $slug)
    {
        $packages = HomeController::packagesData();
        $treks    = HomeController::treksData();

        $item = collect($packages)->firstWhere('slug', $slug)
             ?? collect($treks)->firstWhere('slug', $slug);

        abort_if(!$item, 404);

        return view('booking.create', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:100',
            'email'     => 'required|email',
            'phone'     => 'required|string|max:20',
            'package'   => 'required|string',
        ]);

        // Save to DB or send mail here

        return redirect()->route('booking.success')
                         ->with('booking', $request->all());
    }

    public function success()
    {
        return view('booking.success');
    }
}