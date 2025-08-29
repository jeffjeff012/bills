<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Bill;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class CreateBillPage extends Component
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
            'attachment'  => 'nullable|file|mimes:pdf|max:5120',
        ];
    }

    public function save()
    {
        $this->validate();

        $path = null;

        if ($this->attachment) {
            $path = $this->attachment->store('attachments', 'public'); 
        }

        Bill::create([
            'title'       => $this->title,
            'content'     => $this->content,
            'due_date'    => Carbon::parse($this->due_date)->endOfDay(),
            'user_id'     => auth()->id(),
            'authored_by' => $this->authored_by,
            'attachment'  => $path,
        ]);

        session()->flash('success', 'Bill created successfully');

        $this->redirectRoute('report-of-bills', navigate: true);
    }

    public function cancel()
    {
        $this->redirectRoute('report-of-bills', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-bill-page');
    }
}