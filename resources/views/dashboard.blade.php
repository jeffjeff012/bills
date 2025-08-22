<x-layouts.app :title="__('Bills')"> 
    {{-- Main content area --}}
    <div class="flex-1 overflow-y-auto p-2">
        <!-- Enhanced Header Section -->
        <div class="relative mb-8 w-full">
            <div class="flex items-center gap-3 mb-4">
                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-green-600 dark:text-green-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <flux:heading size="xl" level="1" class="text-gray-900 dark:text-white">
                        {{ __('Active Bills') }}
                    </flux:heading>
                    <flux:subheading size="lg" class="text-gray-600 dark:text-gray-300 mt-1">
                        {{ __('Review and vote on current legislation') }}
                    </flux:subheading>
                </div>
            </div>
            <flux:separator variant="subtle" class="mt-6" />
        </div>

        <!-- Bills Grid -->
        <div class="grid auto-rows-min gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($bills as $bill)
                <div class="group relative overflow-hidden rounded-2xl border-2 border-green-200 dark:border-green-800/50 bg-gradient-to-br from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-900 shadow-md hover:shadow-2xl hover:scale-[1.03] hover:border-green-300 dark:hover:border-green-700 transition-all duration-300 ease-in-out">
                    
                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4 z-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-full shadow-sm">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            {{ __('Active') }}
                        </span>
                    </div>

                    <div class="p-6 h-full flex flex-col">
                        <!-- Bill Content -->
                        <div class="flex-1 pr-20">
                            <a href="{{ route('bill', $bill->id) }}" class="block">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3 group-hover:text-green-700 dark:group-hover:text-green-300 transition-colors duration-200 line-clamp-2 leading-tight">
                                    {{ $bill->title }}
                                </h2>

                                <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-4 leading-relaxed mb-4">
                                    {{ $bill->content }}
                                </p>

                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                                    {{ __('Published') }} {{ $bill->created_at->diffForHumans() }}
                                </p>
                            </a>
                        </div>
                        
                        <!-- Interactive Section -->
                        <div class="mt-auto space-y-4">
                            <!-- Big Like/Dislike Buttons -->
                            <div class="flex justify-center">
                                <div class="bg-white dark:bg-gray-700 rounded-2xl p-3 shadow-lg border border-gray-200 dark:border-gray-600">
                                    <livewire:note-like-dislike :bill="$bill" :key="$bill->id" />
                                </div>
                            </div>

                            <!-- Due Date - Prominent Display -->
                            <div class="text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-2 rounded-lg 
                                    @if ($bill->due_date->isToday()) 
                                        bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-800
                                    @elseif ($bill->due_date->diffInDays() <= 3)
                                        bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800
                                    @else
                                        bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800
                                    @endif">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium">
                                        @if ($bill->due_date->isToday())
                                            {{ __('Due Today!') }}
                                        @elseif ($bill->due_date->diffInDays() <= 3)
                                            {{ __('Due') }} {{ $bill->due_date->diffForHumans() }}
                                        @else
                                            {{ __('Due') }} {{ $bill->due_date->format('M j, Y') }}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <!-- Bill Metadata -->
                            <div class="flex justify-between items-center pt-3 border-t border-gray-200 dark:border-gray-600">
                                <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    <span class="truncate max-w-20">{{ $bill->authored_by ?? 'Unknown' }}</span>
                                </div>
                                
                                <div class="flex items-center gap-1.5 text-xs text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                                    </svg>
                                    <span class="font-medium">{{ number_format($bill->comments_count) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hover Indicator -->
                    <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600 dark:text-green-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                    </div>
                </div>
            @empty
                <!-- Enhanced Empty State -->
                <div class="col-span-full flex flex-col justify-center items-center py-16 text-center">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0-1.125.504-1.125 1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('No Active Bills') }}
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-base max-w-md">
                        {{ __('There are currently no active bills to review. New legislation will appear here when available for voting.') }}
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>



{{-- <x-layouts.app :title="('Bills')"> 
    <div class="flex-1 overflow-y-auto p-2">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">{{ ('Active Bills') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">{{ __('Review bills') }}</flux:subheading>
            <flux:separator variant="subtle" />
        </div> --}}

        {{-- <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @forelse ($bills as $bill)
                <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 shadow-sm 
                            hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer">
                    <div class="p-6 h-full flex flex-col justify-between">
                        <div>
                            <a href="{{ route('bill', $bill->id) }}">
                                <h2 class="text-md font-semibold text-gray-800 dark:text-white mb-1">
                                    {{ $bill->title }}
                                </h2>

                                <p class="text-sm text-zinc-600 dark:text-zinc-300 line-clamp-3">
                                    {{ $bill->content }}
                                </p>

                                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-3">
                                    Published {{ $bill->created_at->diffForHumans() }}
                                </p>
                            </a>
                        </div>

                        <div class="mt-15">
                            <livewire:note-like-dislike :bill="$bill" :key="$bill->id" />

                            <p class="text-xs text-red-400 mt-2">
                                Due: 
                                @if ($bill->due_date->isToday())
                                    Today
                                @else
                                    {{ $bill->due_date->format('F j, Y') }}
                                @endif

                            </p>

                            <div class="flex justify-between items-center mt-2">
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                    Authored by {{ $bill->authored_by ?? 'Unknown' }}
                                </p>
                                <p class="text-right text-sm text-white-600 flex items-center gap-1">
                                    <flux:icon name="chat-bubble-left" class="w-4 h-4" />
                                    {{ $bill->comments_count }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div class="col-span-full flex flex-col justify-center items-center py-12 space-y-3">
                <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z"/>
                    <path d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z"/>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">
                    No bills for now, seat back.
                </p>
            </div>
            @endforelse
        </div>
    </div>
</x-layouts.app> --}}