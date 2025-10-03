<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Bill;
use Livewire\Component;
use App\Models\Committee;
use Livewire\WithFileUploads;

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
    public $committee_id;
    public $committees = [];
    public $removeAttachment = false;
    public $showRemoveAttachmentModal = false;

    public function mount(Bill $bill)
    {
        $this->bill = $bill;
        $this->title = $bill->title;
        $this->content = $bill->content;
        $this->due_date = $bill->due_date ? $bill->due_date->format('Y-m-d') : '';
        $this->contributorType = $bill->contributorType ?? '';

        // If Author, prefill author field
        $this->authored_by = $bill->contributorType === 'author' ? $bill->authored_by : '';

        // Committees dropdown
        $this->committees = Committee::orderBy('name')->get();

        // If Sponsor, preselect committee
        $this->committee_id = $bill->contributorType === 'sponsor' ? $bill->committee_id : null;

        // Attachment
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
            'committee_id'   => 'required_if:contributorType,sponsor|exists:committees,id',
            'attachment' => 'nullable|file|mimes:pdf|max:5120',
        ];
    }

    // 'committee_id' => 'nullable|exists:committees,id',
    // 'sponsored_by' => 'required_if:contributorType,sponsor',
    public function update()
    {
        $this->validate();

        // Default to current attachment
        $path = $this->currentAttachment;

        // If user uploaded a new one → replace
        if ($this->attachment) {
            $path = $this->attachment->store('attachments', 'public');
        }

        // If user requested to remove → null out
        if ($this->removeAttachment) {
            $path = null;

            // (Optional) Delete the old file from storage
            if ($this->currentAttachment && \Storage::disk('public')->exists($this->currentAttachment)) {
                \Storage::disk('public')->delete($this->currentAttachment);
            }
        }

        $this->bill->update([
            'title'          => $this->title,
            'content'        => $this->content,
            'due_date'       => \Carbon\Carbon::parse($this->due_date)->endOfDay(),
            'contributorType' => $this->contributorType,
            'authored_by'    => $this->contributorType === 'author' ? $this->authored_by : null,
            'sponsored_by'   => $this->contributorType === 'sponsor' ? $this->sponsored_by : null,
            'committee_id'   => $this->contributorType === 'sponsor' ? $this->committee_id : null,
            'attachment'     => $path,
        ]);

        session()->flash('success', 'Bill updated successfully');

        return $this->redirectRoute('report-of-bills', navigate: true);
    }

    // 'committee_id' => $this->committee_id,
    // 'sponsored_by' => $this->contributorType === 'sponsor' ? $this->sponsored_by : null,
    public function confirmRemoveAttachment()
    {
        $this->showRemoveAttachmentModal = true;
    }

    public function removeCurrentAttachment()
    {
        // $this->removeAttachment = true;
        // $this->currentAttachment = null;

        if ($this->currentAttachment) {
            // Delete the file from storage
            Storage::delete($this->currentAttachment);

            // Update the database
            $this->bill->update([
                'attachment' => null,
            ]);

            // Clear local state
            $this->currentAttachment = null;

            $this->showRemoveAttachmentModal = false;
        }
    }

    public function render()
    {
        return view('livewire.edit-bill');
    }
}
