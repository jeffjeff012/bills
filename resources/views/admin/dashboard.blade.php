<x-layouts.app :title="__('Admin Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Administrator') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your Bills and Data') }}</flux:subheading>
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
        <a href="{{ url('admin/user-management') }}">
            <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 p-6 rounded-xl shadow-md dark:shadow-gray-900/20 hover:shadow-xl dark:hover:shadow-gray-900/40 hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium uppercase text-gray-600 dark:text-gray-400">Users</h2>
                        <p class="text-3xl font-bold mt-2 border-2 bg-blue-100 dark:bg-blue-900/30 dark:border-blue-700 rounded-lg px-3 py-1 inline-block text-blue-500 dark:text-blue-400">{{ $userCount }}</p>
                    </div>
                    <flux:icon name="user-group" class="w-10 h-10 text-gray-500 dark:text-gray-400" />
                </div>
            </div>
        </a>

        <!-- Bills Created -->
        <a href="/report-of-bills">
            <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 p-6 rounded-xl shadow-md dark:shadow-gray-900/20 hover:shadow-xl dark:hover:shadow-gray-900/40 hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium uppercase text-gray-600 dark:text-gray-400">Bills Created</h2>
                        <p class="text-3xl font-bold mt-2 border-2 bg-blue-100 dark:bg-blue-900/30 dark:border-blue-700 rounded-lg px-3 py-1 inline-block text-blue-500 dark:text-blue-400">{{ $billCount }}</p>
                    </div>
                    <flux:icon name="scale" class="w-10 h-10 text-gray-500 dark:text-gray-400" />
                </div>
            </div>
        </a>

        <!-- Likes -->
        <a href="/report-of-bills">
            <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 p-6 rounded-xl shadow-md dark:shadow-gray-900/20 hover:shadow-xl dark:hover:shadow-gray-900/40 hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium uppercase text-gray-600 dark:text-gray-400">Likes</h2>
                        <p class="text-3xl font-bold mt-2 border-2 bg-blue-100 dark:bg-blue-900/30 dark:border-blue-700 rounded-lg px-3 py-1 inline-block text-blue-500 dark:text-blue-400">{{ $totalLikes }}</p>
                    </div>
                    <flux:icon name="hand-thumb-up" class="w-10 h-10 text-gray-500 dark:text-gray-400" />
                </div>
            </div>
        </a>

        <!-- Dislikes -->
        <a href="/report-of-bills">
            <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 p-6 rounded-xl shadow-md dark:shadow-gray-900/20 hover:shadow-xl dark:hover:shadow-gray-900/40 hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium uppercase text-gray-600 dark:text-gray-400">Dislikes</h2>
                        <p class="text-3xl font-bold mt-2 border-2 bg-blue-100 dark:bg-blue-900/30 dark:border-blue-700 rounded-lg px-3 py-1 inline-block text-blue-500 dark:text-blue-400">{{ $totalDislikes }}</p>
                    </div>
                    <flux:icon name="hand-thumb-down" class="w-10 h-10 text-gray-500 dark:text-gray-400" />
                </div>
            </div>
        </a>
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
                        <div class="px-6 py-4 bg-red-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-600">
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
                                @if($hotBill)
                                    <a href="{{ route('bill', $hotBill->id) }}"
                                    class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
                                    View Bill →
                                    </a>
                                @endif
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
                        <div class="px-6 py-4 bg-blue-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-600">
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
                                @if($mostCommentedBill)
                                    <a href="{{ route('bill', $mostCommentedBill->id) }}"
                                    class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
                                    View Bill →
                                    </a>
                                @endif
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
</div>
</x-layouts.app>



