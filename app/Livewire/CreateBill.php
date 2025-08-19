<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Bill;
use Livewire\Component;

class CreateBill extends Component
{
    public $title;
    public $content;
    public $due_date;
    public $authored_by;

    protected function rules()
    {
        return [
            'title' => 'required|string|unique:bills,title|max:255',
            'content' => 'required|string',
            'due_date' => 'required|date',
            'authored_by' => 'required|string|max:255',
        ];
    }

    public function save()
    {
        $this->validate();

        Bill::create([
            'title' => $this->title,
            'content' => $this->content,
            'due_date' => $this->due_date,
            'user_id' => auth()->id(),
            'authored_by' => $this->authored_by,
        ]);

        $this->reset();

        Flux::modal('create-bill')->close();

        session()->flash('success', 'Bill created successfully');

        $this->redirectRoute('bills.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-bill');
    }
}
