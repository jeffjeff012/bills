<x-layouts.app :title="__('Staff Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Sangguniang Bayan') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Bill creation process') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

@session('success')
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-transition 
        class="mb-4 rounded-lg bg-green-100 border border-green-800 text-green-800 px-4 py-3 flex items-center justify-between"
    >
        <span class="text-sm font-medium">{{ $value }}</span>
        <button 
            @click="show = false" 
            class="text-green-600 hover:text-green-800 font-bold text-lg leading-none"
        >
            &times;
        </button>
    </div>
@endsession

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
    <!-- Users -->
    <flux:modal.trigger name="all-users">
        <div class="bg-gradient-to-br from-blue-500 to-cyan-600 border border-blue-500 text-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium uppercase">Users</h2>
                    <p class="text-3xl font-bold mt-2">{{ $userCount }}</p>
                </div>
                <flux:icon name="user-group" class="w-10 h-10 text-white" />
            </div>
        </div>
    </flux:modal.trigger>

    <!-- Bills Created -->
    <flux:modal.trigger name="all-bills">
        <div class="bg-gradient-to-br from-purple-500 to-blue-600 border border-blue-500 text-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium uppercase">Bills Created</h2>
                    <p class="text-3xl font-bold mt-2">{{ $billCount }}</p>
                </div>
                <flux:icon name="scale" class="w-10 h-10 text-white" />
            </div>
        </div>
    </flux:modal.trigger>


    <!-- Likes Modal -->
    <flux:modal.trigger name="likes-summary">
        <div class="bg-gradient-to-br from-blue-400 to-blue-500 border border-blue-500 text-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium uppercase">Likes</h2>
                    <p class="text-3xl font-bold mt-2">{{ $totalLikes }}</p>
                </div>
                <flux:icon name="hand-thumb-up" class="w-10 h-10 text-black-500" />
            </div>
        </div>
    </flux:modal.trigger>

    <!-- Dislikes -->
    <flux:modal.trigger name="dislikes-summary">
        <div class="bg-gradient-to-br from-teal-500 to-orange-600 border border-blue-500 text-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium uppercase">Dislikes</h2>
                    <p class="text-3xl font-bold mt-2">{{ $totalDislikes }}</p>
                </div>
                <flux:icon name="hand-thumb-down" class="w-10 h-10 text-black-500" />
            </div>
        </div>
    </flux:modal.trigger>

</div>

{{-- Bills Summary --}}
<flux:modal name="all-bills" class="min-w-[30rem] max-h-[60vh] overflow-auto">
    <div class="space-y-4">
        <flux:heading size="lg">All Bills</flux:heading>

       <table class="table-auto w-full rounded-md overflow-hidden shadow-md">
            <thead class="bg-gray-300 dark:bg-slate-900 text-black dark:text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100 dark:bg-slate-800">
                @foreach ($bills as $bill)
                <tr class="border-b border-gray-300 dark:border-slate-700 hover:bg-lime-100 dark:hover:bg-lime-100 transition-colors">
                    <td class="px-4 py-2 text-black dark:text-white">{{ $bill->title }}</td>
                    <td class="px-4 py-2">
                        @if (\Carbon\Carbon::parse($bill->due_date)->gte(\Carbon\Carbon::today()))
                            <flux:badge color="lime" size="lg" pill>Active</flux:badge>
                        @else
                            <flux:badge color="red" size="lg" pill>Inactive</flux:badge>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-end mt-4">
            <flux:modal.close>
                <flux:button variant="ghost">Close</flux:button>
            </flux:modal.close>
        </div>
    </div>
</flux:modal>

{{-- Likes Summary Modal --}}
<flux:modal name="likes-summary" class="min-w-[30rem] max-h-[60vh] overflow-auto">
    <div class="space-y-4">
        <flux:heading size="lg">Bills Likes Summary</flux:heading>

        <table class="table-auto w-full rounded-md overflow-hidden shadow-md">
            <thead class="bg-gray-300 dark:bg-slate-900 text-black dark:text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Likes</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100 dark:bg-slate-800">
                @foreach ($bills as $bill)
                    <tr class="border-b border-gray-300 dark:border-slate-700">
                        <td class="px-4 py-2 text-black dark:text-white">{{ $bill->title }}</td>
                        <td class="px-4 py-2 text-center">{{ $bill->likes_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end mt-4">
            <flux:modal.close>
                <flux:button variant="ghost">Close</flux:button>
            </flux:modal.close>
        </div>
    </div>
</flux:modal>

{{-- Dislikes Summary Modal --}}
<flux:modal name="dislikes-summary" class="min-w-[30rem] max-h-[60vh] overflow-auto">
    <div class="space-y-4">
        <flux:heading size="lg">Bills Dislikes Summary</flux:heading>

        <table class="table-auto w-full rounded-md overflow-hidden shadow-md">
            <thead class="bg-gray-300 dark:bg-slate-900 text-black dark:text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Dislikes</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100 dark:bg-slate-800">
                @foreach ($bills as $bill)
                    <tr class="border-b border-gray-300 dark:border-slate-700 hover:bg-lime-100 dark:hover:bg-lime-700 transition-colors">
                        <td class="px-4 py-2 text-black dark:text-white">{{ $bill->title }}</td>
                        <td class="px-4 py-2 text-center">{{ $bill->dislikes_count ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end mt-4">
            <flux:modal.close>
                <flux:button variant="ghost">Close</flux:button>
            </flux:modal.close>
        </div>
    </div>
</flux:modal>


<flux:modal name="all-users" class="min-w-[30rem] max-h-[60vh] overflow-auto">
    <div class="space-y-4">
        <flux:heading size="lg">All Users</flux:heading>

        <table class="table-auto w-full rounded-md overflow-hidden shadow-md">
            <thead class="bg-gray-300 dark:bg-slate-900 text-black dark:text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Role</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100 dark:bg-slate-800">
                @foreach ($users as $user)
                <tr class="border-b border-gray-300 dark:border-slate-700 hover:bg-lime-100 dark:hover:bg-lime-700 transition-colors">
                    <td class="px-4 py-2 text-black dark:text-white">{{ $user->name }}</td>
                    <td class="px-4 py-2 text-black dark:text-white">{{ $user->email }}</td>
                    <td class="px-4 py-2 text-black dark:text-white">{{ ucfirst($user->role->value) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end mt-4">
            <flux:modal.close>
                <flux:button variant="ghost">Close</flux:button>
            </flux:modal.close>
        </div>
    </div>
</flux:modal>

</x-layouts.app>
