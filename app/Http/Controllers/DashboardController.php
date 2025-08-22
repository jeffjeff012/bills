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
              ->orWhereDate('due_date', '>=', Carbon::today()); // include today as active
    })
    ->withCount('comments')
    ->latest()
    ->get();


        return view('dashboard', compact('bills'));
    }

    public function inactiveBills()
    {
        $bills = Bill::whereDate('due_date', '<', Carbon::today()) // strictly before today
        ->latest()
        ->get();

        return view('inactive-bills', compact('bills'));
    }
}
