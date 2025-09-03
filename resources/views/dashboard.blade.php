<x-layouts.app :title="__('Bills')"> 
    {{-- Main content area --}}
    <div class="flex-1 overflow-y-auto p-2 md:p-4">
        <!-- Enhanced Header Section -->
        <div class="relative mb-4 md:mb-8 w-full">
            <div class="flex items-center gap-3 mb-3 md:mb-4">
                <div class="p-1.5 md:p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 md:w-6 md:h-6 text-green-600 dark:text-green-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <flux:heading size="lg" level="1" class="text-gray-900 dark:text-white text-lg md:text-2xl">
                        {{ __('Active Bills') }}
                    </flux:heading>
                    <flux:subheading size="sm" class="text-gray-600 dark:text-gray-300 mt-1 text-sm md:text-base">
                        {{ __('Review and vote on current legislation') }}
                    </flux:subheading>
                </div>
            </div>
            <flux:separator variant="subtle" class="mt-4 md:mt-6" />
        </div>

        <!-- Bills Grid -->
        <div class="grid gap-4 md:gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($bills as $bill)
                <div class="group relative overflow-hidden rounded-xl md:rounded-2xl border-2 border-green-200 dark:border-green-800/50 shadow-md hover:shadow-2xl hover:scale-[1.01] md:hover:scale-[1.03] hover:border-green-300 dark:hover:border-green-700 transition-all duration-300 ease-in-out bg-white dark:bg-gray-800">
                    
                    <!-- Status Badge -->
                    <div class="absolute top-2 md:top-4 right-2 md:right-4 z-10">
                        <span class="inline-flex items-center gap-1 md:gap-1.5 px-2 py-1 md:px-3 md:py-1.5 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-full shadow-sm">
                            <div class="w-1.5 h-1.5 md:w-2 md:h-2 bg-green-500 rounded-full animate-pulse"></div>
                            {{ __('Active') }}
                        </span>
                    </div>

                    <div class="p-4 md:p-6 h-full flex flex-col">
                        <!-- Bill Content -->
                        <div class="flex-1 pr-16 md:pr-20">
                            <a href="{{ route('bill', $bill->id) }}" class="block">
                                @if (str_word_count(strip_tags($bill->title)) > 10)
                                    {{-- Title only (no content, no clamp) --}}
                                    <h2 class="text-base md:text-lg font-bold text-gray-900 dark:text-white mb-2 md:mb-3 group-hover:text-green-700 dark:group-hover:text-green-300 transition-colors duration-200 leading-tight">
                                        {{ $bill->title }}
                                    </h2>
                                @else
                                    {{-- Title + Content --}}
                                    <h2 class="text-base md:text-lg font-bold text-gray-900 dark:text-white mb-2 md:mb-3 group-hover:text-green-700 dark:group-hover:text-green-300 transition-colors duration-200 line-clamp-2 leading-tight">
                                        {{ $bill->title }}
                                    </h2>

                                    <p class="text-xs md:text-sm text-gray-700 dark:text-gray-300 line-clamp-3 md:line-clamp-4 leading-relaxed mb-3 md:mb-4">
                                        {{ $bill->content }}
                                    </p>
                                @endif
                                
                                <!-- Author and Date - Mobile Stack -->
                                <div class="flex flex-col md:flex-row md:items-center md:gap-4 gap-1 text-xs text-gray-600 dark:text-gray-400">
                                    <div class="flex items-center gap-1.5 md:gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-3 h-3 md:w-4 md:h-4 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        <span class="truncate">{{ $bill->authored_by ?? 'Unknown' }}</span>
                                    </div>

                                    <p class="text-gray-500 dark:text-gray-400 text-xs">
                                        {{ __('Published') }} {{ $bill->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Interactive Section -->
                        <div class="mt-6 md:mt-10 space-y-3 md:space-y-4">
                            <!-- Mobile: Stack likes and due date vertically -->
                            <div class="flex flex-col md:flex-row md:justify-between gap-3 md:gap-0">
                                <!-- Likes Summary -->
                                <div class="order-2 md:order-1">
                                    <div class="inline-flex items-center gap-1.5 md:gap-2 px-2.5 py-1 md:px-3 md:py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-full border border-red-200 dark:border-red-800/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 md:w-4 md:h-4">
                                            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                        </svg>
                                        <span class="text-xs md:text-sm font-medium">{{ $bill->likes }} liked</span>
                                    </div>
                                </div>

                                <!-- Due Date - Prominent Display -->
                                <div class="order-1 md:order-2">
                                    <div class="inline-flex items-center gap-1.5 md:gap-2 px-2.5 py-1.5 md:px-3 md:py-2 rounded-lg 
                                        @if ($bill->due_date->isToday()) 
                                            bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-800
                                        @elseif ($bill->due_date->diffInDays() <= 3)
                                            bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800
                                        @else
                                            bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800
                                        @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 md:w-4 md:h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-xs md:text-sm font-medium">
                                            @if ($bill->due_date->isToday())
                                                {{ __('Due Today!') }}
                                            @elseif ($bill->due_date->diffInDays() <= 3)
                                                {{ __('Due') }} {{ $bill->due_date->diffForHumans() }}
                                            @else
                                                {{ __('Due') }} {{ $bill->due_date->format('M j') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Bill Metadata -->
                            <div class="flex justify-between items-center pt-2 md:pt-3 border-t border-gray-200 dark:border-gray-600">
                                <div class="flex items-center gap-1 md:gap-1.5 text-xs text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 md:w-3.5 md:h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                                    </svg>
                                    <span class="font-medium">{{ number_format($bill->comments_count) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!--  Empty State -->
                <div class="col-span-full flex flex-col justify-center items-center py-12 md:py-16 text-center px-4">
                    <div class="relative mb-4 md:mb-6">
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 md:w-10 md:h-10 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0-1.125.504-1.125 1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 md:w-8 md:h-8 bg-blue-500 rounded-full flex items-center justify-center animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 md:w-4 md:h-4 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('No Active Bills') }}
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm md:text-base max-w-md">
                        {{ __('There are currently no active bills to review. New legislation will appear here when available for voting.') }}
                    </p>
                </div>
            @endforelse
        </div>
    </div>
    <div class="mt-4 px-2 md:px-4">
        {{ $bills->links() }}
    </div>
</x-layouts.app>