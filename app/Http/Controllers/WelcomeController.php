<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get the bill with the most likes (Hot Bill)
        $hotBill = Bill::withCount('likes')
            ->orderByDesc('likes_count')
            ->first();

        // Get the bill with the most comments (Most Commented Bill)
        $mostCommentedBill = Bill::withCount('comments')
            ->orderByDesc('comments_count')
            ->first();

        // You can add more data if needed for the welcome page
        $totalBills = Bill::count();
        
        // Pass data to the welcome view
        return view('welcome', compact(
            'hotBill',
            'mostCommentedBill',
            'totalBills'
        ));
    }
}