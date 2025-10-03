<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Bill;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\Committee;

class CreateBill extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $due_date;
    public $contributorType = 'author';
    public $authored_by;
    public $sponsored_by = '';
    public $attachment;
    public $committee_id;
    public $committees = [];


    public function mount()
    {
        $this->committees = Committee::orderBy('name')->get();
    }

    protected function rules()
    {
        return [
            'title'          => 'required|string|unique:bills,title|max:255',
            'content'        => 'required|string',
            'due_date'       => 'required|date',
            'contributorType' => 'required|in:author,sponsor',
            'authored_by'    => 'required_if:contributorType,author',
            'committee_id'   => 'required_if:contributorType,sponsor|nullable|exists:committees,id',
            'attachment'     => 'nullable|file|mimes:pdf|max:5120', // 5MB max
        ];
    }


    public function save()
    {
        $this->validate();

        $path = $this->attachment
            ? $this->attachment->store('attachments', 'public')
            : null;

        Bill::create([
            'title'          => $this->title,
            'content'        => $this->content,
            'due_date'       => Carbon::parse($this->due_date)->endOfDay(),
            'user_id'        => auth()->id(),
            'contributorType' => $this->contributorType,
            'authored_by'    => $this->contributorType === 'author' ? $this->authored_by : null,
            'committee_id'   => $this->contributorType === 'sponsor' ? $this->committee_id : null,
            'attachment'     => $path,
        ]);

        session()->flash('success', 'Bill created successfully');

        return $this->redirectRoute('report-of-bills', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-bill');
    }
}
