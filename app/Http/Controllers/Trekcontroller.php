<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;


class TrekController extends Controller
{
    public function index()
    {
        $treks = HomeController::treksData();
        return view('treks.index', compact('treks'));
    }

    public function show(string $slug)
    {
        $treks = HomeController::treksData();
        $trek  = collect($treks)->firstWhere('slug', $slug);

        abort_if(!$trek, 404);

        return view('treks.show', compact('trek', 'treks'));
    }
}