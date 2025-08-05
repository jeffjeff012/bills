<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Note;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use App\Enums\UserRole;

class EditNote extends Component
{
    public $title, $content, $noteId, $due_date;

    #[On('edit-note')] 
    public function edit($id)
    {
        $note = Note::with('user')->findOrFail($id);

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
        $this->due_date = $note->due_date ? \Carbon\Carbon::parse($note->due_date)->format('Y-m-d') : null;

        Flux::modal('edit-note')->show();
    }

    public function update() 
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('notes', 'title')->ignore($this->noteId)],
            'content' => ['required', 'string'],
            'due_date' => ['required', 'date'],
        ]);

        $note = Note::with('user')->findOrFail($this->noteId);

        if (
            auth()->user()->role === UserRole::SbStaff &&
            $note->user &&
            $note->user->role === UserRole::Admin
        ) {
            abort(403, 'Unauthorized: Staff cannot edit bills created by Admin.');
        }

        $note->title = $this->title;
        $note->content = $this->content;
        $note->due_date = $this->due_date;
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
