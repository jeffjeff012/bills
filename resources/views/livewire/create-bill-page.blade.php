<div class="w-full">
    <div class="mb-6">
        <flux:heading size="xl" level="1">{{ __('Create Bill') }}</flux:heading>
        <flux:subheading size="lg" class="mb-4">
            {{ __('Publish new bill for an author') }}
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    

    <form wire:submit.prevent="save" class="space-y-6">
        <flux:input 
    label="Title" 
    wire:model="title"
    placeholder="Your title" />

<flux:textarea 
    label="Content" 
    wire:model="content"
    placeholder="Your content"
    rows="6" />

<div class="flex gap-4">
    <div class="flex-1">
        <flux:input 
            label="Due Date"
            type="date"
            wire:model="due_date" />
    </div>

    <div class="flex-1">
        <flux:input 
            label="Who is the Author of this bill?"
            wire:model="authored_by"
            placeholder="Enter author name" />
    </div>
</div>

        <flux:input 
            type="file" 
            label="Upload PDF Attachment" 
            wire:model="attachment"
            accept="application/pdf" />
        @error('attachment') 
            <span class="text-red-500 text-sm">{{ $message }}</span> 
        @enderror

        <div class="flex gap-3 pt-8">
            <flux:button 
                variant="outline" 
                wire:click="cancel"
                type="button">
                Cancel
            </flux:button>
            <flux:button 
                type="submit" 
                variant="primary">
                Save Bill
            </flux:button>
        </div>
    </form>
</div>