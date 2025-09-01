<div class="relative mb-6 w-full ">
    <flux:heading size="xl" level="1">{{ __('Activities') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Heads up! This is everyone activity') }}</flux:subheading>
    <flux:separator class="mb-5" variant="subtle" />

    <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl">
        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">
            Activity Logs
        </h2>

        @if ($logs->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Date/Time</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">User</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Action</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">On What</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($logs as $log)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $log->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $log->causer?->name ?? 'System' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300"> 
                                    @if($log->subject_type === App\Models\Like::class && $log->description === 'created')
                                        Added a Like
                                    @elseif($log->subject_type === App\Models\Comment::class && $log->description === 'created')
                                        Added a Comment
                                    @elseif($log->description === 'updated' && isset($log->properties['attributes'], $log->properties['old']))
                                        @php
                                            $changed = [];
                                            foreach ($log->properties['attributes'] as $field => $newValue) {
                                                $oldValue = $log->properties['old'][$field] ?? null;
                                                if ($oldValue !== $newValue) {
                                                    $changed[] = str_replace('_', ' ', $field);
                                                }
                                            }
                                        @endphp

                                        @if(count($changed))
                                            @foreach($changed as $field)
                                                Updated the {{ $field }}@if(!$loop->last), @endif
                                            @endforeach
                                        @else
                                            Updated
                                        @endif
                                    @else
                                        {{ ucfirst($log->description) }}
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{ class_basename($log->subject_type) }}
                                    @if($log->subject)
                                        @if($log->subject_type === App\Models\Bill::class)
                                            - "{{ $log->subject->title }}"
                                        @elseif($log->subject_type === App\Models\Comment::class)
                                            - "{{ Str::limit($log->subject->content, 30) }}"
                                        @elseif($log->subject_type === App\Models\Like::class && $log->subject->bill)
                                            - "on {{ $log->subject->bill->title }}"
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        @else
            <div class="text-center py-10">
                <flux:icon.inbox class="mx-auto h-12 w-12 text-gray-400" />
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No Activity Logs</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">All activities will appear here once available.</p>
            </div>
        @endif
    </div>
</div>
