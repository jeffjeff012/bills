<div>
    <flux:heading size="xl" level="1">Manage Committee</flux:heading>
    <flux:subheading size="lg" class="mb-6">Manage all partner committee</flux:subheading>
    <flux:separator variant="subtle" />

    {{-- Add New Committee --}}
    <form wire:submit.prevent="save" class="mt-4 mb-6 flex w-1/2 gap-2">
        <input type="text" wire:model="name" placeholder="Committee name" class="flex-1 border rounded-lg px-3 py-2" />
        <button type="submit" class="flex bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Add&nbsp; <span class="hidden md:block lg:block">Committee</span>
        </button>
    </form>

    @error('name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror

    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="translate-y-[-10px] opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transform transition ease-in duration-300"
            x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-[-10px] opacity-0"
            x-init="setTimeout(() => { show = false }, 3000)"
            class="fixed top-5 right-5 bg-green-200 border-2 border-solid border-green-800 text-green-900 text-sm p-4 rounded-lg shadow-xl z-50"
            role="alert">
            <p class="font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Committee Table --}}
    <table class="w-full border-collapse">
        <thead>
            <tr class="text-gray-100 dark:text-gray-50 bg-neutral-700 dark:bg-slate-900">
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($committees as $committee)
                <tr class="border-t bg-neutral-700 dark:bg-slate-700">
                    <td class="px-4 py-2">{{ $committee->id }}</td>
                    <td class="px-4 py-2">{{ $committee->name }}</td>
                    <td class="px-4 py-2 text-center">
                        <flux:button icon="pencil-square" wire:click="editCommittee({{ $committee->id }})"
                            class="!bg-transparent !border-none !shadow-none !text-blue-800 dark:!text-white hover:!text-blue-800 hover:underline dark:hover:!text-blue-400 p-0 m-0 text-sm font-medium flex items-center gap-1 ring-0 focus:outline-none"
                            variant="ghost">
                              <span class="hidden md:block lg:block">Edit</span>
                        </flux:button>
                        <flux:button icon="trash" wire:click="confirmDelete({{ $committee->id }})"
                            class="!bg-transparent !border-none !shadow-none !text-red-800 dark:!text-white 
                                    hover:!text-red-800 hover:underline dark:hover:!text-red-400 
                                    p-0 m-0 text-sm font-medium flex items-center gap-1 ring-0 focus:outline-none"
                            variant="ghost">
                            <span class="hidden md:block lg:block">Delete</span>
                        </flux:button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-8">
                        <div
                            class="flex flex-col items-center justify-center py-6 border-2 border-dashed border-gray-300 dark:border-zinc-600 rounded-xl bg-gray-50 dark:bg-zinc-800/50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-10 h-10 text-gray-400 dark:text-gray-50 mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                            </svg>
                            <p class="text-gray-600 dark:text-gray-50 font-medium">No committees found</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Add a new committee to get started.
                            </p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <flux:modal name="edit-committee" class="min-w-[22rem]" wire:model="showEditModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Committee</flux:heading>

                <div class="mt-4">
                    <flux:input type="text" 
                                wire:model.defer="editName" 
                                placeholder="Committee name" 
                                class="w-full" />
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="button" variant="primary" wire:click="updateCommittee()">
                    Save
                </flux:button>
            </div>
        </div>
    </flux:modal>


    {{-- Delete --}}
    <flux:modal name="delete-committee" class="min-w-[10rem] lg:min-w-[22rem]" wire:model="showDeleteModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Committee?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this project.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="button" variant="danger" wire:click="deleteCommittee()">Delete committee
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <div class="mt-4">
        {{ $committees->links() }}
    </div>
</div>
