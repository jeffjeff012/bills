<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bill;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;


class NoteLikeDislike extends Component
{
    public Bill $bill;
    public $userVote;

    public function mount(Bill $bill)
    {
        $this->bill = $bill;
        $existingVote = Like::where('user_id', Auth::id())->where('bill_id', $bill->id)->first();
        $this->userVote = $existingVote ? ($existingVote->like ? 'like' : 'dislike') : null;
    }

    public function like()
    {
        $vote = Like::firstOrNew([
            'user_id' => Auth::id(),
            'bill_id' => $this->bill->id,
        ]);

        if ($vote->exists && $vote->like) {
            $vote->delete();
            $this->bill->decrement('likes');
            $this->userVote = null;
        } else {
            if ($vote->exists && !$vote->like) {
                $this->bill->decrement('dislikes');
            }

            $vote->like = true;
            $vote->save();

            $this->bill->increment('likes');
            $this->userVote = 'like';
        }

        $this->bill->refresh();
    }

    public function dislike()
    {
        $vote = Like::firstOrNew([
            'user_id' => Auth::id(),
            'bill_id' => $this->bill->id,
        ]);

        if ($vote->exists && !$vote->like) {
            $vote->delete();
            $this->bill->decrement('dislikes');
            $this->userVote = null;
        } else {
            if ($vote->exists && $vote->like) {
                $this->bill->decrement('likes');
            }

            $vote->like = false;
            $vote->save();

            $this->bill->increment('dislikes');
            $this->userVote = 'dislike';
        }

        $this->bill->refresh();
    }

    public function render()
    {
        return view('livewire.note-like-dislike');
    }
}
