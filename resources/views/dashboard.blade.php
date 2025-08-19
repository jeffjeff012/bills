<x-layouts.app :title="__('Bills')"> 
    {{-- Main content area --}}
    <div class="flex-1 overflow-y-auto p-2">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">{{ __('Active Bills') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">{{ __('Review bills') }}</flux:subheading>
            <flux:separator variant="subtle" />
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
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
                                @if (\Carbon\Carbon::parse($bill->due_date)->isToday())
                                    Today
                                @else
                                    {{ \Carbon\Carbon::parse($bill->due_date)->format('F j, Y') }}
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
</x-layouts.app>
