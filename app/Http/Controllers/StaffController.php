<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Bill;

class StaffController extends Controller
{
    public $selectedBill;

    public function viewBill($billId)
    {
        $this->selectedBill = Bill::with('comments', 'likes')->findOrFail($billId);
    }

    public function viewDetails()
    {
        

        $bills = Bill::with('comments')->get();
        return view('view-details', compact('bills'));
    }

    public function showBillDetails(Bill $bill)
    {
        // Load comments associated with this bill
        $bill->load('comments.user');

        return view('view-details', compact('bill'));
    }

    public function dashboard()
    {
        $user = auth()->user();

        // Redirect Admin if they try to access Staff dashboard
        if ($user->role === \App\Enums\UserRole::Admin) {
            return redirect()->route('admin.dashboard');
        }

        $users = User::paginate(5);
        
        $userCount = Schema::hasTable('users') ? User::count() : 0;
        $billCount = Schema::hasTable('bills') ? Bill::count() : 0;

        $bills = Bill::withCount(['likes as likes_count', 'dislikes as dislikes_count'])
            ->paginate(5)   
            ->withQueryString();

        $totalLikes = Bill::withCount('likes')->get()->sum('likes_count');
        $totalDislikes = Bill::withCount('dislikes')->get()->sum('dislikes_count');

        // Get the bill with the most likes (Hot Bill)
        $hotBill = Bill::withCount('likes')
            ->orderByDesc('likes_count')
            ->first();

        // Get the bill with the most comments (Most Commented Bill)
        $mostCommentedBill = Bill::withCount('comments')
            ->orderByDesc('comments_count')
            ->first();

        return view('staff.dashboard', compact(
            'userCount',
            'billCount',
            'totalLikes',
            'totalDislikes',
            'bills',
            'users',
            'hotBill',
            'mostCommentedBill'
        ));
    }

}
