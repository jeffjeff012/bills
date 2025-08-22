<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\UserRole;


class Bills extends Component
{
    use WithPagination;

    public $billIdBeingDeleted = null;
    public $billId;
    public $showDeleteModal = false;

    public function render()
    {
        $bills = Bill::withCount([
            'likes as likes_count' => fn ($q) => $q->where('like', true),
            'likes as dislikes_count' => fn ($q) => $q->where('like', false),
            'comments'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(5);

        return view('livewire.bills', [
            'bills' => $bills,   
        ]);
    }


    public function edit($id)
    {
        $this->dispatch('edit-bill', $id);
    }

    public function confirmDelete($billId)
    {
        $bill = Bill::with('user')->findOrFail($billId);

        if (!auth()->user()->can('delete', $bill)) {
            abort(403, 'Unauthorized');
        }

        $this->billIdBeingDeleted = $billId;
        $this->showDeleteModal = true;
    }


    public function deleteBill()
    {
        $bill = Bill::with('user')->findOrFail($this->billIdBeingDeleted);

        if (!auth()->user()->can('delete', $bill)) {
            abort(403, 'Unauthorized');
        }

        $bill->delete();

        $this->billIdBeingDeleted = null;
        $this->showDeleteModal = false;

        session()->flash('success', 'Bill deleted successfully.');

        $this->redirectRoute('report-of-bills', navigate: true);
    }

}
