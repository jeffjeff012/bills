<div class="relative mb-6 w-full ">
    <flux:heading size="xl" level="1">{{ __('Activities') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Heads up! This is everyone activity') }}</flux:subheading>
    <flux:separator class="mb-5" variant="subtle" />

    <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl">
        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">
            Activity Logs
            <flux:separator class="mt-2" variant="subtle" />
        </h2>

        @if ($logs->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Date/Time</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">User
                            </th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Action</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">On
                                What</th>
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
                                <td class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                    @if ($log->subject_type === App\Models\Like::class && $log->description === 'created')
                                        @if ($log->subject && $log->subject->like)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                Liked the post
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                Disliked the post
                                            </span>
                                        @endif
                                    @elseif($log->subject_type === App\Models\Comment::class && $log->description === 'created')
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Added a Comment
                                        </span>
                                    @elseif($log->description === 'updated' && isset($log->properties['attributes'], $log->properties['old']))
                                        @php
                                            $changed = [];
                                            foreach ($log->properties['attributes'] as $field => $newValue) {
                                                $oldValue = $log->properties['old'][$field] ?? null;

                                                if ($field === 'like' && $oldValue !== $newValue) {
                                                    $changed[] = $newValue
                                                        ? [
                                                            'text' => 'Liked the post',
                                                            'class' =>
                                                                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                        ]
                                                        : [
                                                            'text' => 'Disliked the post',
                                                            'class' =>
                                                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                                        ];
                                                } elseif ($field === 'is_hidden' && $oldValue !== $newValue) {
                                                    $changed[] = $newValue
                                                        ? [
                                                            'text' => 'Hide a comment',
                                                            'class' =>
                                                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                                        ]
                                                        : [
                                                            'text' => 'Unhide a comment',
                                                            'class' =>
                                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                        ];
                                                } elseif ($oldValue !== $newValue) {
                                                    $changed[] = [
                                                        'text' => 'Updated the ' . str_replace('_', ' ', $field),
                                                        'class' =>
                                                            'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                                                    ];
                                                }
                                            }
                                        @endphp

                                        @if (count($changed))
                                            @foreach ($changed as $change)
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $change['class'] }}">
                                                    {{ $change['text'] }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-700 dark:text-gray-200">
                                                Updated
                                            </span>
                                        @endif
                                    @else
                                        @if ($log->description === 'created')
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                                bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                Created
                                            </span>
                                        @elseif ($log->description === 'deleted')
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                                    bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                Deleted
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                                    bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                {{ ucfirst($log->description) }}
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{ class_basename($log->subject_type) }}
                                    @if ($log->subject)
                                        @if ($log->subject_type === App\Models\Bill::class)
                                            - "{{ $log->subject->title }}"
                                        @elseif($log->subject_type === App\Models\Comment::class)
                                            - "{{ Str::limit($log->subject->content, 30) }}"
                                        @elseif($log->subject_type === App\Models\Like::class && $log->subject->bill)
                                            - "on {{ $log->subject->bill->title }}"
                                        @endif
                                    @else
                                        deleted
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
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">All activities will appear here once available.
                </p>
            </div>
        @endif
    </div>
</div>
