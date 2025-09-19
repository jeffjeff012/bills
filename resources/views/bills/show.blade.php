<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Overview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/images/final.png" type="image/svg+xml">
</head>
<body class="bg-gray-100 dark:bg-gray-900 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Back to Home Button -->
        <div class="mb-6">
            <a href="/other-bills" class="group inline-flex items-center px-6 py-3 rounded-full bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200/50 dark:border-gray-700/50 hover:border-blue-300 dark:hover:border-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-600 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span class="ml-2 font-medium text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                    Back to Home
                </span>
            </a>
        </div>
        <!-- Bill Card -->
        <div class="bg-white dark:bg-black-300 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-blue-50 dark:bg-blue-900/20 px-6 py-6">
                <div class="flex items-center gap-4 flex-wrap">
                    <h2 class="text-lg sm:text-2xl font-bold text-gray-900 dark:text-black">
                        {{ $bill->title }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-zinc-800 px-3 py-1 rounded-lg">
                        Authored by <span class="font-medium text-gray-800 dark:text-gray-200">{{ $bill->authored_by }}</span>
                    </p>
                </div>

                @if ($bill->attachment)
                <div class="flex mt-3 items-center gap-4 p-4 bg-blue-50 dark:bg-gray-800 border border-blue-200 dark:border-gray-700 rounded-lg shadow-sm">
                    <!-- Icon -->
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-md bg-blue-100 dark:bg-blue-900/40">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4v16m0-16H6a2 2 0 00-2 2v12a2 2 0 002 2h6" />
                        </svg>
                    </div>

                    <!-- Text + Button -->
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-blue-900 dark:text-blue-100">
                            PDF Attachment Available
                        </h3>
                        <a href="{{ Storage::url($bill->attachment) }}" target="_blank" 
                            class="inline-flex items-center mt-1 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium text-sm transition-colors duration-200">
                            <span>View PDF Attachment</span>
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endif


                <p class="text-gray-700 dark:text-gray-800 leading-relaxed">
                    {{ $bill->content ?? 'This legislation aims to reform healthcare accessibility and reduce costs through innovative policy measures.' }}
                </p>
            </div>

            <!-- Comments Section -->
            <div class="px-6 py-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                    Comments ({{ $bill->comments->count() ?? '3' }})
                </h3>
                <livewire:comment-section :bill="$bill" :readonly="true" />
                {{-- @php
                    $sampleComments = [
                        ['user' => 'Dr. Sarah Johnson', 'content' => 'This bill addresses critical healthcare gaps. The funding mechanisms are well-structured.'],
                        ['user' => 'Michael Chen', 'content' => 'I support the direction, but we need more specific implementation timelines.'],
                        ['user' => 'Healthcare Union', 'content' => 'The workforce development provisions could improve working conditions significantly.']
                    ];
                @endphp

                @forelse($bill->comments ?? $sampleComments as $comment)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-md p-4 mb-3 border border-gray-200 dark:border-gray-600">
                        <div class="font-semibold text-gray-900 dark:text-white mb-1">
                            {{ is_array($comment) ? $comment['user'] : ($comment->user->name ?? 'Guest') }}
                        </div>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ is_array($comment) ? $comment['content'] : $comment->content }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                        No comments yet.
                    </p>
                @endforelse --}}
            </div>
        </div>
    </div>
</body>
</html>