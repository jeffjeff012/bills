<x-layouts.app :title="__('Bills')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Inactive Bills') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Review bills that have passed their due date') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if ($notes->isEmpty())
        <p class="text-gray-500">No inactive bills found.</p>
    @else
        
        <div class="space-y-4">
       @foreach ($notes as $note)
    <a href="{{ route('inactive-blog', $note->id) }}">
        <div class="p-6 rounded-lg border-2 border-yellow-500 bg-gray shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out">
            <h2 class="font-bold text-xl text-white">{{ $note->title }}</h2>
            <p class="text-base text-white mt-1">{{ $note->content }}</p>

            <div class="flex gap-x-4 mt-3">
                <p class="text-sm text-white">{{ $note->likes }} liked this</p>
                <p class="text-sm text-white">{{ $note->dislikes }} disliked this</p>
            </div>

            <p class="text-xs text-red-400 mt-3">
                Due: {{ \Carbon\Carbon::parse($note->due_date)->format('F j, Y') }}
            </p>
        </div>
    </a>
@endforeach

        </a>

        </div>
    @endif
</x-layouts.app>
