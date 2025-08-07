<?php

use App\Models\Note;
use App\Livewire\Notes;
use App\Livewire\NoteShow;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserController as ControllersUserController;
use App\Models\User;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Carbon;
use App\Http\Controllers\DashboardController;
use App\Livewire\Admin\UserManagement;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;


Route::get('/notes/{note}', NoteShow::class)->name('notes.show');

Route::get('', function () {
    return view('welcome');
})->name('home');

//Redirecting admin and sbstaff to their respective dashboard
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('admin.dashboard');

Route::get('staff/dashboard', [StaffController::class, 'dashboard'])
    ->middleware(['auth', 'verified']) // optional: add 'sbstaff' middleware if needed
    ->name('staff.dashboard');

//Active and Inactive Bills Handler
Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('inactive-bills', [DashboardController::class, 'inactiveBills'])
    ->middleware(['auth', 'verified'])
    ->name('inactive-bills');


Route::middleware(['auth', 'admin'])->group(function () {
    //Notes Route
    Route::get('notes', Notes::class)->name('notes');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth'])->group(function () {
    //Notes Route
    Route::get('notes', Notes::class)->name('notes');
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

//Routes for redirecting users and admin to comment
Route::get('/blog/{note}', [BlogController::class, 'show'])->name('blog');
Route::get('/inactive-blog/{note}', [BlogController::class, 'showInactive'])
    ->name('inactive-blog');

Route::middleware(['auth', 'verified']) // optional role check middleware here
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/user-management', UserManagement::class)->name('user-management');
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
