<?php

use Illuminate\Support\Facades\Route;

// ═══════════════════════════════════════════════════════════════════════════════
//  FRONTEND ROUTES
// ═══════════════════════════════════════════════════════════════════════════════

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\DestinationController;
use App\Http\Controllers\Frontend\TrekController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\BookingController;


// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Destinations
Route::prefix('destinations')->name('destinations.')->group(function () {
    Route::get('/',         [DestinationController::class, 'index'])->name('index');
    Route::get('/{destination}', [DestinationController::class, 'show'])->name('show');
});
Route::get('/destinations', [DestinationController::class, 'index'])
    ->name('destinations.index');

Route::get('/destinations/{slug}', [DestinationController::class, 'show'])
    ->name('destinations.show');

// Treks  (under Destinations dropdown in nav)
Route::prefix('treks')->name('treks.')->group(function () {
    Route::get('/',       [TrekController::class, 'index'])->name('index');
    Route::get('/{trek}', [TrekController::class, 'show'])->name('show');
});
Route::get('/treks', [TrekController::class, 'index'])
    ->name('treks.index');

Route::get('/treks/{slug}', [TrekController::class, 'show'])
    ->name('treks.show');

// Packages  (under Destinations dropdown in nav)
Route::prefix('packages')->name('packages.')->group(function () {
    Route::get('/',           [PackageController::class, 'index'])->name('index');
    Route::get('/{package}',  [PackageController::class, 'show'])->name('show');
});

Route::get('/booking', function () {
    return view('frontend.booking');
})->name('booking.index');
Route::get('/book',  [BookingController::class, 'create'])->name('booking.create');
Route::post('/book', [BookingController::class, 'store'])->name('booking.store');

// About
Route::get('/about-us', [AboutController::class, 'index'])->name('about.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact
Route::get('/contact',       [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact',      [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');


// ═══════════════════════════════════════════════════════════════════════════════
//  ADMIN ROUTES  —  protected by 'auth' + 'verified' middleware
// ═══════════════════════════════════════════════════════════════════════════════


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\TrekController as AdminTrekController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

/*
|--------------------------------------------------------------------------
| ADMIN AUTH (NO MIDDLEWARE)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});


/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // DESTINATIONS CRUD

        // List
        Route::get('/destinations', [AdminDestinationController::class, 'index'])
            ->name('destinations.index');

        // Create Form
        Route::get('/destinations/create', [AdminDestinationController::class, 'create'])
            ->name('destinations.create');

        // Store
        Route::post('/destinations', [AdminDestinationController::class, 'store'])
            ->name('destinations.store');

        // Edit Form
        Route::get('/destinations/{id}/edit', [AdminDestinationController::class, 'edit'])
            ->name('destinations.edit');

        // Update
        Route::put('/destinations/{id}', [AdminDestinationController::class, 'update'])
            ->name('destinations.update');

        // Delete
        Route::delete('/destinations/{id}', [AdminDestinationController::class, 'destroy'])
            ->name('destinations.destroy');
        Route::get('/destinations/{id}', [AdminDestinationController::class, 'show'])
            ->name('destinations.show');
    });
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/chart-data', [App\Http\Controllers\Admin\DashboardController::class, 'chartData'])->name('dashboard.chart-data');


        // Destinations CRUD


        // Treks CRUD
        Route::resource('treks', AdminTrekController::class);
        // ->except(['show']);

        // Packages CRUD
        Route::resource('packages', AdminPackageController::class)
            ->except(['show']);
        Route::post('/packages/{package}/remove-image', [AdminPackageController::class, 'removeImage'])
            ->name('admin.packages.remove-image');
        Route::post('/packages/{package}/remove-gallery-image', [AdminPackageController::class, 'removeGalleryImage'])
            ->name('admin.packages.remove-gallery-image');

        // Contacts
        Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
        Route::patch('contacts/{contact}/status', [AdminContactController::class, 'updateStatus'])->name('contacts.updateStatus');
        Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

        // Testimonials
        Route::resource('testimonials', AdminTestimonialController::class)
            ->except(['show']);

        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
        Route::get('/bookings/{booking}/edit', [AdminBookingController::class, 'edit'])->name('bookings.edit');
        Route::put('/bookings/{booking}', [AdminBookingController::class, 'update'])->name('bookings.update');
        Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

        // Custom booking actions
        Route::post('/bookings/{booking}/confirm', [AdminBookingController::class, 'confirm'])->name('bookings.confirm');
        Route::post('/bookings/{booking}/cancel', [AdminBookingController::class, 'cancel'])->name('bookings.cancel');
        Route::post('/bookings/{booking}/payment', [AdminBookingController::class, 'markPayment'])->name('bookings.mark-payment');
        Route::post('/bookings/{booking}/complete', [AdminBookingController::class, 'complete'])->name('bookings.complete');

        // Export and stats
        Route::get('/bookings/export/csv', [AdminBookingController::class, 'export'])->name('bookings.export');
        Route::get('/bookings/stats', [AdminBookingController::class, 'stats'])->name('bookings.stats');
    });
