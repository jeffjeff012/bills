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

Route::get('/notes/{note}', NoteShow::class)->name('notes.show');

Route::get('', function () {
    return view('welcome');
})->name('home');

Route::view('admin/dashboard', 'admin.dashboard', [
    'userCount' => 0, //User::count(),
        'noteCount' => 0, //Note::count(),
        'totalLikes' => 0, //Note::sum('likes'),
        'totalDislikes' => 0, //Note::sum('dislikes'),
])->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

Route::get('staff/dashboard', function () {
    return view('staff.dashboard', [
        'userCount' => 0, //User::count(),
        'noteCount' => 0, //Note::count(),
        'totalLikes' => 0, //Note::sum('likes'),
        'totalDislikes' => 0, //Note::sum('dislikes'),
    ]);
})->name('staff.dashboard');


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

// Route::middleware(['auth', 'verified']) // optional role check middleware here
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
//         Route::get('/user-management', UserManagement::class)->name('user-management');
//     });

Route::get('/auth/facebook', [FacebookController::class, 'facebookpage']);
Route::get('/auth/facebook/callback', [FacebookController::class, 'facebookredirect']);

require __DIR__ . '/auth.php';
