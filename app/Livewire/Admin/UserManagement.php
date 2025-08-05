<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use App\Enums\UserRole;

class UserManagement extends Component
{
    use WithPagination;

    public $editUserId;
    public $editName;
    public $editEmail;
    public $editRole;
    public $showEditModal = false;
    public $confirmingUserDeletion = false;
    public $userToDelete = null;
   
    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        
        $this->editUserId = $user->id;
        $this->editName = $user->name;
        $this->editEmail = $user->email;
        $this->editRole = $user->role->value ?? null;

        $this->showEditModal = true;
    }

    public function updateUserRole()
    {
        $this->validate([
            'editRole' => 'required|in:admin,sbstaff,user',
        ]);

        $user = User::findOrFail($this->editUserId);
        $user->role = UserRole::from($this->editRole);
        $user->save();

        session()->flash('success', 'User role updated successfully.');

        $this->showEditModal = false;
    }

    public function confirmDelete($userId)
    {
        $this->userToDelete = $userId;
        $this->confirmingUserDeletion = true;
    }

    public function deleteUser()
    {
        $user = \App\Models\User::findOrFail($this->userToDelete);

        // Optional: Prevent self-deletion
        if (auth()->id() === $user->id) {
            $this->dispatch('notify', message: 'You cannot delete your own account.', type: 'warning');
            $this->confirmingUserDeletion = false;
            return;
        }

        $user->delete();
        $this->confirmingUserDeletion = false;
        $this->userToDelete = null;

        session()->flash('success', 'User deleted successfully.');
    }
    public function render()
    {
        return view('livewire.admin.user-management', [
            'users' => User::paginate(8),
        ]);
    }
}
