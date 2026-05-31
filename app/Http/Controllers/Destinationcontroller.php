<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;


class DestinationController extends Controller
{
    public function index()
    {
        $destinations = HomeController::destinationsData();
        return view('destinations.index', compact('destinations'));
    }

    public function show(string $slug)
    {
        $destinations = HomeController::destinationsData();
        $destination  = collect($destinations)->firstWhere('slug', $slug);

        abort_if(!$destination, 404);

        return view('destinations.show', compact('destination', 'destinations'));
    }
}