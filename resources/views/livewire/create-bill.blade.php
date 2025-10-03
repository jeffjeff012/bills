<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-lg lg:text-3xl font-bold text-gray-900 dark:text-white">Create New Bill</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Fill in the details below to create a new bill.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <form wire:submit.prevent="save" class="divide-y divide-gray-200 dark:divide-gray-700">

                <!-- Basic Information Section -->
                <div class="p-6 sm:p-8">
                    <h2 class="text-sm lg:text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6.5a1.5 1.5 0 01-3 0V7a1 1 0 00-1-1H7a1 1 0 00-1 1v4.5a1.5 1.5 0 01-3 0V5z"
                                clip-rule="evenodd" />
                        </svg>
                        Basic Information
                    </h2>

                    <div class="text-xs lg:text-lg grid grid-cols-1 lg:grid-cols-2 gap-6">
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

                        {{-- <div class="lg:col-span-2">
                            <label for="committee_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Committee
                            </label>
                            <select id="committee_id" wire:model="committee_id"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 
                                        dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 
                                        focus:ring-blue-500 sm:text-sm px-3 py-3">
                                <option value="">-- Select Committee --</option>
                                @foreach ($committees as $committee)
                                    <option value="{{ $committee->id }}">{{ $committee->name }}</option>
                                @endforeach
                            </select>
                            @error('committee_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}
                    </div>

                    <!-- Contributor Information Section -->
                    <div class="p-4 sm:p-8 bg-gray-50 dark:bg-gray-800/50">
                        <h2
                            class="text-sm lg:text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
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
                                    <input type="radio" wire:model.live="contributorType" value="author"
                                        id="author-radio" class="sr-only">
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
                                                    <span
                                                        class="font-medium text-gray-900 dark:text-white">Author</span>
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
                                                    <span
                                                        class="font-medium text-gray-900 dark:text-white">Sponsored</span>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">Sponsored by a
                                                        committee</p>
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
                                    <div class="w-1/2 lg:col-span-2 animate-fade-in">
                                        <label for="committee_id"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Committee
                                        </label>
                                        <select id="committee_id" wire:model="committee_id"
                                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 
                                        dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 
                                        focus:ring-blue-500 sm:text-sm px-3 py-3">
                                            <option value="">-- Select Committee --</option>
                                            @foreach ($committees as $committee)
                                                <option value="{{ $committee->id }}">{{ $committee->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('committee_id')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            {{-- <div class="animate-fade-in">
                                    <flux:input label="Sponsor Name" wire:model="sponsored_by"
                                        placeholder="Enter the sponsor's name or company" class="max-w-md" />
                                </div> --}}
                           
                        </div>
                    </div>
                </div>

                <!-- File Upload Section -->
                <div class="p-6 sm:p-8">
                    <h2 class="text-sm lg:text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Attachments
                    </h2>

                    <div class="max-w-md">
                        <flux:input type="file" label="Upload PDF Attachment" wire:model="attachment"
                            accept="application/pdf"
                            class="file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">PDF files only, max 5MB</p>
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
                    <flux:button type="submit" variant="primary" class="px-6">
                        <div class="flex">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Save Bill</span>
                        </div>
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>
