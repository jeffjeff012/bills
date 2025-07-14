<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\User;
use Illuminate\Support\Facades\Gate;

class Notes extends Component
{
    use WithPagination;

    public $noteId;
    public function render()
    {
        $notes = Note::orderBy('created_at', 'desc')->paginate(5);
        // $notes = Note::orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.notes',[
            'notes' => $notes
        ]);
    }

    public function edit ($id)
    {
        // dd($id);
         $this->dispatch('edit-note', $id); 
    }

   public function delete($id)
    {
    $note = Note::findOrFail($id);

    Gate::authorize('delete', $note);

    $note->delete();

    session()->flash('success', 'Bill deleted successfully.');

    $this->redirectRoute('notes', navigate: true);
    }

    public function deleteNote()
    {


        Note::find($this->noteId)->delete();
        Flux::modal('delete-note')->close();
        session()->flash('success', 'Deleted successfully');
        $this->redirectRoute('notes', navigate: true);
    }

 
}
