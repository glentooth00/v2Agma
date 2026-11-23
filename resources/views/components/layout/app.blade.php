
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'AGMA ONE' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        h1, h2, h3, h4 {
            font-family: 'Manrope', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-[#F7F8F6] text-[#172B3A] antialiased">

    <x-ui.sidebar-provider :default-open="true" persist="agma_sidebar">

        {{-- SIDEBAR --}}
        <x-ui.sidebar collapsible="icon" class="border-r border-[#E8ECE7] bg-white">

            {{-- SIDEBAR HEADER --}}
            <x-ui.sidebar-header class="border-b border-[#E8ECE7] px-4 py-5">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#172B3A] text-white">
                        <span class="text-sm font-extrabold">A</span>
                    </div>

                    <div class="min-w-0 group-data-[collapsible=icon]:hidden">
                        <h2 class="font-extrabold tracking-tight text-[#172B3A]">
                            AGMA ONE
                        </h2>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#789A60]">
                            Assembly Management
                        </p>
                    </div>
                </a>
            </x-ui.sidebar-header>

            {{-- SIDEBAR CONTENT --}}
            <x-ui.sidebar-content class="px-3 py-4">

                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-label>
                        Main Menu
                    </x-ui.sidebar-group-label>

                    <x-ui.sidebar-group-content>
                        <x-ui.sidebar-menu>

                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button
                                    as="a"
                                    href="{{ route('dashboard') }}"
                                    :is-active="request()->routeIs('dashboard')"
                                    tooltip="Dashboard">
                                    <x-lucide-layout-dashboard class="h-4 w-4" />
                                    <span>Dashboard</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>

                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button as="a" href="{{ route('members.index') }}" tooltip="Members">
                                    <x-lucide-users class="h-4 w-4" />
                                    <span>Members</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>

                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button as="a" href="#" tooltip="AGM Events">
                                    <x-lucide-calendar-days class="h-4 w-4" />
                                    <span>AGM Events</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>

                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button as="a" href="#" tooltip="Registrations">
                                    <x-lucide-clipboard class="h-4 w-4" />
                                    <span>Registrations</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>

                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button as="a" href="#" tooltip="Attendance">
                                    <x-lucide-user-check class="h-4 w-4" />
                                    <span>Attendance</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>

                        </x-ui.sidebar-menu>
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>

                <x-ui.sidebar-separator class="my-4" />

                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-label>
                        Management
                    </x-ui.sidebar-group-label>

                    <x-ui.sidebar-group-content>
                        <x-ui.sidebar-menu>

                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button as="a" href="#" tooltip="Reports">
                                    <x-lucide-chart-no-axes-combined class="h-4 w-4" />
                                    <span>Reports</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>

                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button as="a" href="{{ route('scanner-users.index') }}" tooltip="Scanner Users">
                                    <x-lucide-scan-line class="h-4 w-4" />
                                    <span>Scanner Users</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>

                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button as="a" href="#" tooltip="System Settings">
                                    <x-lucide-settings class="h-4 w-4" />
                                    <span>System Settings</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>

                        </x-ui.sidebar-menu>
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>

            </x-ui.sidebar-content>

            {{-- SIDEBAR FOOTER --}}
            <x-ui.sidebar-footer class="border-t border-[#E8ECE7] p-3">

                <div class="flex items-center gap-3 rounded-xl p-2 group-data-[collapsible=icon]:justify-center">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#EAF0E6] text-sm font-bold text-[#587447]">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>

                    <div class="min-w-0 flex-1 group-data-[collapsible=icon]:hidden">
                        <p class="truncate text-sm font-bold text-[#172B3A]">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </p>
                        <p class="truncate text-xs text-slate-500">
                            {{ auth()->user()->email ?? '' }}
                        </p>
                    </div>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-ui.sidebar-menu>
                        <x-ui.sidebar-menu-item>
                            <x-ui.sidebar-menu-button type="submit" tooltip="Sign out">
                                <x-lucide-log-out class="h-4 w-4" />
                                <span>Sign Out</span>
                            </x-ui.sidebar-menu-button>
                        </x-ui.sidebar-menu-item>
                    </x-ui.sidebar-menu>
                </form>

            </x-ui.sidebar-footer>

        </x-ui.sidebar>

        {{-- MAIN CONTENT --}}
        <x-ui.sidebar-inset>

            {{-- TOP HEADER --}}
            <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-[#E8ECE7] bg-white/95 px-5 backdrop-blur sm:px-8">

                <div class="flex items-center gap-4">
                    <x-ui.sidebar-trigger />

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            AGMA ONE
                        </p>
                        <h1 class="text-sm font-bold text-[#172B3A]">
                            {{ $title ?? 'Dashboard' }}
                        </h1>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden text-right sm:block">
                        <p class="text-xs font-semibold text-[#172B3A]">
                            {{ now()->format('l') }}
                        </p>
                        <p class="text-[11px] text-slate-500">
                            {{ now()->format('F d, Y') }}
                        </p>
                    </div>
                </div>

            </header>

            {{-- PAGE CONTENT --}}
            <main class="min-h-[calc(100vh-4rem)] p-5 sm:p-8">
                {{ $slot ?? '' }}
                @yield('content')
            </main>

        </x-ui.sidebar-inset>

    </x-ui.sidebar-provider>

    @livewireScripts

</body>
</html>
