<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Bill;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EditBill extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $title, $content, $billId, $due_date, $authored_by;
    public $attachment;
    public $currentAttachment; 
    #[On('edit-bill')] 
    public function edit($id)
    {
        $bill = Bill::with('user')->findOrFail($id);

        if (
            auth()->user()->role === UserRole::SbStaff &&
            $bill->user &&
            $bill->user->role === UserRole::Admin
        ) {
            abort(403, 'Unauthorized: Staff cannot edit bills created by Admin.');
        }

        $this->billId = $id;
        $this->title = $bill->title;
        $this->content = $bill->content;
        $this->authored_by = $bill->authored_by;
        $this->due_date = $bill->due_date ? \Carbon\Carbon::parse($bill->due_date)->format('Y-m-d') : null;
        $this->currentAttachment = $bill->attachment;

        Flux::modal('edit-bill')->show();
    }

    public function update() 
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('bills', 'title')->ignore($this->billId)],
            'content' => ['required', 'string'],
            'authored_by' => ['nullable', 'string', 'max:255'],
            'due_date' => ['required', 'date'],
        ]);

        $bill = Bill::with('user')->findOrFail($this->billId);

        if (
            auth()->user()->role === UserRole::SbStaff &&
            $bill->user &&
            $bill->user->role === UserRole::Admin
        ) {
            abort(403, 'Unauthorized: Staff cannot edit bills created by Admin.');
        }

        $bill->title = $this->title;
        $bill->content = $this->content;
        $bill->authored_by = $this->authored_by;
        $bill->due_date = $this->due_date;
            if ($this->attachment) {
            // delete old file if exists
            if ($bill->attachment && Storage::exists($bill->attachment)) {
                Storage::delete($bill->attachment);
            }

           $bill->attachment = $this->attachment->store('attachments', 'public');
            $this->currentAttachment = $bill->attachment; 
        }
        $bill->save();

        session()->flash('success', 'Bill updated successfully.');
        $this->reset(['attachment']);
        $this->redirectRoute('report-of-bills', navigate: true);
        Flux::modal('edit-bill')->close();
    }

    public function render()
    {
        return view('livewire.edit-bill');
    }
}
