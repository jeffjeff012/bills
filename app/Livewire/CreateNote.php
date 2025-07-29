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

    protected function rules()
    {
        return
        [
            'title' => 'required|string|unique:notes,title|max:255',
            'content' => 'required|string',
            
        ];
    }

    public function save()
    {
        $this->validate();
        // dd('ok');
        //STORE NOTE
        Note::create([
            "title" => $this->title,
            "content" => $this->content,
            'due_date' => $this->due_date,
            "user_id" => auth()->id(),
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
