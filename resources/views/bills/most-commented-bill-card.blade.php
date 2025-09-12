<div class="flex-1 animate-fade-in-up" style="animation-delay: 0.4s;">
    <div class="w-full max-w-2xl mx-auto h-full"> 
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 
                    hover:shadow-2xl transition-all duration-500 overflow-hidden card-hover 
                    flex flex-col h-full"> <!-- equal height -->

            <!-- TRENDING Badge -->
            <div class="absolute top-4 right-4 z-10">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-500 text-white shadow-md animate-pulse">
                    <span class="mr-1">💬</span>
                    TRENDING
                </span>
            </div>

            @if($mostCommentedBill && $mostCommentedBill->comments_count > 0)
                <!-- Card Header -->
                <div class="px-6 pt-6 pb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-800 mb-2">
                        Most Commented Bill
                    </h3>
                    <h4 class="text-xl font-bold text-gray-800 dark:text-gray-700 mb-2">
                        {{ $mostCommentedBill->title }}
                    </h4>
                </div>

                <!-- Card Body -->
                @if(str_word_count($mostCommentedBill->title) <= 10)
                <div class="px-6 pb-4 flex-1"> <!-- flex-1 fills space -->
                    <p class="text-gray-600 dark:text-gray-800 line-clamp-3 leading-relaxed">
                        {{ Str::limit($mostCommentedBill->content, 150) }}
                    </p>
                </div>
                @endif

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700/50 dark:to-gray-700/50 
                            border-t border-gray-100 dark:border-gray-600 mt-auto">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625A1.125 1.125 0 004.5 3.75v16.5A1.125 1.125 0 005.625 21h12.75a1.125 1.125 0 001.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $mostCommentedBill->comments_count }}
                                {{ $mostCommentedBill->comments_count == 1 ? 'comment' : 'comments' }}
                            </span>
                        </div>
                        <a href="{{ route('bills.show', $mostCommentedBill->id) }}" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition-all duration-300 hover:shadow-lg">
                            View Details →
                        </a>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center text-center px-6 py-12 flex-1">
                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6m-6 4h10M5 6a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-black-200">
                        No Bill Available
                    </h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-black-400">
                        There’s currently no most commented bill. Once a bill gets comments, it will show up here.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>