<div>
    {{-- <div class="relative mb-6 w-full"> --}}
    <div class="flex flex-col lg:flex-row justify-between mb-6">
        <div class="">
            <flux:heading size="xl" level="1">{{ __('Report of Bills') }}</flux:heading>
            <flux:subheading size="lg" class="mb-3">{{ __('Make and add changes') }}</flux:subheading>
        </div>
        <div>
            <a href="{{ route('bills.create') }}">
                <flux:button variant="primary">
                    Create New Bill
                </flux:button>
            </a>
        </div>
    </div>
        <flux:separator variant="subtle" />

    <!-- Notice -->
    @if (auth()->user()->role !== \App\Enums\UserRole::Admin)
        <div
            class="mt-4 mb-4 bg-white border-3 border-dashed border-gray-400 rounded-xl p-5 shadow-sm flex items-start gap-4">
            <flux:icon.information-circle class="w-8 h-8 text-gray-600 flex-shrink-0" />
            <div>
                <p class="text-gray-900 text-base md:text-lg leading-relaxed">
                    You can only <span class="font-semibold">edit</span> and <span class="font-semibold">delete</span>
                    the
                    <span class="font-semibold">Bills</span> you created.
                </p>
            </div>
        </div>
    @endif

    @session('success')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false }, 3000)"
            class="fixed top-5 right-5 bg-green-600 text-white text-sm p-4 rounded-lg shadow-lg z-50" role="alert">
            <p>{{ $value }}</p>
        </div>
    @endsession

    {{-- Bills Table --}}
    <div class="overflow-x-auto mt-2 rounded-md shadow-sm">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Content
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Likes
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dislikes
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Comments
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bills as $bill)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-4 py-2 text-black dark:text-white">{{ $loop->iteration }}</td>
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
                        <td class="px-4 py-2 text-center">
                            @can('update', $bill)
                                <a href="{{ route('bills.edit', $bill) }}">
                                    <flux:button icon="pencil-square"
                                        class="!bg-transparent !border-none !shadow-none !text-blue-800 dark:!text-white hover:!text-blue-800 hover:underline dark:hover:!text-blue-400 p-0 m-0 text-sm font-medium flex items-center gap-1 ring-0 focus:outline-none"
                                        variant="ghost">
                                        Edit
                                    </flux:button>
                                </a>
                            @endcan

                            @can('delete', $bill)
                                <flux:button icon="trash" wire:click="confirmDelete({{ $bill->id }})"
                                    class="!bg-transparent !border-none !shadow-none !text-red-800 dark:!text-white hover:!text-red-800 hover:underline dark:hover:!text-red-400 p-0 m-0 text-sm font-medium flex items-center gap-1 ring-0 focus:outline-none"
                                    variant="ghost">
                                    Delete
                                </flux:button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-center text-black dark:text-gray-400">
                            No bills yet! Start creating bills
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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
