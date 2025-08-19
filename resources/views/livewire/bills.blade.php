<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Bills') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Make and add changes') }}</flux:subheading>
        <flux:separator variant="subtle" />

        <flux:modal.trigger name="create-bill">
            <flux:button class="mt-4">Create New</flux:button>
        </flux:modal.trigger>

        @session('success')
            <div
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => { show = false }, 3000)"
                class="fixed top-5 right-5 bg-green-600 text-white text-sm p-4 rounded-lg shadow-lg z-50"
                role="alert"
            >
                <p>{{ $value }}</p>
            </div>
        @endsession
    </div>

    <livewire:create-bill />

    <livewire:edit-bill />

    {{-- Bills Table --}}
    <table class="table-auto w-full bg-gray-300 dark:bg-slate-800 text-white dark:text-white shadow-md rounded-md mt-5">
    <thead class="bg-neutral-700 dark:bg-slate-900">
    <tr>
        <th class="px-4 py-2 text-left">Title</th>
        <th class="px-4 py-2 text-left">Content</th>
        <th class="px-4 py-2 text-left">Status</th>
        <th class="px-4 py-2 text-center">Likes</th>
        <th class="px-4 py-2 text-center">Dislikes</th>
        <th class="px-4 py-2 text-center">Comments</th>
        <th class="px-4 py-2 text-center">Actions</th>
    </tr>
</thead>
<tbody>
    @forelse ($bills as $bill)
        <tr class="border-t border-gray-700">
            <td class="px-4 py-2 text-black dark:text-white">{{ $bill->title }}</td>
            <td class="px-4 py-2 text-black dark:text-white">{{ str($bill->content)->words(8) }}</td>

            <td class="px-4 py-2">
                @if (\Carbon\Carbon::parse($bill->due_date)->gte(\Carbon\Carbon::today()))
                    <flux:badge color="lime" size="lg" pill>Active</flux:badge>
                @else
                    <flux:badge color="red" size="lg" pill>Inactive</flux:badge>
                @endif
            </td>

            <td class="px-4 py-2 text-center text-black dark:text-white">{{ $bill->likes_count }}</td>
            <td class="px-4 py-2 text-center text-black dark:text-white">{{ $bill->dislikes_count }}</td>
            <td class="px-4 py-2 text-center text-black dark:text-white">{{ $bill->comments_count }}</td>

            <td class="px-4 py-2 text-center space-x-2">
                    <flux:button
                            icon="pencil-square"
                            wire:click="edit({{ $bill->id }})"
                            class="!bg-transparent !border-none !shadow-none !text-blue-800 dark:!text-white hover:!text-blue-800 hover:underline dark:hover:!text-blue-400 p-0 m-0 text-sm font-medium flex items-center gap-1 ring-0 focus:outline-none"
                            variant="ghost"
                        >
                            Edit
                        </flux:button>


                        <flux:button
                            icon="trash"
                            wire:click="confirmDelete({{ $bill->id }})"
                            class="!bg-transparent !border-none !shadow-none !text-red-800 dark:!text-white hover:!text-red-800 hover:underline dark:hover:!text-red-400 p-0 m-0 text-sm font-medium flex items-center gap-1 ring-0 focus:outline-none"
                            variant="ghost"
                        >
                            Delete
                        </flux:button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="px-4 py-3 text-center text-black dark:text-gray-400">
                No bills yet!
            </td>
        </tr>
    @endforelse
</tbody>

</table>

    <div class="mt-4">
        {{ $bills->links() }}
    </div>

    {{-- Delete --}}

<flux:modal name="delete-bill" class="min-w-[22rem]" wire:model="showDeleteModal">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete bill?</flux:heading>

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

            <flux:button type="button" variant="danger" wire:click="deleteBill()">Delete bill</flux:button>
        </div>
    </div>
</flux:modal>
</div>
