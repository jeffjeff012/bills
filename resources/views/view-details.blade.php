<x-layouts.app :title="'All Bills'">
    <div class="max-w-4xl mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="relative mb-6 w-full">
                <flux:heading size="xl" level="1" class="text-gray-900 dark:text-white">{{ __('Report of Bills') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6 text-gray-600 dark:text-gray-300">{{ __('Data from users') }}</flux:subheading>
                <flux:separator variant="subtle" class="border-gray-200 dark:border-gray-700" />
            </div>
            <div class="mt-4 flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ count($bills) }} total bills
                </span>
            </div>
        </div>

        <!-- Bills Grid -->
        <div class="grid gap-6 md:gap-8">
            @forelse ($bills as $bill)
                <article class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-gray-900/25 transition-all duration-300 overflow-hidden">
                    <!-- Bill Header -->
                    <div class="p-6 pb-4">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white leading-tight">
                                {{ $bill->title }}
                            </h2>
                            @php
                                $dueDate = \Carbon\Carbon::parse($bill->due_date);
                                $isExpired = $dueDate->isPast();
                                $daysDiff = abs($dueDate->diffInDays(now()));
                            @endphp
                            <span class="flex-shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isExpired ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' : 'bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300' }}">
                                @if($isExpired)
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Expired
                                @else
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Active
                                @endif
                            </span>
                        </div>

                        <!-- Bill Content -->
                        <div class="prose prose-sm max-w-none mb-4">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ \Illuminate\Support\Str::words($bill->content, 50, '...') }}
                            </p>
                        </div>
                    </div>

                    <!-- Bill Footer -->
                    <div class="px-6 pb-6">
                        <!-- Voting Stats -->
                        <div class="flex items-center gap-6 mb-4">
                            <div class="flex items-center gap-2">
                                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-green-900/30 transition-colors">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                    </svg>
                                    <span class="text-sm font-medium text-blue-700 dark:text-blue-300">{{ number_format($bill->likes) }}</span>
                                </button>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                                    <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.157 2H5.74a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
                                    </svg>
                                    <span class="text-sm font-medium text-red-700 dark:text-red-300">{{ number_format($bill->dislikes) }}</span>
                                </button>
                            </div>

                            <!-- Voting Bar -->
                            @php
                                $totalVotes = $bill->likes + $bill->dislikes;
                                $likePercentage = $totalVotes > 0 ? ($bill->likes / $totalVotes) * 100 : 0;
                            @endphp
                            @if($totalVotes > 0)
                                <div class="flex-1 max-w-32">
                                    <div class="flex text-xs text-gray-600 dark:text-gray-400 mb-1">
                                        <span>{{ number_format($likePercentage, 1) }}% support</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-green-500 dark:bg-green-400 h-2 rounded-full transition-all duration-500" style="width: {{ $likePercentage }}%"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Due Date -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-2 text-sm {{ $isExpired ? 'text-red-600' : 'text-gray-600' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>

                                @if($isExpired)
                                    <span class="font-medium">Ended {{ $dueDate->diffForHumans() }}</span>
                                @else
                                    <span class="font-medium">Ends {{ $dueDate->diffForHumans() }}</span>
                                @endif

                                <span class="text-gray-400">•</span>
                                <span>{{ $dueDate->format('F j, Y') }}</span>
                            </div>
                                                    
                            <a href="{{ route('bill', $bill->id) }}" 
   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
   View Bills
   <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
   </svg>
</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No bills found</h3>
                    <p class="text-gray-500">There are currently no bills to display.</p>
                </div>
            @endforelse
        </div>

        <!-- Load More or Pagination could go here -->
        @if(count($bills) > 0)
            <div class="mt-12 text-center">
                <p class="text-sm text-gray-500">Showing {{ count($bills) }} bills</p>
            </div>
        @endif
    </div>
</x-layouts.app>