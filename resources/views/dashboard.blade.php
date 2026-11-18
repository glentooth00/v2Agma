
<x-layout.app title="Dashboard">

    <div class="space-y-8">

        {{-- PAGE HEADING --}}
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>

                <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-[#172B3A]">
                    Dashboard Overview
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Welcome back, {{ auth()->user()->name ?? 'Administrator' }}.
                    Here's what's happening with your assembly.
                </p>
            </div>

            <div class="flex w-fit items-center gap-2 rounded-full border border-[#DDE8D5] bg-white px-4 py-2 shadow-sm">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-50"></span>
                    <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-[#789A60]"></span>
                </span>

                <span class="text-xs font-semibold text-[#587447]">
                    System Operational
                </span>
            </div>
        </div>

        {{-- STATISTICS --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

            {{-- TOTAL MEMBERS --}}
            <div class="group rounded-2xl border border-[#E8ECE7] bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Members
                        </p>

                        <h3 class="mt-3 text-3xl font-extrabold tracking-tight text-[#172B3A]">
                            {{ number_format($totalMembers ?? 0) }}
                        </h3>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <x-lucide-users class="h-5 w-5" />
                    </div>
                </div>

                <div class="mt-5 border-t border-[#F0F2EE] pt-3">
                    <p class="text-xs text-slate-400">
                        Registered member-consumers
                    </p>
                </div>
            </div>

            {{-- REGISTRATIONS --}}
            <div class="group rounded-2xl border border-[#E8ECE7] bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            AGM Registrations
                        </p>

                        <h3 class="mt-3 text-3xl font-extrabold tracking-tight text-[#172B3A]">
                            {{ number_format($totalRegistrations ?? 0) }}
                        </h3>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                        <x-lucide-clipboard class="h-5 w-5" />
                    </div>
                </div>

                <div class="mt-5 border-t border-[#F0F2EE] pt-3">
                    <p class="text-xs text-slate-400">
                        Total assembly registrations
                    </p>
                </div>
            </div>

            {{-- MEMBERS PRESENT --}}
            <div class="group rounded-2xl border border-[#E8ECE7] bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Members Present
                        </p>

                        <h3 class="mt-3 text-3xl font-extrabold tracking-tight text-[#172B3A]">
                            {{ number_format($totalPresent ?? 0) }}
                        </h3>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-green-600">
                        <x-lucide-user-check class="h-5 w-5" />
                    </div>
                </div>

                <div class="mt-5 border-t border-[#F0F2EE] pt-3">
                    <p class="text-xs text-slate-400">
                        Successfully checked in
                    </p>
                </div>
            </div>

            {{-- ACTIVE EVENTS --}}
            <div class="group rounded-2xl border border-[#E8ECE7] bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Active AGM Events
                        </p>

                        <h3 class="mt-3 text-3xl font-extrabold tracking-tight text-[#172B3A]">
                            {{ number_format($activeEvents ?? 0) }}
                        </h3>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                        <x-lucide-calendar-days class="h-5 w-5" />
                    </div>
                </div>

                <div class="mt-5 border-t border-[#F0F2EE] pt-3">
                    <p class="text-xs text-slate-400">
                        Currently active assemblies
                    </p>
                </div>
            </div>

        </div>

        {{-- MAIN DASHBOARD CONTENT --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

            {{-- ASSEMBLY OVERVIEW --}}
            <div class="rounded-2xl border border-[#E8ECE7] bg-white p-6 shadow-sm xl:col-span-2">

                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                    <div>
                        <h3 class="text-base font-bold text-[#172B3A]">
                            Assembly Overview
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Attendance summary for the current assembly
                        </p>
                    </div>

                    <span class="w-fit rounded-full border border-[#DDE8D5] bg-[#F1F6ED] px-3 py-1.5 text-xs font-semibold text-[#587447]">
                        Current AGM
                    </span>
                </div>

                @php
                    $registrations = $totalRegistrations ?? 0;
                    $present = $totalPresent ?? 0;

                    $attendanceRate = $registrations > 0
                        ? min(100, round(($present / $registrations) * 100))
                        : 0;

                    $notPresent = max(0, $registrations - $present);
                @endphp

                {{-- ATTENDANCE RATE --}}
                <div class="mt-8">
                    <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-end">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Attendance Rate
                            </p>

                            <h2 class="mt-1 text-4xl font-extrabold tracking-tight text-[#172B3A]">
                                {{ $attendanceRate }}<span class="text-2xl text-slate-400">%</span>
                            </h2>
                        </div>

                        <p class="text-xs text-slate-400">
                            {{ number_format($present) }} of
                            {{ number_format($registrations) }} registered
                        </p>
                    </div>

                    <div class="mt-4 h-3 overflow-hidden rounded-full bg-[#EDF0EB]">
                        <div
                            class="h-full rounded-full bg-[#789A60] transition-all duration-500"
                            style="width: {{ $attendanceRate }}%"
                        ></div>
                    </div>
                </div>

                {{-- ATTENDANCE BREAKDOWN --}}
                <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-3">

                    <div class="rounded-xl border border-[#E5EDDF] bg-[#F8FAF6] p-4">
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#789A60]"></span>

                            <p class="text-xs font-medium text-slate-500">
                                Present
                            </p>
                        </div>

                        <h4 class="mt-3 text-2xl font-bold text-[#172B3A]">
                            {{ number_format($present) }}
                        </h4>
                    </div>

                    <div class="rounded-xl border border-[#F4E7D8] bg-[#FFFAF4] p-4">
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-orange-400"></span>

                            <p class="text-xs font-medium text-slate-500">
                                Not Yet Present
                            </p>
                        </div>

                        <h4 class="mt-3 text-2xl font-bold text-[#172B3A]">
                            {{ number_format($notPresent) }}
                        </h4>
                    </div>

                    <div class="rounded-xl border border-[#DFEAF5] bg-[#F6FAFE] p-4">
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span>

                            <p class="text-xs font-medium text-slate-500">
                                Total Registered
                            </p>
                        </div>

                        <h4 class="mt-3 text-2xl font-bold text-[#172B3A]">
                            {{ number_format($registrations) }}
                        </h4>
                    </div>

                </div>
            </div>

            {{-- QUICK ACTIONS --}}
            <div class="rounded-2xl border border-[#E8ECE7] bg-white p-6 shadow-sm">

                <div>
                    <h3 class="text-base font-bold text-[#172B3A]">
                        Quick Actions
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Common administrative tasks
                    </p>
                </div>

                <div class="mt-6 space-y-3">

                    {{-- CREATE EVENT --}}
                    <a href="#"
                        class="group flex items-center gap-3 rounded-xl border border-[#E8ECE7] bg-white p-3 transition hover:border-[#B8CDAA] hover:bg-[#F8FAF6]">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#EDF3E9] text-[#587447]">
                            <x-lucide-calendar-plus class="h-5 w-5" />
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-[#172B3A]">
                                Create AGM Event
                            </p>

                            <p class="text-xs text-slate-500">
                                Set up a new assembly
                            </p>
                        </div>

                        <x-lucide-chevron-right class="h-4 w-4 text-slate-400 transition group-hover:translate-x-1" />
                    </a>

                    {{-- MANAGE MEMBERS --}}
                    <a href="#"
                        class="group flex items-center gap-3 rounded-xl border border-[#E8ECE7] bg-white p-3 transition hover:border-blue-200 hover:bg-blue-50/40">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <x-lucide-user-plus class="h-5 w-5" />
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-[#172B3A]">
                                Manage Members
                            </p>

                            <p class="text-xs text-slate-500">
                                View member-consumer records
                            </p>
                        </div>

                        <x-lucide-chevron-right class="h-4 w-4 text-slate-400 transition group-hover:translate-x-1" />
                    </a>

                    {{-- ATTENDANCE --}}
                    <a href="#"
                        class="group flex items-center gap-3 rounded-xl border border-[#E8ECE7] bg-white p-3 transition hover:border-purple-200 hover:bg-purple-50/40">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                            <x-lucide-scan-line class="h-5 w-5" />
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-[#172B3A]">
                                Attendance Monitoring
                            </p>

                            <p class="text-xs text-slate-500">
                                Monitor member check-ins
                            </p>
                        </div>

                        <x-lucide-chevron-right class="h-4 w-4 text-slate-400 transition group-hover:translate-x-1" />
                    </a>

                </div>
            </div>

        </div>

        {{-- RECENT REGISTRATIONS --}}
        <div class="overflow-hidden rounded-2xl border border-[#E8ECE7] bg-white shadow-sm">

            <div class="flex flex-col justify-between gap-3 border-b border-[#E8ECE7] px-6 py-5 sm:flex-row sm:items-center">
                <div>
                    <h3 class="text-base font-bold text-[#172B3A]">
                        Recent Registrations
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Latest member-consumer registrations
                    </p>
                </div>

                <a href="#"
                    class="text-xs font-bold text-[#789A60] transition hover:text-[#587447]">
                    View All Registrations
                    <span aria-hidden="true">→</span>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">

                    <thead class="bg-[#F8FAF7] text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4">Member / Consumer</th>
                            <th class="px-6 py-4">Account Number</th>
                            <th class="px-6 py-4">Classification</th>
                            <th class="px-6 py-4">Registration Date</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#EDF0EB]">

                        @forelse(($recentRegistrations ?? []) as $registration)

                            <tr class="transition hover:bg-[#FAFCF9]">

                                <td class="whitespace-nowrap px-6 py-4 font-semibold text-[#172B3A]">
                                    {{ $registration->name }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-slate-600">
                                    {{ $registration->account_number }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                        {{ str($registration->classification)->replace('_', ' ')->title() }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-slate-500">
                                    {{ $registration->created_at?->format('M d, Y') }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#EDF5E9] px-3 py-1 text-xs font-semibold text-[#587447]">
                                        <span class="h-1.5 w-1.5 rounded-full bg-[#789A60]"></span>
                                        Registered
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-14 text-center">

                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#F3F5F1] text-slate-400">
                                        <x-lucide-inbox class="h-6 w-6" />
                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-[#172B3A]">
                                        No registrations yet
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        New member registrations will appear here.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="flex flex-col justify-between gap-3 rounded-2xl border border-[#E8ECE7] bg-white px-6 py-5 shadow-sm sm:flex-row sm:items-center">
            <div>
                <p class="text-sm font-bold text-[#172B3A]">
                    AGMA ONE
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    Every member. Every voice. One assembly.
                </p>
            </div>

            <p class="text-xs text-slate-400">
                Assembly & Member Management System
            </p>
        </div>

    </div>

</x-layout.app>
