<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Bill;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Count of users
        $userCount = Schema::hasTable('users') ? User::count() : 0;

        // Count of bills
        $billCount = Schema::hasTable('bills') ? Bill::count() : 0;

        // Get all bills with likes/dislikes counts
        $bills = Bill::withCount([
            'likes as likes_count',
            'dislikes as dislikes_count'
        ])->get();

        // Total likes and dislikes across all bills
        $totalLikes = $bills->sum('likes_count');
        $totalDislikes = $bills->sum('dislikes_count');

        // Get the bill with the most likes (Hot Bill)
        $hotBill = Bill::withCount('likes')
            ->orderByDesc('likes_count')
            ->first();

        // Get the bill with the most comments (Most Commented Bill)
        $mostCommentedBill = Bill::withCount('comments')
            ->orderByDesc('comments_count')
            ->first();

        // Pass all data to the dashboard view
        return view('admin.dashboard', compact(
            'userCount',
            'billCount',
            'totalLikes',
            'totalDislikes',
            'bills',
            'hotBill',
            'mostCommentedBill'
        ));
    }
}