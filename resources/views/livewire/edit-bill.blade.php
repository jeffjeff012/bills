<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Bill</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Make changes to your bill details.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <form wire:submit.prevent="update" class="divide-y divide-gray-200 dark:divide-gray-700">

                <!-- Basic Information Section -->
                <div class="p-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6.5a1.5 1.5 0 01-3 0V7a1 1 0 00-1-1H7a1 1 0 00-1 1v4.5a1.5 1.5 0 01-3 0V5z"
                                clip-rule="evenodd" />
                        </svg>
                        Basic Information
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-2">
                            <flux:input label="Title" wire:model="title" placeholder="Enter bill title"
                                class="text-lg font-medium" />
                        </div>

                        <div class="lg:col-span-2">
                            <flux:textarea label="Content" wire:model="content"
                                placeholder="Enter bill content and details" rows="8" class="resize-none" />
                        </div>

                        <div>
                            <flux:input label="Due Date" type="date" wire:model="due_date" class="w-full" />
                        </div>
                    </div>
                </div>

                <!-- Contributor Information Section -->
                <div class="p-6 sm:p-8 bg-gray-50 dark:bg-gray-800/50">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        Contributor Information
                    </h2>

                    <div class="space-y-6">
                        <!-- Radio Button Selection with Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="relative">
                                <input type="radio" wire:model.live="contributorType" value="author" id="author-radio"
                                    class="sr-only">
                                <label for="author-radio" class="cursor-pointer block">
                                    <div
                                        class="p-4 border-2 rounded-lg transition-all duration-200
                                               {{ $contributorType === 'author' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500' }}">
                                        <div class="flex items-center">
                                            <div
                                                class="w-4 h-4 border-2 rounded-full mr-3 flex items-center justify-center
                                                       {{ $contributorType === 'author' ? 'border-blue-500 bg-blue-500' : 'border-gray-300 dark:border-gray-500' }}">
                                                @if ($contributorType === 'author')
                                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-900 dark:text-white">Author</span>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Written by an
                                                    individual author</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div class="relative">
                                <input type="radio" wire:model.live="contributorType" value="sponsor"
                                    id="sponsor-radio" class="sr-only">
                                <label for="sponsor-radio" class="cursor-pointer block">
                                    <div
                                        class="p-4 border-2 rounded-lg transition-all duration-200
                                               {{ $contributorType === 'sponsor' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500' }}">
                                        <div class="flex items-center">
                                            <div
                                                class="w-4 h-4 border-2 rounded-full mr-3 flex items-center justify-center
                                                       {{ $contributorType === 'sponsor' ? 'border-blue-500 bg-blue-500' : 'border-gray-300 dark:border-gray-500' }}">
                                                @if ($contributorType === 'sponsor')
                                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-900 dark:text-white">Sponsored</span>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Sponsored by a
                                                    company</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Conditional Fields with Smooth Transitions -->
                        <div class="min-h-[60px]">
                            @if ($contributorType === 'author')
                                <div class="animate-fade-in">
                                    <flux:input label="Author Name" wire:model="authored_by"
                                        placeholder="Enter the author's full name" class="max-w-md" />
                                </div>
                            @endif

                            @if ($contributorType === 'sponsor')
                                <div class="animate-fade-in">
                                    <flux:input label="Sponsor Name" wire:model="sponsored_by"
                                        placeholder="Enter the sponsor's name or company" class="max-w-md" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- File Upload Section -->
                <div class="p-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Attachments
                    </h2>

                    <!-- Current Attachment Display -->
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
                                        <p class="font-medium text-blue-900 dark:text-blue-100">Current Document</p>
                                        <p class="text-sm text-blue-700 dark:text-blue-300">PDF file attached to this bill</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($currentAttachment) }}" 
                                target="_blank" 
                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    View PDF
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="max-w-md">
                        <flux:input type="file" label="Upload PDF Attachment" wire:model="attachment"
                            accept="application/pdf"
                            class="file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">PDF files only, max 10MB. Upload a new file to replace the current one.</p>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 sm:px-8 bg-gray-50 dark:bg-gray-800/50 flex justify-end space-x-3">
                    <a href="{{ route('report-of-bills') }}">
                        <flux:button variant="outline" class="px-6">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Cancel
                        </flux:button>
                    </a>
                    <flux:button type="submit" variant="primary" class="px-8">
                        <div class="flex">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Update Bill</span>
                        </div>
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out forwards;
}
</style> --}}