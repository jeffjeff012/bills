<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Bill;

class StaffController extends Controller
{
   public function dashboard()
    {

        $user = auth()->user();

        // Redirect Admin if they try to access Staff dashboard
        if ($user->role === \App\Enums\UserRole::Admin) {
            return redirect()->route('admin.dashboard');
        }

        $users = User::all();
        
        $userCount = Schema::hasTable('users') ? User::count() : 0;
        $billCount = Schema::hasTable('bills') ? Bill::count() : 0;

        // Get total likes and dislikes by summing the counts
        $bills = Bill::withCount(['likes as likes_count', 'dislikes as dislikes_count'])->get();

        $bills = Bill::withCount(['likes as likes_count'])->get();
        $totalLikes = $bills->sum('likes_count');
        $totalDislikes = $bills->sum('dislikes_count');
            
        $totalLikes = $bills->sum('likes_count');
        $totalDislikes = $bills->sum('dislikes_count');

        return view('staff.dashboard', compact(
            'userCount',
            'billCount',
            'totalLikes',
            'totalDislikes',
            'bills',
            'users'
        ));
    }
}
