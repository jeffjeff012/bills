<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;


class NoteLikeDislike extends Component
{
    public Note $note;
    public $userVote;

    public function mount(Note $note)
    {
        $this->note = $note;
        $existingVote = Like::where('user_id', Auth::id())->where('note_id', $note->id)->first();
        $this->userVote = $existingVote ? ($existingVote->like ? 'like' : 'dislike') : null;
    }

    public function like()
    {
        $vote = Like::firstOrNew([
            'user_id' => Auth::id(),
            'note_id' => $this->note->id,
        ]);

        if ($vote->exists && $vote->like) {
            $vote->delete();
            $this->note->decrement('likes');
            $this->userVote = null;
        } else {
            if ($vote->exists && !$vote->like) {
                $this->note->decrement('dislikes');
            }

            $vote->like = true;
            $vote->save();

            $this->note->increment('likes');
            $this->userVote = 'like';
        }

        $this->note->refresh();
    }

    public function dislike()
    {
        $vote = Like::firstOrNew([
            'user_id' => Auth::id(),
            'note_id' => $this->note->id,
        ]);

        if ($vote->exists && !$vote->like) {
            $vote->delete();
            $this->note->decrement('dislikes');
            $this->userVote = null;
        } else {
            if ($vote->exists && $vote->like) {
                $this->note->decrement('likes');
            }

            $vote->like = false;
            $vote->save();

            $this->note->increment('dislikes');
            $this->userVote = 'dislike';
        }

        $this->note->refresh();
    }

    public function render()
    {
        return view('livewire.note-like-dislike');
    }
}
