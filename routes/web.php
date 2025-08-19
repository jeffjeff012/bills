<?php

use App\Livewire\Bills;
use App\Livewire\BillShow;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Admin\UserManagement;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\BillsAccess;
use App\Http\Controllers\BillController;

// Root URL shows welcome page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::redirect('/', '/login')->name('home');


Route::get('/bills/{bill}', BillShow::class)->name('bills.show');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

//Redirecting admin and sbstaff to their respective dashboard
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('admin.dashboard');

Route::get('staff/dashboard', [StaffController::class, 'dashboard'])
    ->middleware(['auth', 'verified']) // optional: add 'sbstaff' middleware if needed
    ->name('staff.dashboard');

Route::middleware(['auth', BillsAccess::class])
    ->get('/bills', Bills::class)
    ->name('bills.index');

//Active and Inactive Bills Handler
Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('inactive-bills', [DashboardController::class, 'inactiveBills'])
    ->middleware(['auth', 'verified'])
    ->name('inactive-bills');

// Restrict Access for Sbstaff and Admin in Active and Inactive Bills
Route::middleware(['auth', 'verified', \App\Http\Middleware\UserAccess::class])
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('inactive-bills', [DashboardController::class, 'inactiveBills'])->name('inactive-bills');
    });

Route::middleware(['auth', 'admin'])->group(function () {
    //Notes Route
    Route::get('notes', Bills::class)->name('notes');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth'])->group(function () {
    //Bills Route
    // Route::get('bills', Bills::class)->name('bills');
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

//Routes for redirecting users and admin to comment
Route::get('/bill/{bill}', [BlogController::class, 'show'])->name('bill');
Route::get('/inactive-blog/{note}', [BlogController::class, 'showInactive'])
    ->name('inactive-blog');

Route::middleware(['auth', 'verified', 'admin']) // apply admin middleware here
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Admin dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // User management
        Route::get('/user-management', UserManagement::class)->name('user-management');
    });

Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');
// Route::post('/bills/{bill}/like', [BillController::class, 'like'])->name('bills.like');
// Route::post('/bills/{bill}/comments', [CommentController::class, 'store'])->name('bills.comments.store');

//Facebook Legend
Route::get('/auth/facebook', [FacebookController::class, 'facebookpage']);
Route::get('/auth/facebook/callback', [FacebookController::class, 'facebookredirect']);
Route::view('/facebook-legend/privacy-policy', 'facebook-legend.privacy-policy')->name('privacy.policy');
Route::view('/facebook-legend/data-deletion', 'facebook-legend.data-deletion')->name('data.deletion');

//Google Legend
Route::get("auth/google", [GoogleController:: class, "redirectToGoogle"])->name("redirect.google");
Route::get("auth/google/callback", [GoogleController:: class, "handleGoogleCallback"]);

require __DIR__ . '/auth.php';
