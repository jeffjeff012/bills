<div class="flex-1 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="w-full max-w-2xl mx-auto h-full"> 
                        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 
                                    hover:shadow-2xl transition-all duration-500 overflow-hidden card-hover 
                                    flex flex-col h-full"> <!-- make equal height -->

                            <!-- HOT Badge -->
                            <div class="absolute top-4 right-4 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-500 text-white shadow-md animate-pulse">
                                    <span class="mr-1">🔥</span>
                                    HOT
                                </span>
                            </div>

                            @if($hotBill && $hotBill->likes_count > 0)
                                <!-- Card Header -->
                                <div class="px-6 pt-6 pb-4">
                                    <h3 class="text-lg font-semibold text-black-900 dark:text-black mb-2">
                                        Most Liked Bill
                                    </h3>
                                    <h4 class="text-xl font-bold text-black-800 dark:text-gray-800 mb-2">
                                        {{ $hotBill->title }}
                                    </h4>
                                </div>

                                <!-- Card Body -->
                                @if(str_word_count($hotBill->title) <= 10)
                                <div class="px-6 pb-4 flex-1"> <!-- flex-1 fills available space -->
                                    <p class="text-gray-600 dark:text-black-300 line-clamp-3 leading-relaxed">
                                        {{ Str::limit($hotBill->content, 150) }}
                                    </p>
                                </div>
                                @endif

                                <!-- Card Footer -->
                                <div class="px-6 py-4 bg-gradient-to-r from-red-50 to-orange-50 dark:from-gray-700/50 dark:to-gray-700/50 
                                            border-t border-gray-100 dark:border-gray-600 mt-auto"> <!-- mt-auto pushes footer down -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-800">
                                                {{ $hotBill->likes_count }}
                                                {{ $hotBill->likes_count == 1 ? 'like' : 'likes' }}
                                            </span>
                                        </div>
                                        <a href="{{ route('bills.show', $hotBill->id) }}" 
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-all duration-300 hover:shadow-lg">
                                            View Details →
                                        </a>
                                    </div>
                                </div>
                            @else
                                <!-- Empty State -->
                                <div class="flex flex-col items-center justify-center text-center px-6 py-12 flex-1">
                                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 mb-4">
                                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625A1.125 1.125 0 004.5 3.75v16.5A1.125 1.125 0 005.625 21h12.75a1.125 1.125 0 001.125-1.125V11.25a9 9 0 00-9-9z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-black-200">
                                        No Bill Available
                                    </h3>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-800">
                                        There’s currently no most liked bill. Once a bill gets likes, it will show up here.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>