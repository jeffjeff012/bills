<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CommentSection extends Component
{
    use WithPagination;
    
    public $bill;
    public $content;
    public $readonly = false;

    public $editingCommentId = null;
    public $editedContent = '';

    public $confirmingCommentDeletion = false;
    public $commentToDelete = null;

    protected $paginationTheme = 'tailwind'; 

    public function mount(Bill $bill)
    {
        $this->bill = $bill;
    }

    public function submitComment()
    {
        $this->validate([
            'content' => 'required|string|max:500',
        ]);

        $this->bill->comments()->create([
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

        // Restrict edit if more than 5 minutes have passed
        if ($comment->created_at->diffInMinutes(now()) > 5) {
            session()->flash('error', 'You can only edit your comment within 5 minutes of posting.');
            return;
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

        // Restrict edit if more than 5 minutes have passed
        if ($comment->created_at->diffInMinutes(now()) > 5) {
            session()->flash('error', 'Editing time has expired. You can only edit within 5 minutes.');
            $this->editingCommentId = null;
            $this->editedContent = '';
            return;
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

        $this->authorize("delete", $comment);

        // Restrict delete if more than 5 minutes have passed
        if ($comment->created_at->diffInMinutes(now()) > 5) {
            session()->flash('error', 'You can only delete your comment within 5 minutes of posting.');
            return;
        }

        $this->confirmingCommentDeletion = true;
        $this->commentToDelete = $commentId;
    }

    public function deleteComment()
    {
        $comment = Comment::findOrFail($this->commentToDelete);

        $this->authorize("delete", $comment);

        // Restrict delete if more than 5 minutes have passed
        if ($comment->created_at->diffInMinutes(now()) > 5) {
            session()->flash('error', 'Deleting time has expired. You can only delete within 5 minutes.');
            $this->confirmingCommentDeletion = false;
            $this->commentToDelete = null;
            return;
        }

        $comment->delete();

        session()->flash('success', 'Comment deleted.');

        $this->confirmingCommentDeletion = false;
        $this->commentToDelete = null;
    }

    public function toggleHide($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        $user = auth()->user();
        $role = is_object($user->role) && property_exists($user->role, 'value')
            ? $user->role->value
            : $user->role;

        // Allow only staff/admin
        if (in_array($role, ['sbstaff', 'admin'])) {
            $comment->is_hidden = ! $comment->is_hidden;
            $comment->save();
        }
    }


    public function getCommentsProperty()
    {
        $query = $this->bill
            ->comments()
            ->with('user')
            ->orderBy('created_at', 'desc');

        if (Auth::check()) {
            $user = Auth::user();
            $role = is_object($user->role) && property_exists($user->role, 'value')
                ? $user->role->value
                : $user->role;

            if (!in_array($role, ['sbstaff', 'admin'])) {
                $query->where('is_hidden', false);
            }
        } else {
            // guest → only visible comments
            $query->where('is_hidden', false);
        }

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => $this->comments, 
        ]);
    }
}
