<div>
    <form wire:submit.prevent="submitComment" class="mb-4">
        <textarea wire:model="content" class="w-full p-2 border rounded" placeholder="Write a comment..."></textarea>
        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Post Comment</button>
    </form>

    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => { show = false }, 3000)"
            class="fixed top-5 right-5 bg-green-600 text-white text-sm p-4 rounded-lg shadow-lg z-50"
            role="alert"
        >
            <p>{{ session('success') }}</p>
        </div>
    @endif


    <div>
        @foreach($comments as $comment)
            <div class="p-2 border-b">
                <strong>{{ $comment->user->name }}</strong>
                  <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-sm me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500 ">
                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                    </svg>
                    {{ $comment->created_at->diffForHumans() }}
                  </span>
                {{-- Check if currently editing this comment --}}
                @if($editingCommentId === $comment->id)
                    <textarea wire:model="editedContent" class="w-full p-2 border rounded mt-2"></textarea>
                    <div class="mt-2 space-x-2">
                        <button wire:click="updateComment" class="px-3 py-1 bg-green-500 text-white rounded">Save</button>
                        <button wire:click="$set('editingCommentId', null)" class="px-3 py-1 bg-gray-400 text-white rounded">Cancel</button>
                    </div>
                @else
                    <p class="mt-1">{{ $comment->content }}</p>
                  
                    
                    {{-- Only show edit/delete if comment belongs to user --}}
                    
                        <div class="mt-10 space-x-2">
                            @can('update', $comment)
                            <button wire:click="startEditing({{ $comment->id }})" class="text-blue-500">Edit</button>
                            @endcan

                            @can('delete', $comment)
                            <button wire:click="confirmCommentDeletion({{ $comment->id }})" class="text-red-500">Delete</button>
                            @endcan
                        </div>
                    

                    <flux:modal name="delete-comment" class="min-w-[22rem]" wire:model="confirmingCommentDeletion">
                        <div class="space-y-6">
                            <div>
                                <flux:heading size="lg">Delete Comment?</flux:heading>

                                <flux:text class="mt-2">
                                    <p>You're about to delete this comment.</p>
                                    <p>This action cannot be reversed.</p>
                                </flux:text>
                            </div>

                            <div class="flex gap-2">
                                <flux:spacer />

                                <flux:modal.close>
                                    <flux:button variant="ghost" wire:click="$set('confirmingCommentDeletion', false)">Cancel</flux:button>
                                </flux:modal.close>

                                <flux:button type="button" variant="danger" wire:click="deleteComment">Delete Comment</flux:button>
                            </div>
                        </div>
                    </flux:modal>
                @endif
            </div>
        @endforeach
    </div>
     <div class="mt-4">
        {{ $comments->links() }}
    </div>
</div>
