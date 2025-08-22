<x-layouts.app :title="__('Bills')">
    <!-- Enhanced Header Section -->
    <div class="relative mb-8 w-full">
        <div class="flex items-center gap-3 mb-4">
            <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                <flux:icon.archive-box class="w-6 h-6 text-red-600 dark:text-red-400" />
            </div>
            <div>
                <flux:heading size="xl" level="1" class="text-gray-900 dark:text-white">
                    {{ __('Inactive Bills') }}
                </flux:heading>
                <flux:subheading size="lg" class="text-gray-600 dark:text-gray-300 mt-1">
                    {{ __('Review bills that have passed their due date') }}
                </flux:subheading>
            </div>
        </div>
        <flux:separator variant="subtle" class="mt-6" />
    </div>

    @if ($bills->isEmpty())
        <!-- Enhanced Empty State -->
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="relative mb-6">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                    <flux:icon.archive-box class="w-10 h-10 text-gray-400" />
                </div>
                <div class="absolute -top-1 -right-1 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                    <flux:icon.check class="w-3 h-3 text-white" />
                </div>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                {{ __('No Inactive Bills') }}
            </h3>
            <p class="text-gray-500 dark:text-gray-400 text-base max-w-md">
                {{ __('Great! All your bills are currently active. Archived legislation will appear here once bills pass their due dates.') }}
            </p>
        </div>
    @else  
        <!-- Enhanced Bills Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($bills as $bill)
                <a href="{{ route('inactive-blog', $bill->id) }}" class="group">
                    <div class="relative p-6 rounded-xl border-2 border-amber-200 dark:border-amber-800/50 bg-gradient-to-br from-amber-50 to-orange-50 dark:from-gray-800 dark:to-gray-900 shadow-md hover:shadow-xl hover:scale-[1.02] hover:border-amber-300 dark:hover:border-amber-700 transition-all duration-300 ease-in-out">
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 rounded-full">
                                <div class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></div>
                                {{ __('Inactive') }}
                            </span>
                        </div>

                        <!-- Bill Content -->
                        <div class="pr-16">
                            <h2 class="font-bold text-xl text-gray-900 dark:text-white mb-3 group-hover:text-amber-700 dark:group-hover:text-amber-300 transition-colors duration-200 line-clamp-2">
                                {{ $bill->title }}
                            </h2>
                            
                            <p class="text-base text-gray-700 dark:text-gray-300 mb-4 line-clamp-3 leading-relaxed">
                                {{ \Illuminate\Support\Str::words($bill->content, 20, '...') }}
                            </p>

                            <!-- Engagement Stats -->
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-gray-400">
                                    <flux:icon.hand-thumb-up class="w-4 h-4 text-green-500" />
                                    <span class="font-medium">{{ number_format($bill->likes) }}</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-sm text-gray-600 dark:text-gray-400">
                                    <flux:icon.hand-thumb-down class="w-4 h-4 text-red-500" />
                                    <span class="font-medium">{{ number_format($bill->dislikes) }}</span>
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="flex items-center gap-2 text-sm">
                                <flux:icon.calendar-days class="w-4 h-4 text-red-500" />
                                <span class="text-red-600 dark:text-red-400 font-medium">
                                    {{ __('Ended') }} {{ \Carbon\Carbon::parse($bill->due_date)->format('M j, Y') }}
                                </span>
                                <span class="text-gray-400 dark:text-gray-500">
                                    ({{ \Carbon\Carbon::parse($bill->due_date)->diffForHumans() }})
                                </span>
                            </div>
                        </div>

                        <!-- Hover Indicator -->
                        <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <flux:icon.arrow-top-right-on-square class="w-4 h-4 text-amber-600 dark:text-amber-400" />
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Results Summary -->
        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                {{ __('Showing') }} {{ $bills->count() }} {{ Str::plural('inactive bill', $bills->count()) }}
            </p>
        </div>
    @endif
</x-layouts.app>