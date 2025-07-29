<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        // Optionally eager-load the current user's vote to color the buttons initially
        $userVotes = NoteVote::where('user_id', Auth::id())->get()->keyBy('note_id');
        return view('dashboard', compact('notes', 'userVotes'));
    }

    public function like(Note $note)
    {
        $userId = Auth::id();
        $vote = NoteVote::where('note_id', $note->id)->where('user_id', $userId)->first();

        if ($vote && $vote->vote === 'like') {
            // User clicked like again -> undo like
            $note->decrement('likes');
            $vote->delete();
            $liked = false;
            $disliked = false;
        } elseif ($vote && $vote->vote === 'dislike') {
            // Switch from dislike to like
            $note->decrement('dislikes');
            $note->increment('likes');
            $vote->update(['vote' => 'like']);
            $liked = true;
            $disliked = false;
        } else {
            // No prior vote -> add like
            $note->increment('likes');
            NoteVote::create([
                'note_id' => $note->id,
                'user_id' => $userId,
                'vote'    => 'like',
            ]);
            $liked = true;
            $disliked = false;
        }

        return response()->json([
            'likes'     => $note->likes,
            'dislikes'  => $note->dislikes,
            'liked'     => $liked,
            'disliked'  => $disliked,
        ]);
    }

    public function dislike(Note $note)
    {
        $userId = Auth::id();
        $vote = NoteVote::where('note_id', $note->id)->where('user_id', $userId)->first();

        if ($vote && $vote->vote === 'dislike') {
            // User clicked dislike again -> undo dislike
            $note->decrement('dislikes');
            $vote->delete();
            $liked = false;
            $disliked = false;
        } elseif ($vote && $vote->vote === 'like') {
            // Switch from like to dislike
            $note->decrement('likes');
            $note->increment('dislikes');
            $vote->update(['vote' => 'dislike']);
            $liked = false;
            $disliked = true;
        } else {
            // No prior vote -> add dislike
            $note->increment('dislikes');
            NoteVote::create([
                'note_id' => $note->id,
                'user_id' => $userId,
                'vote'    => 'dislike',
            ]);
            $liked = false;
            $disliked = true;
        }

        return response()->json([
            'likes'     => $note->likes,
            'dislikes'  => $note->dislikes,
            'liked'     => $liked,
            'disliked'  => $disliked,
        ]);
    }
}
