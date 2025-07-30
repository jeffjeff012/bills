<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $notes = Note::where(function ($query) {
                $query->whereNull('due_date')
                      ->orWhereDate('due_date', '>=', Carbon::today());
            })
            ->withCount('comments')
            ->latest()
            ->get();

        return view('dashboard', compact('notes'));
    }

    public function inactiveBills()
    {
        $notes = Note::whereDate('due_date', '<', Carbon::today())
            ->latest()
            ->get();

        return view('inactive-bills', compact('notes'));
    }
}
