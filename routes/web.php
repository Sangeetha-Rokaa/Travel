<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TrekController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Destinations
Route::get('/destinations',          [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}',   [DestinationController::class, 'show'])->name('destinations.show');

// Treks
Route::get('/treks',                 [TrekController::class, 'index'])->name('treks.index');
Route::get('/treks/{slug}',          [TrekController::class, 'show'])->name('treks.show');

// Packages
Route::get('/packages',              [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}',       [PackageController::class, 'show'])->name('packages.show');





// About
Route::get('/about',                 [AboutController::class, 'index'])->name('about');

// Contact
Route::get('/contact',               [ContactController::class, 'index'])->name('contact');
Route::post('/contact',              [ContactController::class, 'send'])->name('contact.send');

// Booking
Route::get('/booking/{slug}',        [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking',              [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success',       [BookingController::class, 'success'])->name('booking.success');