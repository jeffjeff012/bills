<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Bill $bill)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->bill_id = $bill->id;
        $comment->user_id = auth()->id(); // If you have authentication
        $comment->save();

        return redirect()->route('bills.show', $bill->id)
                        ->with('success', 'Comment added successfully!');
    }
}