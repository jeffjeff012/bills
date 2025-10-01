@if ($show)
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black/50">
        <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 lg:p-6
                    w-[80%] w-[10rem] lg:w-[20rem] max-w-[95%]">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                {{ $title }}
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                {{ $message }}
            </p>
            <div class="flex justify-end gap-3">
                <button wire:click="{{ $cancelAction }}"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                    Cancel
                </button>
                <button wire:click="{{ $confirmAction }}"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Confirm
                </button>
            </div>
        </div>
    </div>
@endif
