<!DOCTYPE html>
<html lang="en" class="h-full" x-data x-init="
  if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }
">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Other Bills</title>

    <link rel="icon" href="/images/final.png" sizes="any">
        <link rel="icon" href="/images/final.png" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/images/final.png">
    {{-- Tailwind CDN (standalone) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Optional: clamp utilities if you use line-clamp --}}
    <script>
      tailwind.config = {
        darkMode: 'class',
        plugins: [ ],
      }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body class="min-h-full bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <div class="max-w-6xl mx-auto px-4 py-10">
        <header class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Other Bills</h2>

            {{-- If you want a home/back link, keep this. Otherwise you can remove it. --}}
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <span>←</span> <span>Back</span>
            </a>
        </header>

        @if($otherBills->count())
           <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($otherBills as $bill)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300 overflow-hidden 
                                flex flex-col">

                        <!-- Card Header -->
                        <div class="px-6 pt-6 pb-4">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">
                                {{ $bill->title }}
                            </h4>
                        </div>

                        <!-- Card Body -->
                        @if(str_word_count($bill->title) < 10)
                            <div class="px-6 pb-4">
                                <p class="text-gray-600 dark:text-gray-300 line-clamp-3">
                                    {{ Str::limit($bill->content, 120) }}
                                </p>
                            </div>
                        @endif

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-600 
                                    flex justify-between items-center mt-auto">
                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $bill->comments_count }} comments
                            </span>
                            <a href="{{ route('bills.show', $bill->id) }}"
                            class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-blue-700 transition">
                                View →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $otherBills->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 dark:text-gray-400 italic">No other bills available.</p>
            </div>
        @endif
    </div>
</body>
</html>
