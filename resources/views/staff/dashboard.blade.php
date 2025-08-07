<x-layouts.app :title="__('Staff Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Sangguniang Bayan') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Bill creation process') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

@session('success')
    <p class="text-green-600">{{ $value }}</p>
@endsession
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
    <!-- Users -->
    <div class="bg-gradient-to-br from-blue-500 to-cyan-600 border border-blue-500 text-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium uppercase">Users</h2>
                <p class="text-3xl font-bold mt-2">{{ $userCount }}</p>
            </div>
            <flux:icon name="user-group" class="w-10 h-10 text-white" />
        </div>
    </div>

    <!-- Bills Created -->
    <div class="bg-gradient-to-br from-purple-500 to-blue-600 border border-blue-500 text-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm font-medium uppercase">Bills Created</h2>
                <p class="text-3xl font-bold mt-2">{{ $noteCount }}</p>
            </div>
            <flux:icon name="scale" class="w-10 h-10 text-white" />
        </div>
    </div>

    <!-- Likes -->
<div class="bg-gradient-to-br from-blue-400 to-blue-500 border border-blue-500 text-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-sm font-medium uppercase">Likes</h2>
            <p class="text-3xl font-bold mt-2">{{ $totalLikes }}</p>
        </div>
        <flux:icon name="hand-thumb-up" class="w-10 h-10 text-black-500" />
    </div>
</div>

<!-- Dislikes -->
<div class="bg-gradient-to-br from-teal-500 to-orange-600 border border-blue-500 text-white p-6 rounded-xl shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-sm font-medium uppercase">Dislikes</h2>
            <p class="text-3xl font-bold mt-2">{{ $totalDislikes }}</p>
        </div>
        <flux:icon name="hand-thumb-down" class="w-10 h-10 text-black-500" />
    </div>
</div>
</div>

</x-layouts.app>
