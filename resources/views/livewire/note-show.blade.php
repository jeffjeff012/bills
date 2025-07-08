<div class="max-w-2xl mx-auto py-10">
    <h1 class="text-3xl font-bold">{{ $note->title }}</h1>
    <p class="mt-4 text-lg text-gray-700">{{ $note->content }}</p>
    <p class="mt-6 text-sm text-gray-500">Published {{ $note->created_at->diffForHumans() }}</p>
</div>
