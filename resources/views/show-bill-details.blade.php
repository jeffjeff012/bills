<x-layouts.app :title="'Bill Details'">
    <div class="max-w-3xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">{{ $bill->title }}</h1>
        <p class="text-gray-700 dark:text-gray-300 mb-6">{{ $bill->content }}</p>

        <!-- Due Date -->
        <div class="text-sm text-gray-500 mb-6">
            Due: {{ \Carbon\Carbon::parse($bill->due_date)->diffForHumans() }}
        </div>

        <!-- Likes/Dislikes -->
        <div class="flex gap-4 mb-6">
            <div>👍 {{ number_format($bill->likes) }}</div>
            <div>👎 {{ number_format($bill->dislikes) }}</div>
        </div>

        <!-- Comments Section -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Comments ({{ $bill->comments->count() }})</h2>
            @forelse($bill->comments as $comment)
                <div class="mb-3 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
                    <div class="text-sm text-gray-500 mb-1">{{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}</div>
                    <div class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</div>
                </div>
            @empty
                <p class="text-gray-500">No comments yet.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
