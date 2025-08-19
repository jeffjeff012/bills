<div class="max-w-2xl mx-auto py-10">
    <h1 class="text-3xl font-bold">{{ $bill->title }}</h1>
    <p class="mt-4 text-lg text-gray-700">{{ $bill->content }}</p>
    <p class="mt-6 text-sm text-gray-500">Published {{ $bill->created_at->diffForHumans() }}</p>
</div>
