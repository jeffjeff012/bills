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

Route::get('/notes/{note}', NoteShow::class)->name('notes.show');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    $notes = Note::withCount('comments')->latest()->get();

    return view('dashboard', compact('notes'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::view('admin/dashboard', 'admin.dashboard', [
    'userCount' => \App\Models\User::count(),
    'noteCount' => Note::count(),
])->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

Route::get('staff/dashboard',  function () {
    return view('staff.dashboard', [
        'userCount' => \App\Models\User::count(),
        'noteCount' => \App\Models\Note::count(),
    ]);
})->name('staff.dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    //Notes Route
    Route::get('notes', Notes::class)->name('notes');
    Route::get('settings/password', Password::class)->name('settings.password');
    // Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});
// Route::middleware(['auth', 'verified', 'admin'])
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
//         Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
//         Route::get('/notes', Notes::class)->name('notes');
//     });


Route::middleware(['auth'])->group(function () {
    //Notes Route
    Route::get('notes', Notes::class)->name('notes');
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    // Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/blog/{note}', [BlogController::class, 'show'])->name('blog');

Route::get('auth/facebook', [FacebookController::class, 'facebookpage']);

Route::get('auth/facebook/callback', [FacebookController::class, 'facebookredirect']);

require __DIR__ . '/auth.php';
