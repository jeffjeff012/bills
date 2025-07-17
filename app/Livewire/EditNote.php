<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Note;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRole;

class EditNote extends Component
{
    public $title, $content, $noteId;

    #[On('edit-note')] 
    public function edit($id)
    {
        $note = Note::with('user')->findOrFail($id);

        // ✅ Block staff from editing admin bills before opening modal
        if (
            auth()->user()->role === UserRole::SbStaff &&
            $note->user &&
            $note->user->role === UserRole::Admin
        ) {
            abort(403, 'Unauthorized: Staff cannot edit bills created by Admin.');
        }

        $this->noteId = $id;
        $this->title = $note->title;
        $this->content = $note->content;

        Flux::modal('edit-note')->show();
    }

    public function update() 
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('notes', 'title')->ignore($this->noteId)],
            'content' => ['required', 'string'],
        ]);

        $note = Note::with('user')->findOrFail($this->noteId);

        // ✅ Double-check in update for safety
        if (
            auth()->user()->role === UserRole::SbStaff &&
            $note->user &&
            $note->user->role === UserRole::Admin
        ) {
            abort(403, 'Unauthorized: Staff cannot edit bills created by Admin.');
        }

        $note->title = $this->title;
        $note->content = $this->content;
        $note->save();

        session()->flash('success', 'Bill updated successfully.');

        $this->redirectRoute('notes', navigate: true);
        Flux::modal('edit-note')->close();
    }

    public function render()
    {
        return view('livewire.edit-note');
    }
}
