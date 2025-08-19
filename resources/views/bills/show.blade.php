<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bill Previews</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen p-6">
    <div class="max-w-5xl mx-auto space-y-8">
        <div class="flex items-center justify-between mb-6">
            <!-- Back Button -->
            <a href="/" class="flex items-center text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <small class="ml-2">Back</small>
            </a>

            <!-- Title -->
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white text-center flex-1">
                📜 Bill Previews
            </h1>

            <!-- Spacer for symmetry -->
            <div class="w-12"></div>
        </div>


        @foreach($bills as $bill)
            <!-- Bill Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                        {{ $bill->title }}
                    </h2>

                    <p class="text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">
                        {{ $bill->content }}
                    </p>
                </div>

                <!-- Footer: Stats -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 flex items-center justify-between">
                    <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-300">
                        <span class="flex items-center gap-1">
                            👍 {{ $bill->likes_count }}
                        </span>
                        <span class="flex items-center gap-1">
                            💬 {{ $bill->comments_count }}
                        </span>
                    </div>
                </div>


                <!-- Comments Section -->
                <div class="px-6 pb-6">
                    <h3 class="text-lg font-semibold mt-4 mb-3">
                        Comments ({{ $bill->comments->count() }})
                    </h3>

                    @forelse($bill->comments as $comment)
                        <div class="mb-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-md">
                            <p class="text-gray-800 dark:text-gray-200">
                                {{ $comment->content }}
                            </p>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                — {{ $comment->user->name ?? 'Guest' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500">No comments yet.</p>
                    @endforelse
                </div>
            </div>
        @endforeach

    </div>

</body>
</html>
