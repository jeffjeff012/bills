<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Bill;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;


class CreateBill extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $due_date;
    public $authored_by;
    public $attachment;
    
    protected function rules()
    {
        return [
            'title'       => 'required|string|unique:bills,title|max:255',
            'content'     => 'required|string',
            'due_date'    => 'required|date',
            'authored_by' => 'required|string|max:255',
            'attachment'  => 'nullable|file|mimes:pdf|max:5120', // 5MB max
        ];
    }

    public function save()
    {
        $this->validate();

        //Initialize $path
        $path = null;

        //Save file if uploaded
        if ($this->attachment) {
            $path = $this->attachment->store('attachments', 'public'); 
            //stored in storage/app/public/attachments
        }

        Bill::create([
            'title'       => $this->title,
            'content'     => $this->content,
            'due_date'    => Carbon::parse($this->due_date)->endOfDay(),
            'user_id'     => auth()->id(),
            'authored_by' => $this->authored_by,
            'attachment'  => $path, //safe, always defined
        ]);

        $this->reset();

        Flux::modal('create-bill')->close();

        session()->flash('success', 'Bill created successfully');

        $this->redirectRoute('report-of-bills', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-bill');
    }
}
