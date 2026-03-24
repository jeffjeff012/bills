<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')

</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('dashboard') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0"
            wire:navigate>
            <x-app-logo />
        </a>

        <flux:navbar class="-mb-px max-lg:hidden">
            {{-- <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
                <flux:navbar.item icon="layout-grid" :href="route('notes')" :current="request()->routeIs('notes')" wire:navigate>
                    {{ __('Notes') }}
                </flux:navbar.item> --}}
            @auth
                @if (auth()->user()->role === App\Enums\UserRole::Admin)
                    <flux:navbar.item icon="home" :href="route('admin.dashboard')"
                        :current="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')" wire:navigate>
                        {{ __('Dashboard') }}</flux:navbar.item>
                    <flux:navbar.item icon="notebook-open" :href="route('view-details')"
                        :current="request()->routeIs('view-details')" wire:navigate>{{ __('Bills') }}</flux:navbar.item>
                    <flux:navbar.item icon="users" :href="route('admin.user-management')"
                        :current="request()->routeIs('admin.user-management')" wire:navigate>
                        {{ __('User Management') }}
                    </flux:navbar.item>
                    <flux:navbar.item icon="megaphone" :href="route('report-of-bills')"
                        :current="request()->routeIs('report-of-bills')" wire:navigate>
                        {{ __('Report of Bills') }}
                    </flux:navbar.item>
                    <flux:navbar.item icon="building-library" :href="route('committees.manage')"
                        :current="request()->routeIs('committees.manage')" wire:navigate>
                        {{ __('Committees') }}
                    </flux:navbar.item>
                    <flux:navbar.item icon="clipboard-document-list" :href="route('admin.activity.logs')"
                        :current="request()->routeIs('admin.activity.logs')" wire:navigate>
                        {{ __('Activity Logs') }}
                    </flux:navbar.item>
                @endif


                @if (auth()->user()->role === App\Enums\UserRole::SbStaff)
                    <flux:navbar.item icon="home" :href="route('staff.dashboard')"
                        :current="request()->routeIs('dashboard') || request()->routeIs('staff.dashboard')" wire:navigate>
                        {{ __('SB Dashboard') }}</flux:navbar.item>
                    <flux:navbar.item icon="notebook-open" :href="route('report-of-bills')"
                        :current="request()->routeIs('report-of-bills')" wire:navigate>{{ __('Report of Bills') }}
                    </flux:navbar.item>
                    <flux:navbar.item icon="megaphone" :href="route('view-details')"
                        :current="request()->routeIs('view-details')" wire:navigate>
                        {{ __('Bills') }}
                    </flux:navbar.item>
                    <flux:navbar.item icon="building-library" :href="route('committees.manage')"
                        :current="request()->routeIs('committees.manage')" wire:navigate>
                        {{ __('Committees') }}
                    </flux:navbar.item>
                @endif


                @if (auth()->user()->role === App\Enums\UserRole::User)
                    <flux:navbar.item icon="list-bullet" :href="route('dashboard')"
                        :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Active Bills') }}
                    </flux:navbar.item>

                    <flux:separator variant="subtle" />

                    <flux:navbar.item icon="bell-slash" :href="route('inactive-bills')"
                        :current="request()->routeIs('inactive-bills')" wire:navigate>
                        {{ __('Inactive Bills') }}
                    </flux:navbar.item>
                @endif
            @endauth
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
            @include('partials.theme')
        </flux:navbar>

        <!-- Desktop User Menu -->
        <flux:dropdown position="top" align="end">
            {{-- @auth --}}
            <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />
            {{-- @endauth --}}

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{-- @auth --}}
                                        {{ auth()->user()->initials() }}
                                    {{-- @endauth --}}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                {{-- @auth --}}
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                {{-- @endauth --}}
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar stashable sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')">
                @auth
                    @if (auth()->user()->role === App\Enums\UserRole::Admin)
                        <flux:navlist.item icon="home" :href="route('admin.dashboard')"
                            :current="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')"
                            wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                        <flux:navlist.item icon="notebook-open" :href="route('view-details')"
                            :current="request()->routeIs('view-details')" wire:navigate>{{ __('Bills') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="users" :href="route('admin.user-management')"
                            :current="request()->routeIs('admin.user-management')" wire:navigate>
                            {{ __('User Management') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="megaphone" :href="route('report-of-bills')"
                            :current="request()->routeIs('report-of-bills')" wire:navigate>
                            {{ __('Report of Bills') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="building-library" :href="route('committees.manage')"
                            :current="request()->routeIs('committees.manage')" wire:navigate>
                            {{ __('Committees') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="clipboard-document-list" :href="route('admin.activity.logs')"
                            :current="request()->routeIs('admin.activity.logs')" wire:navigate>
                            {{ __('Activity Logs') }}
                        </flux:navlist.item>
                    @endif


                    @if (auth()->user()->role === App\Enums\UserRole::SbStaff)
                        <flux:navlist.item icon="home" :href="route('staff.dashboard')"
                            :current="request()->routeIs('dashboard') || request()->routeIs('staff.dashboard')"
                            wire:navigate>{{ __('SB Dashboard') }}</flux:navlist.item>
                        <flux:navlist.item icon="notebook-open" :href="route('report-of-bills')"
                            :current="request()->routeIs('report-of-bills')" wire:navigate>{{ __('Report of Bills') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="megaphone" :href="route('view-details')"
                            :current="request()->routeIs('view-details')" wire:navigate>
                            {{ __('Bills') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="building-library" :href="route('committees.manage')"
                            :current="request()->routeIs('committees.manage')" wire:navigate>
                            {{ __('Committees') }}
                        </flux:navlist.item>
                    @endif

                    @if (auth()->user()->role === App\Enums\UserRole::User)
                        <flux:navlist.item icon="list-bullet" :href="route('dashboard')"
                            :current="request()->routeIs('dashboard')" wire:navigate>
                            {{ __('Active Bills') }}
                        </flux:navlist.item>

                        <flux:separator variant="subtle" />

                        <flux:navlist.item icon="bell-slash" :href="route('inactive-bills')"
                            :current="request()->routeIs('inactive-bills')" wire:navigate>
                            {{ __('Inactive Bills') }}
                        </flux:navlist.item>
                    @endif
                @endauth
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        {{-- <flux:navlist variant="outline">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                target="_blank">
                {{ __('Repository') }}
            </flux:navlist.item>

            <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:navlist.item>
        </flux:navlist> --}}
    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
</body>

</html>
