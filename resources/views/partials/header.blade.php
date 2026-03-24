 <header class="py-3 z-50 mx-auto w-full max-w-7xl px-4 text-sm not-has-[nav]:hidden">
     <div class="flex items-center justify-between ">
         <!-- Logo (Left side) -->
         <div class="flex items-center gap-2">
             <img src="/images/final.png" alt="Logo" class="h-[80px] lg:h-[110px] w-auto" />
             <!-- Optional: add site title next to logo -->
             <span class="text-lg font-semibold">Bayambang Bills</span>
         </div>

         <!-- Navigation / Auth Buttons (Right side) -->
         @if (Route::has('login'))
             <nav class="flex items-center gap-4">
                 <div class="hidden lg:flex flex-wrap items-center gap-2 ml-5">
                     @auth
                         <a href="{{ url('/dashboard') }}"
                             class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">Dashboard</a>
                     @else
                         <a href="{{ route('login') }}"
                             class="nav-auth-cta inline-block text-xl px-5 py-2 border border-gray-400 rounded-lg text-gray-900 dark:text-gray-50 transition-all duration-200 hover:bg-blue-300 hover:border-blue-600">
                             Log in
                         </a>
                         @if (Route::has('register'))
                             <a href="{{ route('register') }}"
                                 class="inline-block px-5 py-1.5 text-white bg-blue-600 hover:bg-blue-700 dark:text-white rounded-lg text-xl leading-normal transition-colors duration-200">
                                 Register
                             </a>
                         @endif
                     @endauth
                 </div>

                 <!-- Mobile Hamburger Menu (visible on mobile/tablet, hidden on laptop+) -->
                 <div class="lg:hidden relative">
                     <!-- Hamburger Button -->
                     <button id="mobile-menu-button"
                         class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                         <span class="sr-only">Open main menu</span>
                         <!-- Hamburger Icon -->
                         <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M4 6h16M4 12h16M4 18h16" />
                         </svg>
                     </button>

                     <!-- Mobile Menu Dropdown -->
                     <div id="mobile-menu"
                         class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                         <div class="py-1">
                             @auth
                                 <a href="{{ url('/dashboard') }}"
                                     class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                     Dashboard
                                 </a>
                             @else
                                 <a href="{{ route('login') }}"
                                     class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                     Log in
                                 </a>
                                 @if (Route::has('register'))
                                     <a href="{{ route('register') }}"
                                         class="block px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 mx-2 my-1 rounded">
                                         Register
                                     </a>
                                 @endif
                             @endauth
                         </div>
                     </div>
                 </div>
             </nav>

             <script>
                 document.addEventListener('click', function(e) {

                     const button = e.target.closest('#mobile-menu-button');
                     const menu = document.getElementById('mobile-menu');

                     if (button && menu) {
                         menu.classList.toggle('hidden');
                         return;
                     }

                     if (menu && !menu.contains(e.target)) {
                         menu.classList.add('hidden');
                     }

                 });
             </script>
         @endif
     </div>
 </header>
