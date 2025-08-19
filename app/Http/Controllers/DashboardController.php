<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $bills = Bill::where(function ($query) {
                $query->whereNull('due_date')
                      ->orWhereDate('due_date', '>=', Carbon::today());
            })
            ->withCount('comments')
            ->latest()
            ->get();

        return view('dashboard', compact('bills'));
    }

    public function inactiveBills()
    {
        $notes = Bill::whereDate('due_date', '<', Carbon::today())
            ->latest()
            ->get();

        return view('inactive-bills', compact('notes'));
    }
}
