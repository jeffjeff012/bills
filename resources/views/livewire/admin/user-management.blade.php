<div>
    <flux:heading size="xl" level="1">User Management</flux:heading>
    <flux:subheading size="lg" class="mb-6">Manage all registered users</flux:subheading>
    <flux:separator variant="subtle" />

    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => { show = false }, 3000)"
            class="fixed top-5 right-5 bg-green-600 text-white text-sm p-4 rounded-lg shadow-lg z-50"
            role="alert"
        >
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    <flux:modal.trigger wire:click="$set('showCreateUserModal', true)">
        <flux:button class="mt-4 flex items-center gap-2">
            <flux:icon.user class="w-5 h-5" />
            Create User
        </flux:button>
    </flux:modal.trigger>

    <!-- Notice -->
    {{-- <div class="mt-4 mb-4 bg-blue-100 border border-blue-400 rounded-lg p-4 flex items-center gap-3">
        <flux:icon.information-circle class="w-5 h-5 text-blue-600" />
        <p class="text-blue-800 text-sm">
            You can only edit users <span class="font-semibold">Role</span>. All other information is protected.
        </p>
    </div> --}}

    <div class="overflow-x-auto mt-4 rounded-md shadow-sm"> {{-- slightly rounded --}}
        <table class="min-w-full text-sm text-left text-gray-700 bg-white rounded-md"> {{-- slightly rounded --}}
            <thead class="bg-gray-300 text-gray-700 font-semibold text-xs uppercase tracking-wider border-b border-gray-200"> {{-- bold --}}
                <tr>
                    <th class="px-6 py-3 font-bold">Name</th>
                    <th class="px-6 py-3 font-bold">Email</th>
                    <th class="px-6 py-3 font-bold">Role</th>
                    <th class="px-6 py-3 font-bold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    @php
                        $rowBg = $loop->iteration % 2 === 1 ? 'bg-gray-100' : 'bg-white';
                    @endphp

                    <tr class="{{ $rowBg }} hover:bg-lime-100 border-b border-gray-100">
                        <td class="px-6 py-4 text-black">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email ?? 'No email used' }}</td>
                        <td class="px-6 py-4">
                            @php
                                $roleName = strtolower($user->role->name ?? 'N/A');

                                $badgeSettings = match($roleName) {
                                    'admin' => ['color' => 'lime', 'textColor' => 'text-black dark:text-lime-800'], 
                                    'user' => ['color' => 'yellow', 'textColor' => 'text-black dark:text-yellow-800'],
                                    'sbstaff' => ['color' => 'blue', 'textColor' => 'text-black dark:text-blue-800'], 
                                    default => ['color' => 'gray', 'textColor' => 'text-white'],
                                };

                            @endphp

                            <flux:badge 
                                color="{{ $badgeSettings['color'] }}" 
                                size="lg" 
                                pill 
                                class="{{ $badgeSettings['textColor'] }}"
                            >
                                {{ ucfirst($roleName) }}
                            </flux:badge>
                        </td>
                        <td class="">
                        <flux:button
                            icon="pencil-square"
                            wire:click="edit({{ $user->id }})"
                            class="!bg-transparent !border-none !shadow-none !text-blue-800 dark:!text-black hover:!text-blue-600 hover:underline dark:hover:!text-blue-400 p-0 m-0 text-sm font-medium flex items-center gap-1 ring-0 focus:outline-none"
                            variant="ghost"
                        >
                            Edit
                        </flux:button>


                        <flux:button
                            icon="trash"
                            wire:click="confirmDelete({{ $user->id }})"
                            class="!bg-transparent !border-none !shadow-none !text-red-800 dark:!text-black hover:!text-red-600 hover:underline dark:hover:!text-red-400 p-0 m-0 text-sm font-medium flex items-center gap-1 ring-0 focus:outline-none"
                            variant="ghost"
                        >
                            Delete
                        </flux:button>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-400">No users found.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>

{{-- Create user Modal --}}
<flux:modal name="create-user" wire:model="showCreateUserModal" class="min-w-[28rem]">
    <div class="space-y-4">
        <flux:heading size="lg">Create New User</flux:heading>

        <form wire:submit.prevent="createUser" class="space-y-4">
        <flux:field label="Name">
            <flux:input type="text" wire:model="name" />
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </flux:field>

        <flux:field label="Email">
            <flux:input type="email" wire:model="email" />
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </flux:field>

        <flux:field label="Password">
            <flux:input type="password" wire:model="password" />
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </flux:field>

        {{-- Role --}}
        <flux:field label="Role">
            <flux:select wire:model="role">
                <option value="">-- Select Role --</option>
                <option value="admin">Admin</option>
                <option value="sbstaff">SbStaff</option>
                <option value="user">User</option>
            </flux:select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </flux:field>

        <div class="flex justify-end gap-2">
            <flux:modal.close>
                <flux:button type="button" variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button type="submit">Save</flux:button>
        </div>
    </form>

    </div>
</flux:modal>

{{-- Edit User Modal --}}
<flux:modal name="edit-user-modal" wire:model="showEditModal" focusable class="max-w-lg">
        <form wire:submit.prevent="updateUserRole" class="space-y-6">
        <flux:heading size="lg">Edit User Role</flux:heading>

        <flux:input label="Name" type="text" :value="$editName" readonly />
        <flux:input label="Email" type="email" :value="$editEmail" readonly />

        <flux:select wire:model="editRole" label="Role">
            <option value="admin">Admin</option>
            <option value="sbstaff">SB Staff</option>
            <option value="user">User</option>
        </flux:select>

        <div class="flex justify-end space-x-2 rtl:space-x-reverse">
            <flux:modal.close>
                <flux:button variant="filled">Cancel</flux:button>
            </flux:modal.close>
            <flux:button variant="primary" type="submit">Update</flux:button>
        </div>
    </form>
</flux:modal>

{{-- Delete User Modal --}}
<flux:modal name="delete-user" class="min-w-[22rem]" wire:model="confirmingUserDeletion">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete User?</flux:heading>
            <flux:text class="mt-2">
                <p>You're about to delete this user.</p>
                <p>This action cannot be reversed.</p>
            </flux:text>
        </div>

        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="ghost" wire:click="$set('confirmingUserDeletion', false)">Cancel</flux:button>
            </flux:modal.close>

            <flux:button type="button" variant="danger" wire:click="deleteUser">Delete</flux:button>
        </div>
    </div>
</flux:modal>


  
    </div>
</div>


