<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bill;
use App\Models\Like;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $notes = Bill::with('creator')->get(); // fetch all notes with creator
        return view('user.post', compact('notes'));
    }

    public function dashboard()
    {
        $userCount = User::count();
        $billCount = Bill::count();

        // Sum all likes and dislikes from bills
        $likes_count = Like::where('like', true)->count();
        $dislikes_count = Like::where('like', false)->count();

        return view('admin.dashboard', compact(
            'userCount',
            'billCount',
            'likes_count',
            'dislikes_count'
        ));
    }
}
