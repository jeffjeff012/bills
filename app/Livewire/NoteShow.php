<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;

class NoteShow extends Component
{
    public Note $note;

    public function mount(Note $note)
    {
        $this->note = $note;
    }

    public function render()
    {
        return view('livewire.note-show');
    }
}
