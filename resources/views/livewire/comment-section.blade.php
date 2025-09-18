<div>
    @php
        use App\Enums\UserRole;
    @endphp

    {{-- Only show comment box for normal Users --}}
    @if(!$readonly && auth()->check() && auth()->user()->role === UserRole::User)
        <form wire:submit.prevent="submitComment" class="mb-4 text-xs lg:text-lg">
            <textarea wire:model="content" class="w-full p-2 border rounded" placeholder="Write a comment..."></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Post Comment</button>
        </form>
    @endif

    {{-- Success flash message --}}
    {{-- @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="translate-y-[-10px] opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transform transition ease-in duration-300"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-[-10px] opacity-0"
            x-init="setTimeout(() => { show = false }, 3000)"
            class="fixed top-5 right-5 bg-green-300 border-2 border-solid border-green-800 text-green-900 text-sm p-4 rounded-lg shadow-xl z-50"
            role="alert"
        >
            <p class="font-semibold">{{ session('success') }}</p>
        </div>
    @endif --}}
    <x-toast on="toast" />
    <div>
        @forelse($comments as $comment)
            <div class="p-2 border-b text-xs sm:text-lg  {{ $comment->is_hidden ? 'opacity-60' : '' }}">
                <strong >{{ $comment->user->name }}</strong>
                <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-sm me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                    </svg>
                    {{ $comment->created_at->diffForHumans() }}
                </span>

                {{-- Hidden label for staff/admin --}}
                @if($comment->is_hidden && auth()->check() && in_array(
                        (is_object(auth()->user()->role) && isset(auth()->user()->role->value))
                            ? auth()->user()->role->value
                            : auth()->user()->role,
                        ['sbstaff', 'admin']
                    ))
                    <span class=" inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-md bg-red-100 text-red-700 border border-red-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.75a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0v-4.5zm0 7.5a.75.75 0 00-1.5 0v.5a.75.75 0 001.5 0v-.5z" clip-rule="evenodd"/>
                        </svg>
                        Hidden
                    </span>
                @endif

                {{-- Editing state --}}
                @if($editingCommentId === $comment->id)
                    <textarea wire:model="editedContent" class="w-full p-2 border rounded mt-2"></textarea>
                    <div class="mt-2 space-x-2 ">
                        <button wire:click="updateComment" class="px-3 py-1 bg-green-500 text-white rounded">Save</button>
                        <button wire:click="$set('editingCommentId', null)" class="px-3 py-1 bg-gray-400 text-white rounded">Cancel</button>
                    </div>
                @else
                    <p class="mt-1 text-xs lg:text-lg">{{ $comment->content }}</p>

                    {{-- Actions --}}
                    @if(!$readonly)
                        <div class="mt-10 space-x-2">
                            @can('update', $comment)
                                @if($comment->canEdit())
                                    <button wire:click="startEditing({{ $comment->id }})" class="text-blue-500">Edit</button>
                                @endif
                            @endcan

                            @can('delete', $comment)
                                @if($comment->canDelete())
                                    <button wire:click="confirmCommentDeletion({{ $comment->id }})" class="text-red-500">Delete</button>
                                @endif
                            @endcan
                        </div>
                    @endif
                        
                
                    {{-- Hide/Unhide only for staff/admin --}}
                    @if(auth()->check() && in_array(
                            (is_object(auth()->user()->role) && isset(auth()->user()->role->value))
                                ? auth()->user()->role->value
                                : auth()->user()->role,
                            ['sbstaff', 'admin']
                        ))
                        <div class="mt-3">
                            <button 
                                wire:click="toggleHide({{ $comment->id }})"
                                class="inline-flex items-center px-3 py-1 text-xs lg:text-base font-bold rounded-md shadow-sm transition
                                    {{ $comment->is_hidden 
                                            ? 'bg-green-100 text-green-700 hover:bg-green-200 border border-green-300' 
                                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-300' }}">
                                @if($comment->is_hidden)
                                    <svg class="w-6 h-6 text-green-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>

                                    Unhide
                                @else
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z"/>
                                    <path d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z"/>
                                    <path d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z"/>
                                    </svg>

                                    Hide
                                @endif
                            </button>
                        </div>
                    @endif


                    {{-- Delete confirmation modal --}}
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
       @empty
            {{-- Empty state --}}
            <div class="text-xs lg:text-lg flex flex-col items-center justify-center py-10 px-6 border-2 border-dashed border-gray-300 dark:border-zinc-600 rounded-xl bg-gray-50 dark:bg-zinc-800/50">
                <flux:icon name="chat-bubble-left-right" class="w-10 h-10 text-gray-400 dark:text-gray-50 mb-3" />
                <p class="text-gray-600 dark:text-gray-50 font-medium">No comments yet</p>
                @if(auth()->check() && auth()->user()->role === UserRole::User)
                    <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">Be the first to share your thoughts.</p>
                @endif
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $comments->links() }}
    </div>
</div>
