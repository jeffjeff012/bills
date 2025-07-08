<div class="container mx-auto px-4">
    <div class="w-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($notes as $note)
            <a href="{{ route('notes.show', $note) }}" aria-label="View Note">
                <div class="p-6 border border-black rounded-md bg-white dark:bg-zinc-800 shadow-sm hover:shadow-md hover:bg-zinc-50 dark:hover:bg-zinc-700 transition">
                    <h2 class="text-md font-semibold text-gray-800 dark:text-white mb-1">{{ $note->title }}</h2>
                    <p class="text-sm text-zinc-600 dark:text-zinc-300 line-clamp-3">{{ $note->content }}</p>

<br>
<br>
                     <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-3">Published {{ $note->created_at->diffForHumans() }}</p>
                </div>
           
            </a>
        @endforeach
    </div>
</div>
