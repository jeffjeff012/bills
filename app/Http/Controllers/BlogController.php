<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class BlogController extends Controller
{
   public function show(Note $note)
    {  
        $note->loadCount('comments');
        return view('blog', compact('note'));
    }

    public function showInactive(Note $note)
    {
        $note->load(['comments.user']);
        return view('inactive-blog', compact('note'));
    }

}
