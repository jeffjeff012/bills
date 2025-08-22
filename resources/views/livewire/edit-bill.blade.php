<div>
  
    <flux:modal name="edit-bill" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Bill</flux:heading>
                <flux:text class="mt-2">Make changes to your articles.</flux:text>
            </div>

            <flux:input label="Title" 
            wire:model="title"
            placeholder="Your title"/>

            <flux:textarea label="Content" 
            wire:model="content"
            placeholder="Your content"/>

            <flux:input
                type="date"
                label="Due Date"
                wire:model.defer="due_date"
            />

            <flux:input 
                label="Authored By" 
                wire:model="authored_by"
                placeholder="Enter author name"
            />

         @if($currentAttachment)
    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600 dark:text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0-1.125.504-1.125 1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-blue-900 dark:text-blue-100">
                        {{ __('Current Document') }}
                    </p>
                    <p class="text-sm text-blue-700 dark:text-blue-300">
                        {{ __('PDF file attached to this bill') }}
                    </p>
                </div>
            </div>
            <a href="{{ Storage::url($currentAttachment) }}" 
               target="_blank" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                {{ __('View PDF') }}
            </a>
        </div>
    </div>
@endif

<!-- Enhanced File Upload Area -->
<div class="relative">
    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl cursor-pointer bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400 mb-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                <span class="font-semibold">{{ __('Click to upload') }}</span> {{ __('or drag and drop') }}
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('PDF files only') }}</p>
        </div>
        <input type="file" 
               wire:model="attachment" 
               accept="application/pdf" 
               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
    </label>
</div>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>
</div>