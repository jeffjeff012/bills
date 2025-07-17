<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\UserRole;

class Notes extends Component
{
    use WithPagination;

    public $noteIdBeingDeleted = null;
    public $noteId;
    public $showDeleteModal = false;

    public function render()
    {
        $notes = Note::orderBy('created_at', 'desc')->paginate(5);

        return view('livewire.notes', [
            'notes' => $notes
        ]);
    }

    public function edit($id)
    {
        $this->dispatch('edit-note', $id);
    }

    public function confirmDelete($noteId)
    {
        $note = Note::with('user')->findOrFail($noteId);

        if (
            auth()->user()->role === UserRole::SbStaff &&
            $note->user &&
            $note->user->role === UserRole::Admin
        ) {
            abort(403, 'Unauthorized: Staff cannot delete bills created by Admin.');
        }

        $this->noteIdBeingDeleted = $noteId;
        $this->showDeleteModal = true;
    }

    public function deleteNote()
    {
        $note = Note::with('user')->findOrFail($this->noteIdBeingDeleted);

        if (
            auth()->user()->role === UserRole::SbStaff &&
            $note->user &&
            $note->user->role === UserRole::Admin
        ) {
            abort(403, 'Unauthorized: Staff cannot delete bills created by Admin.');
        }

        $note->delete();

        $this->noteIdBeingDeleted = null;
        $this->showDeleteModal = false;

        session()->flash('success', 'Note deleted successfully.');

        $this->redirectRoute('notes', navigate: true);
    }
}
