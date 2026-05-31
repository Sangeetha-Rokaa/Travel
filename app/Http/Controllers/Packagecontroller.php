<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;

class PackageController extends Controller
{
    public function index()
    {
        $packages = app(HomeController::class)->packagesData();

        return view('packages.index', compact('packages'));
    }

    public function show(string $slug)
    {
        $packages = app(HomeController::class)->packagesData();

        $package = collect($packages)->firstWhere('slug', $slug);

        abort_if(!$package, 404);

        return view('packages.show', compact('package'));
    }
}
