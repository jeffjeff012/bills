<x-layouts.app :title="__('Bills')"> 
        {{-- Sidebar stays fixed from x-layouts.app --}}

        {{-- Main content area --}}
        <div class="flex-1 overflow-y-auto p-2">
            <div class="relative mb-6 w-full">
                <flux:heading size="xl" level="1">{{ __('Active Bills') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('Review bills') }}</flux:subheading>
                <flux:separator variant="subtle" />
            </div>

            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                @foreach ($notes as $note)
                    <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 shadow-sm 
                                hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out cursor-pointer">
                        <div class="p-6 h-full flex flex-col justify-between">
                            <div>
                                <a href="{{ route('blog', $note->id) }}">
                                    <h2 class="text-md font-semibold text-gray-800 dark:text-white mb-1">
                                        {{ $note->title }}
                                    </h2>

                                    <p class="text-sm text-zinc-600 dark:text-zinc-300 line-clamp-3">
                                        {{ $note->content }}
                                    </p>

                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-3">
                                        Published {{ $note->created_at->diffForHumans() }}
                                    </p>
                                </a>
                            </div>

                            <br>
                            <br>

                            <div class="mt-4">
                                <livewire:note-like-dislike :note="$note" :key="$note->id" />

                                <p class="text-xs text-red-400 mt-2">
                                    Due: 
                                    @if (\Carbon\Carbon::parse($note->due_date)->isToday())
                                        Today
                                    @else
                                        {{ \Carbon\Carbon::parse($note->due_date)->format('F j, Y') }}
                                    @endif
                                </p>

                                <div class="flex justify-between items-center mt-2">
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                        Authored by {{ $note->authored_by ?? 'Unknown' }}
                                    </p>
                                    <p class="text-right text-sm text-white-600 flex items-center gap-1">
                                        <flux:icon name="chat-bubble-left" class="w-4 h-4" />
                                        {{ $note->comments_count }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</x-layouts.app>
