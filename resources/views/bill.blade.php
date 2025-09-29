<x-layouts.app :title="__('Bills')">
    <div class="mx-auto max-w-5xl py-8 sm:px-6 lg:px-8">
        <!--content -->

        @php
            $user = auth()->user();
            $backUrl = match($user->role) {
                \App\Enums\UserRole::Admin, \App\Enums\UserRole::SbStaff => '/bills',
                default => '/dashboard',
            };
        @endphp

        <!-- Enhanced Back Button -->
        <div class="mb-8">
            <a href="{{ $backUrl }}"
                class="group inline-flex items-center px-4 py-2 rounded-lg bg-white dark:bg-zinc-800 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-200 dark:border-zinc-700 hover:border-blue-300 dark:hover:border-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 text-gray-500 dark:text-zinc-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span
                    class="ml-2 text-sm font-medium text-gray-700 dark:text-zinc-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                    Back
                </span>
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="relative">
            <div
                class="max-w-4xl mx-auto bg-white dark:bg-zinc-800 rounded-2xl shadow-xl border border-gray-100 dark:border-zinc-700 overflow-hidden">

                <!-- Header Section with Gradient -->
                <div class="relative bg-gradient-to-r from-blue-600 via-skyblue-600 to-blue-500 px-8 py-12">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative z-10">
                        <h1 class="text-lg sm:text-4xl font-bold text-center text-white leading-tight">
                            {{ $bill->title }}
                        </h1>
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute top-4 left-4 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
                    <div class="absolute bottom-4 right-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                <div class="flex items-center justify-center space-x-3 mt-5">
                    <div class="w-10 h-10 bg-gray-100 dark:bg-zinc-700 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600 dark:text-zinc-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="flex ">
                        @if ($bill->contributorType === 'author')
                            <p class="text-xs lg:text-lg font-medium text-gray-900 dark:text-white">Authored by</p>
                            <p class="ml-1 text-xs lg:text-lg text-gray-500 dark:text-zinc-400">
                                <span class="truncate">{{ $bill->authored_by }}</span>
                            </p>
                        @elseif($bill->contributorType === 'sponsor')
                            <p class="text-xs lg:text-lg font-medium text-gray-900 dark:text-white">Sponsored by</p>
                            <p class="ml-1 text-xs lg:text-lg text-gray-500 dark:text-zinc-400">
                                <span class="truncate">{{ $bill->sponsored_by }}</span>
                            </p>
                        @else
                            <p class="text-xs lg:text-lg font-medium text-gray-900 dark:text-white">Contributor</p>
                            <p class="ml-1 text-xs lg:text-lg text-gray-500 dark:text-zinc-400">
                                <span class="truncate">Unknown</span>
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Content Section -->
                <div class="px-6 sm:px-10 md:px-16 lg:px-20 py-8 space-y-8">

                    <!-- Bill Content -->
                    <div class="prose prose-lg max-w-none dark:prose-invert prose-p:m-0 prose-headings:m-0">
                        <div class="text-gray-700 dark:text-zinc-300 leading-relaxed text-xs lg:text-lg  font-light">
                            {!! nl2br(e($bill->content)) !!}
                        </div>
                    </div>

                    <!-- Attachment Section -->
                    @if ($bill->attachment)
                        <div
                            class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-blue-100 dark:bg-blue-800 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-blue-900 dark:text-blue-100">
                                        Continue reading
                                    </h3>
                                    <a href="{{ Storage::url($bill->attachment) }}" target="_blank"
                                        class="inline-flex items-center mt-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium text-sm transition-colors duration-200">
                                        <span>View PDF Attachment</span>
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Separator -->
                    <div class="border-t border-gray-200 dark:border-zinc-700"></div>

                    <!-- Meta Information -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gray-100 dark:bg-zinc-700 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600 dark:text-zinc-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Published</p>
                                <p class="text-sm text-gray-500 dark:text-zinc-400">
                                    {{ $bill->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Committee</p>
                                <p class="text-sm text-gray-500 dark:text-zinc-400">
                                    {{ $bill->committee->name ?? 'No committee assigned' }}
                                </p>
                            </div>
                        </div>

                        <!-- Interactive Like/Dislike Section -->
                        @if (auth()->user()->role === \App\Enums\UserRole::User)
                            <div class="flex justify-center">
                                <div
                                    class="bg-white dark:bg-gray-700 rounded-2xl p-4 shadow-lg border border-gray-200 dark:border-gray-600">
                                    <livewire:note-like-dislike :bill="$bill" :key="$bill->id" />
                                </div>
                            </div>
                        @endif
                    </div>


                    <!-- Comments Section Divider -->
                    <div class="relative py-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-zinc-600"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span
                                class="bg-white dark:bg-zinc-800 px-6 text-lg font-semibold text-gray-700 dark:text-zinc-300">
                                Comments
                            </span>
                        </div>
                    </div>

                    {{-- Comment Area --}}
                    <div class="mt-8">
                        <livewire:comment-section :bill="$bill" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
