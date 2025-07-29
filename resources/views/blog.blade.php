 <x-layouts.app >
 <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
<a href="/dashboard" class="flex underlined">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
    </svg><small class="mt-1 ml-2">Back</small>
</a>

                    <div class="p-6 center">
                       <div class="max-w-3xl mx-auto mt-10 p-6 bg-white dark:bg-zinc-800 rounded-xl shadow-md space-y-4">
                        
                        <h1 class="text-3xl font-bold text-center text-gray-800 dark:text-white">
                            {{ $note->title }}
                        </h1>
                    <flux:separator />
                        <p class="text-xl text-zinc-600 dark:text-zinc-300 leading-relaxed">
                          {!! nl2br(e($note->content)) !!}

                        </p>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-6">
                            Published {{ $note->created_at->diffForHumans() }}
                        </p>
                            {{$note->likes}} <em>people liked this</em>
                {{-- Comment Area --}}
                
                                
                </div>              
                        <br>
                        <br>
                <livewire:comment-section :note="$note" />
                    
                      
               
    </div>
    

</div>
</x-layouts.app>