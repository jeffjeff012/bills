<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-4px); }
            40% { transform: translateX(4px); }
            60% { transform: translateX(-4px); }
            80% { transform: translateX(4px); }
        }

        /* Use Tailwind's group-hover class on this */
        .group:hover .shake-on-group-hover {
            animation: shake 0.4s ease-in-out;
        }
    </style>

    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
                <div class="absolute inset-0 bg-neutral-900"></div>
                    <a href="{{ route('welcome') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-md">
                        <x-app-logo-icon class="me-2 h-7 fill-current text-white" />
                    </span>
                    {{ config('app.name', 'Laravel') }}
                </a>

            {{-- images in split login --}}
            <div class="flex p-4 ">
                <div class="group mt-10 mr-4 relative z-10 block max-w-sm p-6 border border-gray-200 rounded-lg shadow-sm backdrop-blur-md bg-white/30 dark:bg-white/10 transition-transform duration-300 ease-in-out hover:scale-105 hover:ring-2 hover:ring-blue-400/50">
                    <svg class="shake-on-group-hover mb-20 w-20 h-20 text-gray-800 dark:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 19">
                        <path d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z"/>
                    </svg>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Support or Reject a Proposal
                    </h5>
                    <p class="font-normal text-white-700 dark:text-gray-400">
                        Let your voice be heard by liking or disliking bills that affect the future of Bayambang.
                    </p>
                </div>

                <div class="group mt-10 mr-4 relative z-10 block max-w-sm p-6 border border-gray-200 rounded-lg shadow-sm backdrop-blur-md bg-white/30 dark:bg-white/10 transition-transform duration-300 ease-in-out hover:scale-105 hover:ring-2 hover:ring-blue-400/50">
                    <svg class="shake-on-group-hover mb-20 w-20 h-20 text-gray-800 dark:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 18">
                        <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.546l3.2 3.659a1 1 0 0 0 1.506 0L13.454 14H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-8 10H5a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Zm5-4H5a1 1 0 0 1 0-2h10a1 1 0 1 1 0 2Z"/>
                    </svg>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Share Your Honest Feedback
                    </h5>
                    <p class="font-normal text-white-700 dark:text-gray-400">
                        Leave your thoughts and ideas to help us improve local policies and serve you better.
                    </p>
                </div>
  
                <!-- Card div with `group` class -->
                <div class="group mt-10 relative z-10 block max-w-sm p-6 border border-gray-200 rounded-lg shadow-sm backdrop-blur-md bg-white/30 dark:bg-white/10 transition-transform duration-300 ease-in-out hover:scale-105 hover:ring-2 hover:ring-blue-400/50">

                    <!-- SVG will shake when the parent `.group` is hovered -->
                    <svg class="mb-20 w-20 h-20 text-gray-800 dark:text-white shake-on-group-hover"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Stay Informed on New Bills
                    </h5>
                    <p class="font-normal text-white-700 dark:text-gray-400">
                        Get updates on the latest proposals and learn how they aim to improve our community.
                    </p>
                </div>
            </div>

                @php
                    [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
                @endphp

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-2">
                        <flux:heading class="text-white" size="lg">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                        <footer><flux:heading class="text-white">{{ trim($author) }}</flux:heading></footer>
                    </blockquote>
                </div>
            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('welcome') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                        <span class="flex h-20 w-20 items-center justify-center rounded-md">
                            <x-app-logo-icon class="mr-2 fill-current text-black dark:text-white" />
                        </span>

                        {{-- <span class="sr-only">{{ config('app.name', 'Laravel') }}</span> --}}
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
