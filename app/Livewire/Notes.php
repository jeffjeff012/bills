<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;

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
        // dd($id);
        $this->noteId = $id;
         Flux::modal('delete-note')->show();
    }

    public function deleteNote()
    {
        Note::find($this->noteId)->delete();
        Flux::modal('delete-note')->close();
        session()->flash('success', 'Deleted successfully');
        $this->redirectRoute('notes', navigate: true);
    }
}
