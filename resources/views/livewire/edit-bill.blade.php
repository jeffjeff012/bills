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
            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>
</div>