<x-layouts.app>
    <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-xl shadow">
        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-bold">Create Bill</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    This information will be displayed publicly.
                </p>
            </div>

            <form wire:submit.prevent="save" class="space-y-4">
                <flux:input 
                    label="Title" 
                    wire:model="title"
                    placeholder="Your title" />

                <flux:textarea 
                    label="Content" 
                    wire:model="content"
                    placeholder="Your content" />

                <flux:input 
                    label="Due Date"
                    type="date"
                    wire:model="due_date" />

                <flux:input 
                    label="Who is the Author of this bill?"
                    wire:model="authored_by"
                    placeholder="Enter author name" />

                <flux:input 
                    type="file" 
                    label="Upload PDF Attachment" 
                    wire:model="attachment"
                    accept="application/pdf" />
                @error('attachment') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary">Save</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
