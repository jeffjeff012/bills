<div>
    <flux:modal name="create-note" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Note</flux:heading>
                <flux:text class="mt-2">This information will be displayed publicly.</flux:text>
            </div>

            <flux:input 
                label="Title" 
                wire:model="title"
                placeholder="Your title" />

            <flux:textarea 
                label="Content" 
                wire:model="content"
                placeholder="Your content" />

            <!-- ✅ Add this Due Date input -->
            <flux:input 
                label="Due Date"
                type="date"
                wire:model="due_date"
            />

            <flux:input 
                label="Authored By"
                wire:model="authored_by"
                placeholder="Enter author name"
            />

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="save">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
