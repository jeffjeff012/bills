<x-layouts.app :title="__('Bills')">
    <div class="mx-auto max-w-3xl py-10 sm:px-6 lg:px-8">

        @php
            $user = auth()->user();
            $backUrl = match($user->role) {
                \App\Enums\UserRole::Admin, \App\Enums\UserRole::SbStaff => '/bills',
                default => '/dashboard',
            };
        @endphp

        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ $backUrl }}"
                class="group inline-flex items-center gap-2 text-sm text-gray-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                Back to Bills
            </a>
        </div>

        <!-- Article Header -->
        <div class="mb-8">

            <!-- Category tag -->
            <div class="mb-4">
                <span class="inline-block text-xs font-semibold uppercase tracking-widest text-blue-600 dark:text-blue-400">
                    Municipal Bill
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-3xl sm:text-4xl font-semibold leading-tight tracking-tight text-gray-900 dark:text-white mb-5">
                {{ $bill->title }}
            </h1>

            <!-- Meta bar -->
            <div class="flex flex-wrap items-center gap-x-6 gap-y-3 py-4 border-t border-b border-gray-200 dark:border-zinc-700 text-sm">

                <!-- Author/Sponsor -->
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-xs font-semibold text-blue-700 dark:text-blue-300 shrink-0">
                        @if ($bill->contributorType === 'author')
                            {{ strtoupper(substr($bill->authored_by ?? 'U', 0, 2)) }}
                        @elseif ($bill->contributorType === 'sponsor')
                            {{ strtoupper(substr($bill->committee->name ?? 'U', 0, 2)) }}
                        @else
                            UN
                        @endif
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 dark:text-zinc-500 leading-none mb-0.5">
                            @if ($bill->contributorType === 'author') Authored by
                            @elseif ($bill->contributorType === 'sponsor') Sponsored by
                            @else Contributor
                            @endif
                        </p>
                        <p class="font-medium text-gray-900 dark:text-white leading-none">
                            @if ($bill->contributorType === 'author') {{ $bill->authored_by }}
                            @elseif ($bill->contributorType === 'sponsor') {{ $bill->committee->name ?? 'N/A' }}
                            @else Unknown
                            @endif
                        </p>
                    </div>
                </div>

                <div class="h-8 w-px bg-gray-200 dark:bg-zinc-700 hidden sm:block"></div>

                <!-- Published -->
                <div>
                    <p class="text-xs text-gray-400 dark:text-zinc-500 leading-none mb-0.5">Published</p>
                    <p class="font-medium text-gray-900 dark:text-white leading-none">{{ $bill->created_at->diffForHumans() }}</p>
                </div>

                <div class="h-8 w-px bg-gray-200 dark:bg-zinc-700 hidden sm:block"></div>

                <!-- Reading time -->
                <div>
                    <p class="text-xs text-gray-400 dark:text-zinc-500 leading-none mb-0.5">Reading time</p>
                    <p class="font-medium text-gray-900 dark:text-white leading-none">
                        {{ max(1, (int) ceil(str_word_count(strip_tags($bill->content)) / 200)) }} min read
                    </p>
                </div>

                <!-- Status badge pushed to the right -->
                <div class="sm:ml-auto">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300 ring-1 ring-inset ring-blue-200 dark:ring-blue-700">
                        Under Review
                    </span>
                </div>
            </div>
        </div>

        <!-- Article Body -->
        <div class="prose prose-lg max-w-none dark:prose-invert
                    prose-p:text-gray-700 dark:prose-p:text-zinc-300
                    prose-p:leading-relaxed prose-p:mb-5
                    prose-headings:font-semibold prose-headings:tracking-tight
                    mb-10">
            {!! nl2br(e($bill->content)) !!}
        </div>

        <!-- PDF Attachment -->
        @if ($bill->attachment)
            <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-800/60 mb-10">
                <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 dark:text-zinc-500 mb-0.5">Full bill document</p>
                    <a href="{{ Storage::url($bill->attachment) }}" target="_blank"
                        class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors inline-flex items-center gap-1">
                        View PDF Attachment
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>
        @endif

        <!-- Reactions Section -->
        @if (auth()->user()->role === \App\Enums\UserRole::User)
            <div class="mb-10">
                <div class="flex items-center gap-4 mb-5">
                    <div class="flex-1 h-px bg-gray-200 dark:bg-zinc-700"></div>
                    <span class="text-xs font-semibold uppercase tracking-widest text-gray-400 dark:text-zinc-500">Your Reaction</span>
                    <div class="flex-1 h-px bg-gray-200 dark:bg-zinc-700"></div>
                </div>
                <div class="flex justify-center">
                    <livewire:note-like-dislike :bill="$bill" :key="$bill->id" />
                </div>
            </div>
        @endif

        <!-- Comments Section -->
        <div>
            <div class="flex items-center gap-4 mb-8">
                <div class="flex-1 h-px bg-gray-200 dark:bg-zinc-700"></div>
                <span class="text-xs font-semibold uppercase tracking-widest text-gray-400 dark:text-zinc-500">Comments</span>
                <div class="flex-1 h-px bg-gray-200 dark:bg-zinc-700"></div>
            </div>

            <livewire:comment-section :bill="$bill" />
        </div>

    </div>
</x-layouts.app>