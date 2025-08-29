<div>
    <flux:modal name="create-bill" class="w-full max-w-lg mx-4 md:w-900 md:mx-auto">
        <div class="space-y-4 md:space-y-6  md:p-6">
            <div>
                <flux:heading size="base md:lg">Create Bill</flux:heading>
                <flux:text class="mt-1 md:mt-2 text-sm md:text-base">This information will be displayed publicly.</flux:text>
            </div>

            <div class="space-y-3 md:space-y-4">
                <flux:input 
                    label="Title" 
                    wire:model="title"
                    placeholder="Your title"
                    class="text-sm md:text-base" />

                <flux:textarea 
                    label="Content" 
                    wire:model="content"
                    placeholder="Your content"
                    rows="3 md:4"
                    class="text-sm md:text-base" />

                <flux:input 
                    label="Due Date"
                    type="date"
                    wire:model="due_date"
                    class="text-sm md:text-base"
                />

                <flux:input 
                    label="Who is the Author of this bill?"
                    wire:model="authored_by"
                    placeholder="Enter author name"
                    class="text-sm md:text-base"
                />

                <!--  PDF Upload -->
                <flux:input 
                    type="file" 
                    label="Upload PDF Attachment" 
                    wire:model="attachment"
                    accept="application/pdf"
                    class="text-sm md:text-base"
                />
                @error('attachment') <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Mobile: Stack buttons vertically, Desktop: Side by side -->
            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2 pt-4 md:pt-0">
                <flux:button 
                    variant="outline" 
                    class="w-full md:w-auto order-2 md:order-1"
                    wire:click="$dispatch('modal.close', { name: 'create-bill' })">
                    Cancel
                </flux:button>
                <flux:spacer class="hidden md:block" />
                <flux:button 
                    type="submit" 
                    variant="primary" 
                    wire:click="save"
                    class="w-full md:w-auto order-1 md:order-2">
                    Save Bill
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>