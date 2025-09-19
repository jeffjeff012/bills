<?php

use App\Livewire\Bills;
use App\Livewire\EditBill;
use App\Livewire\CreateBill;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ActivityLogs;
use App\Livewire\Admin\UserManagement;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\DashboardController;

// Root URL shows welcome page
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('staff/dashboard', [StaffController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('staff.dashboard');

// For Users: Route and Middleware
Route::middleware(['auth', 'verified', 'user'])
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('inactive-bills', [DashboardController::class, 'inactiveBills'])->name('inactive-bills');
        Route::get('/inactive-blog/{bill}', [BlogController::class, 'showInactive'])
            ->name('inactive-blog');
    });

// Route::middleware(['auth', 'admin'])->group(function () {
//     // //Notes Route
//     // Route::get('notes', Bills::class)->name('notes');
//     Route::get('settings/password', Password::class)->name('settings.password');
//     Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/bill/{bill}', [BlogController::class, 'show'])->name('bill');

    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    Route::prefix('admin')->name('admin.')->group(function () {
        // Admin dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        // User management
        Route::get('/user-management', UserManagement::class)->name('user-management');
        // Activity Logs
        Route::get('/activity-logs', ActivityLogs::class)->name('activity.logs');
    });
});

//hybrid means middleware for admin and sbstaff
Route::middleware(['auth', 'verified', 'hybrid'])->group(function () {
    Route::get('/report-of-bills', Bills::class)->name('report-of-bills');

    Route::name('bills.')->group(function () {
        Route::get('/bills', [AdminController::class, 'viewDetails'])->name('index');
        Route::get('/bills/create', CreateBill::class)->name('create');
        Route::get('/bills/{bill}/edit', EditBill::class)->name('edit');
    });
});

// Public view and routes, no need middleware
Route::controller(BillController::class)
    ->name('bills.')
    ->group(function () {
        Route::get('/other-bills', 'otherBills')->name('other');
        Route::get('/bills/{bill}', 'show')->name('show');
    });

//Facebook Legend
Route::get('/auth/facebook', [FacebookController::class, 'facebookpage']);
Route::get('/auth/facebook/callback', [FacebookController::class, 'facebookredirect']);
Route::view('/facebook-legend/privacy-policy', 'facebook-legend.privacy-policy')->name('privacy.policy');
Route::view('/facebook-legend/data-deletion', 'facebook-legend.data-deletion')->name('data.deletion');

//Google Legend
Route::get("auth/google", [GoogleController:: class, "redirectToGoogle"])->name("redirect.google");
Route::get("auth/google/callback", [GoogleController:: class, "handleGoogleCallback"]);

require __DIR__ . '/auth.php';
