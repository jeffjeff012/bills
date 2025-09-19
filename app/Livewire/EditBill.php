<?php

namespace App\Livewire;

use App\Models\Bill;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class EditBill extends Component
{
    use WithFileUploads;

    public Bill $bill;
    public $title;
    public $content;
    public $due_date;
    public $contributorType = '';
    public $authored_by = '';
    public $sponsored_by = '';
    public $attachment;
    public $currentAttachment;

    public function mount(Bill $bill)
    {
        $this->bill = $bill;
        $this->title = $bill->title;
        $this->content = $bill->content;
        $this->due_date = $bill->due_date ? $bill->due_date->format('Y-m-d') : '';
        $this->contributorType = $bill->contributorType ?? '';
        $this->authored_by = $bill->authored_by ?? '';
        $this->sponsored_by = $bill->sponsored_by ?? '';
        $this->currentAttachment = $bill->attachment;
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255|unique:bills,title,' . $this->bill->id,
            'content' => 'required|string',
            'due_date' => 'required|date',
            'contributorType' => 'required|in:author,sponsor',
            'authored_by' => 'required_if:contributorType,author',
            'sponsored_by' => 'required_if:contributorType,sponsor',
            'attachment' => 'nullable|file|mimes:pdf|max:5120',
        ];
    }

    public function update()
    {
        $this->validate();

        $path = $this->attachment
            ? $this->attachment->store('attachments', 'public')
            : $this->currentAttachment;

        $this->bill->update([
            'title' => $this->title,
            'content' => $this->content,
            'due_date' => Carbon::parse($this->due_date)->endOfDay(),
            'contributorType' => $this->contributorType,
            'authored_by' => $this->contributorType === 'author' ? $this->authored_by : null,
            'sponsored_by' => $this->contributorType === 'sponsor' ? $this->sponsored_by : null,
            'attachment' => $path,
        ]);

        session()->flash('success', 'Bill updated successfully');

        return $this->redirectRoute('report-of-bills', navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-bill');
    }
}