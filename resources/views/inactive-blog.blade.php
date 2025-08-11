<x-layouts.app>
<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <a href="/inactive-bills" class="flex underlined">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg><small class="mt-1 ml-2">Back</small>
    </a>

    <div class="p-6 center">
        <div class="max-w-3xl mx-auto mt-10 p-6 bg-white dark:bg-zinc-800 rounded-xl shadow-md space-y-4">
            <h1 class="text-3xl font-bold text-center text-gray-800 dark:text-white">
                {{ $note->title }}
            </h1>
            <flux:separator />
            <p class="text-xl text-zinc-600 dark:text-zinc-300 leading-relaxed">
                {!! nl2br(e($note->content)) !!}
            </p>

            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-6">
                Published {{ $note->created_at->diffForHumans() }}
            </p>
            <div class="flex justify-between items-center">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    Authored by {{ $note->authored_by ?? 'Unknown' }}
                </p>
                <em class="text-sm text-zinc-500 dark:text-zinc-400">
                    {{ $note->likes }} people liked this
                </em>
            </div>
        </div>

        {{-- Comment Area --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Comments</h2>

            @if ($note->comments->isEmpty())
                <p class="text-sm text-gray-500 dark:text-gray-400 italic">No one commented.</p>
            @else
                <div class="space-y-4">
                    @foreach ($note->comments as $comment)
                        <div class="p-4 bg-zinc-100 dark:bg-zinc-700 rounded-lg shadow">
                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                {{ $comment->user->name ?? 'Anonymous' }} said:
                            </p>
                            <p class="text-base text-zinc-700 dark:text-zinc-300 mt-1">
                                {{ $comment->content }}
                            </p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-2">
                                {{ $comment->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
</x-layouts.app>
