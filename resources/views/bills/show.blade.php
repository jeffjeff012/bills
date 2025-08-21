<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bill Previews</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .comment-card {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .comment-card:hover {
            border-left-color: #667eea;
            transform: translateX(4px);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-slate-800 dark:to-gray-900">
    <!-- Background Decorations -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
    </div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-6 py-8">
        
        <!-- Header Section -->
        <div class="mb-12 animate-fade-in-up">
            <div class="flex items-center justify-between mb-8">
                <!-- Enhanced Back Button -->
                <a href="/" class="group inline-flex items-center px-6 py-3 rounded-full bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200/50 dark:border-gray-700/50 hover:border-blue-300 dark:hover:border-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-600 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                    <span class="ml-2 font-medium text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                        Back to Home
                    </span>
                </a>

                <!-- Spacer -->
                <div class="flex-1"></div>
            </div>

            <!-- Title Section with Enhanced Design -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 mb-6 shadow-2xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold gradient-text mb-4">
                    Bill Previews
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
                    Explore and engage with legislative bills through our interactive preview system
                </p>
            </div>
        </div>

        <!-- Bills Grid -->
        <div class="space-y-8">
            @foreach($bills as $bill)
                <!-- Enhanced Bill Card -->
                <div class="card-hover bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-3xl shadow-xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    
                    <!-- Card Header with Gradient -->
                    <div class="relative bg-gradient-to-r from-blue-600/10 via-purple-600/10 to-blue-800/10 px-8 py-6">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20"></div>
                        <div class="relative z-10">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2 leading-tight">
                                {{ $bill->title }}
                            </h2>
                            
                            <!-- Bill Meta Info -->
                            <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-300">
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Published recently</span>
                                </span>
                                <span class="text-gray-400">•</span>
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span>Public View</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="px-8 py-6">
                        <div class="prose prose-lg max-w-none dark:prose-invert mb-6">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg font-light">
                                {{ $bill->content }}
                            </p>
                        </div>

                        <!-- Enhanced Stats Section -->
                        <div class="flex items-center justify-between p-6 bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-700/50 dark:to-blue-900/20 rounded-2xl border border-gray-200/50 dark:border-gray-600/50 mb-6">
                            <div class="flex items-center space-x-6">
                                <div class="flex items-center space-x-2 px-4 py-2 bg-pink-100 dark:bg-pink-900/30 rounded-full">
                                    <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-pink-700 dark:text-pink-300">{{ $bill->likes_count }}</span>
                                    <span class="text-pink-600 dark:text-pink-400 text-sm">likes</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 px-4 py-2 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-blue-700 dark:text-blue-300">{{ $bill->comments_count }}</span>
                                    <span class="text-blue-600 dark:text-blue-400 text-sm">comments</span>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Comments Section -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h8z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                    Comments 
                                    <span class="text-lg font-normal text-gray-500 dark:text-gray-400">
                                        ({{ $bill->comments->count() }})
                                    </span>
                                </h3>
                            </div>

                            @forelse($bill->comments as $comment)
                                <div class="comment-card bg-gradient-to-r from-white to-gray-50 dark:from-gray-700 dark:to-gray-800 rounded-xl p-6 shadow-md border border-gray-200/50 dark:border-gray-600/50">
                                    <div class="flex items-start space-x-4">
                                        <!-- User Avatar -->
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">
                                                    {{ strtoupper(substr($comment->user->name ?? 'G', 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <!-- Comment Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $comment->user->name ?? 'Guest' }}
                                                </h4>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    •
                                                </span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    Just now
                                                </span>
                                            </div>
                                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                                {{ $comment->content }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg">
                                        No comments yet. Be the first to share your thoughts!
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer spacing -->
        <div class="h-16"></div>
    </div>

</body>
</html>