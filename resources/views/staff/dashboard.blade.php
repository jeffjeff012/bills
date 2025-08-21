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

{{-- Container for both cards --}}
<div class="flex flex-col lg:flex-row gap-8 mt-15">
    
    {{-- Most Liked Bill Card --}}
    <div class="flex-1">
        <div class="w-full max-w-2xl mx-auto"> 
            @if($hotBill)
                <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    
                    {{-- HOT Badge --}}
                    <div class="absolute top-4 right-4 z-10">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-red-500 to-orange-500 text-white shadow-lg">
                            <span class="mr-1">🔥</span>
                            HOT
                        </span>
                    </div>

                    {{-- Card Header --}}
                    <div class="px-6 pt-6 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Most Liked Bill
                        </h3>
                    </div>

                    {{-- Card Body --}}
                    <div class="px-6 pb-4">
                        <h4 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">
                            {{ $hotBill->title }}
                        </h4>
                        <p class="text-gray-600 dark:text-gray-300 line-clamp-3 leading-relaxed">
                            {{ Str::limit($hotBill->content, 150) }}
                        </p>
                    </div>

                    {{-- Card Footer --}}
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-600">
                        <div class="flex items-center justify-between">
                            {{-- Likes count --}}
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $hotBill->likes_count }} likes
                                </span>
                            </div>
                            
                            {{-- Action button --}}
                            <a href="{{ route('report-of-bills') }}" 
   class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
    View Details →
</a>

                        </div>
                    </div>
                </div>
            @else
                {{-- Empty state card --}}
                <div class="w-full">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No bills yet</h3>
                        <p class="text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                            The bill with the most likes will appear here
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Most Commented Bill Card --}}
    <div class="flex-1">
        <div class="w-full max-w-2xl mx-auto"> 
            @if($mostCommentedBill)
                <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    
                    {{-- TRENDING Badge --}}
                    <div class="absolute top-4 right-4 z-10">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-500 to-purple-500 text-white shadow-lg">
                            <span class="mr-1">💬</span>
                            TRENDING
                        </span>
                    </div>

                    {{-- Card Header --}}
                    <div class="px-6 pt-6 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Most Discussed Bill
                        </h3>
                    </div>

                    {{-- Card Body --}}
                    <div class="px-6 pb-4">
                        <h4 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">
                            {{ $mostCommentedBill->title }}
                        </h4>
                        <p class="text-gray-600 dark:text-gray-300 line-clamp-3 leading-relaxed">
                            {{ Str::limit($mostCommentedBill->content, 150) }}
                        </p>
                    </div>

                    {{-- Card Footer --}}
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-600">
                        <div class="flex items-center justify-between">
                            {{-- Comments count --}}
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $mostCommentedBill->comments_count }} comments
                                </span>
                            </div>
                            
                            {{-- Action button --}}
                            <a href="{{ route('report-of-bills') }}" 
   class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
    View Details →
</a>

                        </div>
                    </div>
                </div>
            @else
                {{-- Empty state card --}}
                <div class="w-full">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No bills yet</h3>
                        <p class="text-gray-500 dark:text-gray-400 max-w-sm mx-auto">
                            The bill with the most comments will appear here
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
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
