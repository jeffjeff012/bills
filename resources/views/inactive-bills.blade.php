<x-layouts.app :title="__('Bills')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Inactive Bills') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Review bills that have passed their due date') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if ($bills->isEmpty())
    <div class="flex flex-col items-center justify-center py-12 text-center">
        <flux:icon.cube class="w-16 h-16 text-gray-400 mb-4" />
        <p class="text-gray-500 text-lg font-medium">No inactive bills found</p>
        <p class="text-gray-400 text-sm mt-2">Check back later for archived legislation</p>
    </div>
    @else  
        <div class="space-y-4">
        @foreach ($bills as $bill)
                <a href="{{ route('inactive-blog', $bill->id) }}">
                    <div class=" p-6 rounded-lg border-2 border-yellow-500 bg-gray shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out">
                        <h2 class="font-bold text-xl text-black dark:text-white">{{ $bill->title }}</h2>
                        <p class="text-base text-black dark:text-white mt-1">
                            {{ \Illuminate\Support\Str::words($bill->content, 20, '...') }}
                        </p>
                        <div class="flex gap-x-4 mt-3">
                            <p class="text-sm text-black dark:text-white">{{ $bill->likes }} liked this</p>
                            <p class="text-sm text-black dark:text-white">{{ $bill->dislikes }} disliked this</p>
                        </div>

                        <p class="text-xs text-red-600 dark:text-red-400 mt-3">
                            Ended in {{ \Carbon\Carbon::parse($bill->due_date)->format('F j, Y') }}
                            {{-- Due: {{ \Carbon\Carbon::parse($note->due_date)->format('F j, Y') }} --}}
                        </p>
                    </div>
                </a>
                <br>
            @endforeach
        </div>
    @endif
</x-layouts.app>
