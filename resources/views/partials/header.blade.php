 <script src="https://cdn.tailwindcss.com"></script>

<header class="mt-5 z-50 mx-auto w-full max-w-7xl px-4 text-sm mb-6 not-has-[nav]:hidden">
        <div class="flex items-center justify-between ">
            <!-- Logo (Left side) -->
            <div class="flex items-center gap-2">
                <img src="/images/logo.jpg" alt="Logo" class="h-[110px] w-auto" />
                <!-- Optional: add site title next to logo -->
                <!-- <span class="text-lg font-semibold">YourSite</span> -->
            </div>

            <!-- Navigation / Auth Buttons (Right side) -->
            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">Dashboard</a>
                    @else
                        <a 
                            href="{{ route('login') }}" 
                            class="inline-block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] 
                                border border-gray-400 rounded-lg 
                                text-xl leading-normal transition-all duration-200 
                                hover:bg-blue-300 hover:border-blue-600"
                        >
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a 
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 text-white bg-blue-600 hover:bg-blue-700 dark:text-white rounded-lg text-xl leading-normal transition-colors duration-200"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>