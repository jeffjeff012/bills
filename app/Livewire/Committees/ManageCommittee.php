<?php

namespace App\Livewire\Committees;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Committee;

class ManageCommittee extends Component
{
    use WithPagination;

    public $name;
    public $editName;
    public $showDeleteModal = false;
    public $committeeToDelete;
    public $showEditModal = false;
    public $editingCommittee;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        Committee::create([
            'name' => $this->name,
        ]);

        $this->reset('name');
        session()->flash('success', 'Committee added successfully!');
    }

    public function editCommittee($id)
    {
        $this->editingCommittee = Committee::findOrFail($id);
        $this->editName = $this->editingCommittee->name;
        $this->showEditModal = true;
    }

    public function updateCommittee()
    {
        $this->validate([
            'editName' => 'required|string|max:255',
        ]);

        $this->editingCommittee->update([
            'name' => $this->editName,
        ]);

        $this->reset('editName', 'editingCommittee');
        $this->showEditModal = false;
        session()->flash('message', 'Committee updated successfully!');
    }

    public function confirmDelete($id)
    {
        $this->committeeToDelete = $id;
        $this->showDeleteModal = true;
    }


    public function deleteCommittee()
    {
        \App\Models\Committee::findOrFail($this->committeeToDelete)->delete();

        $this->showDeleteModal = false;
        session()->flash('success', 'Committee deleted successfully.');
    }

    public function delete($id)
    {
        Committee::findOrFail($id)->delete();
        session()->flash('success', 'Committee deleted successfully!');
    }

    public function render()
    {
        $committees = Committee::orderBy('id', 'asc')
            ->latest()
            ->paginate(10);

        return view('livewire.committees.manage-committee', [
            'committees' => $committees,
        ]);
    }
}
