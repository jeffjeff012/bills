<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Note;
use Livewire\Component;


class CreateNote extends Component
{
    public $title;
    public $content;
    public $due_date;
    public $authored_by;

    protected function rules()
    {
        return
        [
            'title' => 'required|string|unique:notes,title|max:255',
            'content' => 'required|string',
            'due_date' => 'required|date',
            'authored_by' => 'required|string|max:255',
        ];
    }

    public function save()
    {
        $this->validate();
        Note::create([
            "title" => $this->title,
            "content" => $this->content,
            'due_date' => $this->due_date,
            "user_id" => auth()->id(),
            'authored_by' => $this->authored_by,
        ]);

        $this->reset();

        Flux::modal('create-note')->close();

        session()->flash('success', 'Bill created successfully');

        $this->redirectRoute('notes', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-note');
    }
}
