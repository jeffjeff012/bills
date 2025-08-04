<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bill;


class UserController extends Controller
{
    public function index()
    {
        $note = Note::with('creator')->findOrFail($id);
        $notes = Note::all(); // or paginate() if needed
        return view('user.post', compact('notes'));
    }

 

    public function dashboard()
    {
        $userCount = User::count();
        $billCount = Bill::count();
        $totalLikes = Note::sum('likes');
        $totalDislikes = Note::sum('dislikes');

        return view('admin.dashboard', compact('userCount', 'billCount', 'totalLikes', 'totalDislikes'));
    }

   

}
