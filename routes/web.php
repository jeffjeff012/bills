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

Route::get('/notes/{note}', NoteShow::class)->name('notes.show');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    $notes = Note::where(function ($query) {
            $query->whereNull('due_date')
                  ->orWhereDate('due_date', '>=', Carbon::today());
        })
        ->withCount('comments')
        ->latest()
        ->get();

    return view('dashboard', compact('notes'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('inactive-bills', function () {
    $notes = \App\Models\Note::whereDate('due_date', '<', Carbon::today())
        ->latest()
        ->get();

    return view('inactive-bills', compact('notes'));
})->middleware(['auth', 'verified'])->name('inactive-bills');



Route::view('admin/dashboard', 'admin.dashboard', [
    'userCount' => User::count(),
    'noteCount' => Note::count(),
    'totalLikes' => Note::sum('likes'),
    'totalDislikes' => Note::sum('dislikes'),
])->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

Route::get('staff/dashboard', function () {
    return view('staff.dashboard', [
        'userCount' => User::count(),
        'noteCount' => Note::count(),
        'totalLikes' => Note::sum('likes'),
        'totalDislikes' => Note::sum('dislikes'),
    ]);
})->name('staff.dashboard');

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


Route::get('/auth/facebook', [FacebookController::class, 'facebookpage']);
Route::get('/auth/facebook/callback', [FacebookController::class, 'facebookredirect']);

require __DIR__ . '/auth.php';
