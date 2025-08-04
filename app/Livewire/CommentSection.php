<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;
use App\Models\Comment;
use Livewire\WithPagination;

class CommentSection extends Component
{
    use WithPagination;
    
    public $note;
    public $content;

    public $editingCommentId = null;
    public $editedContent = '';

    public $confirmingCommentDeletion = false;
    public $commentToDelete = null;

    protected $paginationTheme = 'tailwind'; 

    public function mount(Note $note)
    {
        $this->note = $note;
    }

    public function submitComment()
    {
        $this->validate([
            'content' => 'required|string|max:500',
        ]);

        $this->note->comments()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        session()->flash('success', 'Comment posted.');

        $this->content = '';
    }

    public function startEditing($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $this->editingCommentId = $commentId;
        $this->editedContent = $comment->content;
    }

    public function updateComment()
    {
        $comment = Comment::findOrFail($this->editingCommentId);

        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $this->validate([
            'editedContent' => 'required|string|max:500',
        ]);

        $comment->update([
            'content' => $this->editedContent,
        ]);

        session()->flash('success', 'Comment updated.');

        $this->editingCommentId = null;
        $this->editedContent = '';
    }

    public function confirmCommentDeletion($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $this->confirmingCommentDeletion = true;
        $this->commentToDelete = $commentId;
    }

    public function deleteComment()
    {
        $comment = Comment::findOrFail($this->commentToDelete);

        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        session()->flash('success', 'Comment deleted.');

        $this->confirmingCommentDeletion = false;
        $this->commentToDelete = null;
    }

    public function render()
    {
         return view('livewire.comment-section', [
            'comments' => $this->note
                ->comments()
                ->with('user')
                ->latest()
                ->paginate(2), // or paginate() with a number
        ]);
}
}
