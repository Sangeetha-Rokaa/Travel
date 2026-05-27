<?php

use Illuminate\Support\Facades\Route;

// ═══════════════════════════════════════════════════════════════════════════════
//  FRONTEND CONTROLLERS
// ═══════════════════════════════════════════════════════════════════════════════

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\DestinationController;
use App\Http\Controllers\Frontend\TrekController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\TestimonialController;

// ═══════════════════════════════════════════════════════════════════════════════
//  FRONTEND ROUTES
// ═══════════════════════════════════════════════════════════════════════════════

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Destinations
Route::get('/destinations',        [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

// Treks
Route::get('/treks',        [TrekController::class, 'index'])->name('treks.index');
Route::get('/treks/{slug}', [TrekController::class, 'show'])->name('treks.show');

// Packages
Route::get('/packages',        [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [PackageController::class, 'show'])->name('packages.show');

// About
Route::get('/about-us', [AboutController::class, 'index'])->name('about.index');

// Contact
Route::get('/contact',  [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Booking
Route::get('/book',  [BookingController::class, 'create'])->name('bookings.create');
Route::post('/book', [BookingController::class, 'store'])->name('bookings.store');

// Testimonials
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

// ═══════════════════════════════════════════════════════════════════════════════
//  ADMIN CONTROLLERS
// ═══════════════════════════════════════════════════════════════════════════════

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\EmailSettingController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\TrekController as AdminTrekController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

// ═══════════════════════════════════════════════════════════════════════════════
//  ADMIN — AUTH (unauthenticated)
// ═══════════════════════════════════════════════════════════════════════════════

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// ═══════════════════════════════════════════════════════════════════════════════
//  ADMIN — PROTECTED (auth middleware)
// ═══════════════════════════════════════════════════════════════════════════════

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/',               [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart-data');

    // Destinations CRUD
    Route::resource('destinations', AdminDestinationController::class);

    // Treks CRUD
    Route::resource('treks', AdminTrekController::class);
    Route::post('/treks/{trek}/remove-image',         [AdminTrekController::class, 'removeImage'])->name('treks.remove-image');
    Route::post('/treks/{trek}/remove-gallery-image', [AdminTrekController::class, 'removeGalleryImage'])->name('treks.remove-gallery-image');

    // Packages CRUD
    Route::resource('packages', AdminPackageController::class)->except(['show']);
    Route::post('/packages/{package}/remove-image',         [AdminPackageController::class, 'removeImage'])->name('packages.remove-image');
    Route::post('/packages/{package}/remove-gallery-image', [AdminPackageController::class, 'removeGalleryImage'])->name('packages.remove-gallery-image');

    // Contacts
    Route::get('contacts',                      [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}',            [AdminContactController::class, 'show'])->name('contacts.show');
    Route::patch('contacts/{contact}/status',   [AdminContactController::class, 'updateStatus'])->name('contacts.updateStatus');
    Route::delete('contacts/{contact}',         [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Testimonials CRUD
    Route::resource('testimonials', AdminTestimonialController::class);

    // Bookings
    Route::get('/bookings',                           [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/export/csv',                [AdminBookingController::class, 'export'])->name('bookings.export');
    Route::get('/bookings/stats',                     [AdminBookingController::class, 'stats'])->name('bookings.stats');
    Route::get('/bookings/{booking}',                 [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/edit',            [AdminBookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}',                 [AdminBookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}',              [AdminBookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings/{booking}/confirm',        [AdminBookingController::class, 'confirm'])->name('bookings.confirm');
    Route::post('/bookings/{booking}/cancel',         [AdminBookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/{booking}/payment',        [AdminBookingController::class, 'markPayment'])->name('bookings.mark-payment');
    Route::post('/bookings/{booking}/complete',       [AdminBookingController::class, 'complete'])->name('bookings.complete');

    // Settings
    Route::get('/settings',  [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Email Settings
    Route::get('/email-settings',                      [EmailSettingController::class, 'index'])->name('email.index');
    Route::get('/email-settings/create',               [EmailSettingController::class, 'create'])->name('email.create');
    Route::post('/email-settings',                     [EmailSettingController::class, 'store'])->name('email.store');
    Route::get('/email-settings/{emailSetting}/edit',  [EmailSettingController::class, 'edit'])->name('email.edit');
    Route::put('/email-settings/{emailSetting}',       [EmailSettingController::class, 'update'])->name('email.update');
    Route::delete('/email-settings/{emailSetting}',    [EmailSettingController::class, 'destroy'])->name('email.delete');
});
