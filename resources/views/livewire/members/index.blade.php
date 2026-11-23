
<div class="min-h-screen space-y-6 bg-[#F7F8F6] px-4 py-6 sm:px-6 lg:px-8">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <div class="mb-2 flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.16em] text-[#789A60]">
                <span>AGMA ONE</span>
                <span class="text-slate-300">/</span>
                <span>Administration</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-[#172B3A]">
                Members
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Search, view, and manage registered member-consumers.
            </p>
        </div>

        <div class="inline-flex w-fit items-center gap-2 rounded-xl border border-[#E6EBE3] bg-white px-4 py-3 shadow-sm">
            <x-lucide-users class="size-4 text-[#789A60]" />

            <span class="text-sm font-semibold text-[#172B3A]">
                Member Directory
            </span>
        </div>

    </div>


    {{-- SEARCH FILTERS --}}
    <div class="overflow-hidden rounded-2xl border border-[#E6EBE3] bg-white shadow-sm">

        {{-- SEARCH HEADER --}}
        <div class="flex items-center gap-3 border-b border-[#E6EBE3] px-5 py-4">

            <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-[#EEF3E9]">
                <x-lucide-search class="size-5 text-[#789A60]" />
            </div>

            <div>
                <h2 class="text-sm font-bold text-[#172B3A]">
                    Search Members
                </h2>

                <p class="mt-0.5 text-xs text-slate-500">
                    Filter member records using personal information and membership status.
                </p>
            </div>

        </div>

        {{-- SEARCH FORM --}}
        <form wire:submit.prevent="$refresh">

            <div class="p-5">

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                    {{-- FIRST NAME --}}
                    <div>
                        <label for="firstname"
                            class="mb-1.5 block text-xs font-semibold text-[#344B60]">
                            First Name
                        </label>

                        <div class="relative">
                            <x-lucide-user
                                class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />

                            <input
                                type="text"
                                id="firstname"
                                wire:model="firstname"
                                placeholder="Search first name"
                                autocomplete="off"
                                class="h-11 w-full rounded-xl border border-[#E2E8E0] bg-[#FAFBF9] pl-10 pr-3 text-sm text-[#172B3A] outline-none transition focus:border-[#789A60] focus:bg-white focus:ring-2 focus:ring-[#789A60]/10 placeholder:text-slate-400"
                            >
                        </div>
                    </div>

                    {{-- MIDDLE NAME --}}
                    <div>
                        <label for="middlename"
                            class="mb-1.5 block text-xs font-semibold text-[#344B60]">
                            Middle Name
                        </label>

                        <div class="relative">
                            <x-lucide-user-round
                                class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />

                            <input
                                type="text"
                                id="middlename"
                                wire:model="middlename"
                                placeholder="Search middle name"
                                autocomplete="off"
                                class="h-11 w-full rounded-xl border border-[#E2E8E0] bg-[#FAFBF9] pl-10 pr-3 text-sm text-[#172B3A] outline-none transition focus:border-[#789A60] focus:bg-white focus:ring-2 focus:ring-[#789A60]/10 placeholder:text-slate-400"
                            >
                        </div>
                    </div>

                    {{-- LAST NAME --}}
                    <div>
                        <label for="lastname"
                            class="mb-1.5 block text-xs font-semibold text-[#344B60]">
                            Last Name
                        </label>

                        <div class="relative">
                            <x-lucide-user-round
                                class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />

                            <input
                                type="text"
                                id="lastname"
                                wire:model="lastname"
                                placeholder="Search last name"
                                autocomplete="off"
                                class="h-11 w-full rounded-xl border border-[#E2E8E0] bg-[#FAFBF9] pl-10 pr-3 text-sm text-[#172B3A] outline-none transition focus:border-[#789A60] focus:bg-white focus:ring-2 focus:ring-[#789A60]/10 placeholder:text-slate-400"
                            >
                        </div>
                    </div>

                    {{-- MEMBERSHIP STATUS --}}
                    <div>
                        <label for="membership_status"
                            class="mb-1.5 block text-xs font-semibold text-[#344B60]">
                            Membership Status
                        </label>

                        <x-ui.select
                            id="membership_status"
                            wire:model="membership_status"
                        >
                            <x-ui.select-trigger
                                class="h-11 w-full rounded-xl border-[#E2E8E0] bg-[#FAFBF9]"
                                aria-label="Membership Status"
                            >
                                <x-ui.select-value placeholder="All Statuses" />
                            </x-ui.select-trigger>

                            <x-ui.select-content>
                                <x-ui.select-item value="">
                                    All Statuses
                                </x-ui.select-item>

                                <x-ui.select-item value="Active">
                                    Active
                                </x-ui.select-item>

                                <x-ui.select-item value="Inactive">
                                    Inactive
                                </x-ui.select-item>
                            </x-ui.select-content>
                        </x-ui.select>
                    </div>

                </div>

                {{-- SEARCH ACTIONS --}}
                <div class="mt-5 flex flex-col gap-3 border-t border-[#EEF0EC] pt-4 sm:flex-row sm:items-center sm:justify-between">

                    <p class="flex items-center gap-1.5 text-xs text-slate-400">
                        <x-lucide-info class="size-3.5 shrink-0" />
                        Enter one or more fields to filter the member directory.
                    </p>

                    <div class="flex items-center justify-end gap-2">

                        {{-- CLEAR --}}
                        <button
                            type="button"
                            wire:click="clearSearch"
                            wire:loading.attr="disabled"
                            wire:target="clearSearch"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-xl border border-[#E2E8E0] bg-white px-4 text-xs font-semibold text-slate-600 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <x-lucide-rotate-ccw class="size-3.5" />
                            Clear
                        </button>

                        {{-- SEARCH --}}
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="$refresh"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-xl bg-[#172B3A] px-5 text-xs font-bold text-white shadow-sm transition hover:bg-[#243F52] disabled:cursor-not-allowed disabled:opacity-60"
                        >
                            <span wire:loading.remove wire:target="$refresh"
                                class="inline-flex items-center gap-2">
                                <x-lucide-search class="size-3.5" />
                                Search Members
                            </span>

                            <span wire:loading wire:target="$refresh"
                                class="inline-flex items-center gap-2">
                                <x-lucide-loader-circle class="size-3.5 animate-spin" />
                                Searching...
                            </span>
                        </button>

                    </div>
                </div>

            </div>

        </form>

    </div>


    {{-- MEMBERS TABLE --}}
    <div class="overflow-hidden rounded-2xl border border-[#E6EBE3] bg-white shadow-sm">

        {{-- TABLE HEADER --}}
        <div class="flex flex-col justify-between gap-3 border-b border-[#E6EBE3] px-5 py-5 sm:flex-row sm:items-center">

            <div>
                <div class="flex items-center gap-2">

                    <h2 class="text-base font-bold text-[#172B3A]">
                        Member Directory
                    </h2>

                    <span class="rounded-full bg-[#EEF3E9] px-2.5 py-1 text-[10px] font-bold text-[#587447]">
                        MEMBERS
                    </span>

                </div>

                <p class="mt-1 text-xs text-slate-500">
                    Registered member-consumer records.
                </p>
            </div>

            {{-- TOTAL MEMBERS --}}
            <div class="flex items-center gap-2 self-start rounded-xl border border-[#E6EBE3] bg-[#FAFBF9] px-3.5 py-2.5 sm:self-auto">

                <x-lucide-users class="size-4 text-[#789A60]" />

                <span class="text-xs font-semibold tabular-nums text-[#172B3A]">
                    {{ number_format($members->total()) }}
                </span>

                <span class="text-xs text-slate-500">
                    members found
                </span>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-[#F7F8F6] text-[10px] uppercase tracking-[0.12em] text-slate-500">

                    <tr>
                        <th class="whitespace-nowrap px-5 py-4 font-bold">
                            #
                        </th>

                        <th class="whitespace-nowrap px-5 py-4 font-bold">
                            Member Information
                        </th>

                        <th class="whitespace-nowrap px-5 py-4 font-bold">
                            Membership Type
                        </th>

                        <th class="whitespace-nowrap px-5 py-4 font-bold">
                            Membership Status
                        </th>

                        <th class="whitespace-nowrap px-5 py-4 text-right font-bold">
                            Action
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-[#EEF0EC]">

                    @forelse($members as $member)

                        @php
                            $type = strtoupper($member->member_type ?? '');

                            $badgeClass = match ($type) {
                                'SINGLE' => 'bg-[#EDF3E9] text-[#587447]',
                                'JOINT' => 'bg-[#E8F1FB] text-[#35679A]',
                                'JURIDICAL' => 'bg-[#F1EAFB] text-[#7952A3]',
                                default => 'bg-slate-100 text-slate-600',
                            };

                            $fullName = trim(
                                ($member->firstname ?? '') . ' ' .
                                ($member->middlename ?? '') . ' ' .
                                ($member->lastname ?? '')
                            );

                            $initials = collect([
                                $member->firstname ?? '',
                                $member->lastname ?? '',
                            ])
                                ->filter()
                                ->map(fn ($name) => strtoupper(substr($name, 0, 1)))
                                ->implode('');

                            $membershipStatus = $member->membership_status ?? '—';

                            $statusClass = match (strtolower($membershipStatus)) {
                                'active' => 'bg-[#EDF3E9] text-[#587447]',
                                'inactive' => 'bg-[#FCEEEE] text-[#B54747]',
                                default => 'bg-slate-100 text-slate-600',
                            };

                            $statusDot = match (strtolower($membershipStatus)) {
                                'active' => 'bg-[#789A60]',
                                'inactive' => 'bg-[#D66B6B]',
                                default => 'bg-slate-400',
                            };
                        @endphp

                        <tr class="transition-colors duration-200 hover:bg-[#FAFBF9]">

                            {{-- ROW NUMBER --}}
                            <td class="whitespace-nowrap px-5 py-4 text-xs font-medium tabular-nums text-slate-400">
                                {{ $members->firstItem() + $loop->index }}
                            </td>

                            {{-- MEMBER INFORMATION --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-[#EEF3E9] text-xs font-bold text-[#587447]">
                                        {{ $initials ?: '?' }}
                                    </div>

                                    <div>
                                        <p class="font-semibold text-[#172B3A]">
                                            {{ $fullName ?: 'Unnamed Member' }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            Member-consumer
                                        </p>
                                    </div>

                                </div>

                            </td>

                            {{-- MEMBERSHIP TYPE --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <span class="inline-flex items-center rounded-full px-3 py-1.5 text-[10px] font-bold tracking-wide {{ $badgeClass }}">
                                    {{ $type ?: '—' }}
                                </span>

                            </td>

                            {{-- MEMBERSHIP STATUS --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-[10px] font-semibold {{ $statusClass }}">

                                    <span class="size-1.5 rounded-full {{ $statusDot }}"></span>

                                    {{ $membershipStatus }}

                                </span>

                            </td>

                            {{-- ACTION --}}
                            <td class="whitespace-nowrap px-5 py-4 text-right">

                                <button
                                    type="button"
                                    class="inline-flex items-center gap-2 rounded-lg border border-[#E6EBE3] bg-white px-3 py-2 text-xs font-semibold text-[#587447] transition hover:border-[#789A60] hover:bg-[#EEF3E9]"
                                >
                                    View Details

                                    <x-lucide-chevron-right class="size-3.5" />
                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">

                                <div class="mx-auto flex size-14 items-center justify-center rounded-2xl bg-[#EEF3E9]">
                                    <x-lucide-users class="size-7 text-[#789A60]" />
                                </div>

                                <h3 class="mt-4 text-sm font-bold text-[#172B3A]">
                                    No members found
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    Try adjusting your search filters.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


            {{-- PAGINATION --}}
            @if ($members->hasPages())

                @php
                    $currentPage = $members->currentPage();
                    $lastPage = $members->lastPage();

                    // Display a maximum of 5 page numbers
                    $window = 5;

                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($lastPage, $startPage + $window - 1);

                    // Keep 5 pages visible when approaching the last page
                    $startPage = max(1, $endPage - $window + 1);
                @endphp

                <div class="flex flex-col justify-between gap-3 border-t border-[#E6EBE3] bg-white px-5 py-4 sm:flex-row sm:items-center">

                    {{-- RECORD COUNT --}}
                    <p class="text-xs text-slate-500">
                        Showing
                        <span class="font-semibold text-[#172B3A]">
                            {{ $members->firstItem() }}
                        </span>
                        to
                        <span class="font-semibold text-[#172B3A]">
                            {{ $members->lastItem() }}
                        </span>
                        of
                        <span class="font-semibold text-[#172B3A]">
                            {{ $members->total() }}
                        </span>
                        members
                    </p>

                    {{-- PAGE NAVIGATION --}}
                    <div class="flex flex-wrap items-center gap-2">

                        {{-- PREVIOUS --}}
                        @if ($members->onFirstPage())
                            <button type="button" disabled
                                class="cursor-not-allowed rounded-lg border border-[#E5EAE3] px-3 py-2 text-xs font-medium text-slate-300">
                                Previous
                            </button>
                        @else
                            <button type="button"
                                wire:click="previousPage"
                                wire:loading.attr="disabled"
                                class="rounded-lg border border-[#E5EAE3] px-3 py-2 text-xs font-medium text-slate-500 transition hover:bg-[#F7F8F6]">
                                Previous
                            </button>
                        @endif

                        {{-- PAGE NUMBERS --}}
                        @foreach (range($startPage, $endPage) as $page)
                            @if ($page == $currentPage)
                                <span
                                    class="rounded-lg bg-[#172B3A] px-3 py-2 text-xs font-semibold text-white">
                                    {{ $page }}
                                </span>
                            @else
                                <button type="button"
                                    wire:click="gotoPage({{ $page }})"
                                    wire:loading.attr="disabled"
                                    class="rounded-lg border border-[#E5EAE3] px-3 py-2 text-xs font-medium text-slate-500 transition hover:bg-[#F7F8F6]">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach

                        {{-- NEXT --}}
                        @if ($members->hasMorePages())
                            <button type="button"
                                wire:click="nextPage"
                                wire:loading.attr="disabled"
                                class="rounded-lg border border-[#E5EAE3] px-3 py-2 text-xs font-medium text-slate-500 transition hover:bg-[#F7F8F6]">
                                Next
                            </button>
                        @else
                            <button type="button" disabled
                                class="cursor-not-allowed rounded-lg border border-[#E5EAE3] px-3 py-2 text-xs font-medium text-slate-300">
                                Next
                            </button>
                        @endif

                    </div>
                </div>

            @endif


    </div>


    {{-- SECURITY / INFORMATION NOTE --}}
    <div class="flex items-start gap-3 rounded-xl border border-[#E5EAF0] bg-[#F5F8FB] p-4">

        <x-lucide-shield-check class="mt-0.5 size-5 shrink-0 text-[#6686A8]" />

        <div>
            <p class="text-sm font-semibold text-[#344B60]">
                Member information is protected
            </p>

            <p class="mt-1 text-xs leading-relaxed text-slate-500">
                Member-consumer information should only be accessed by authorized personnel.
                Verify member details before confirming attendance.
            </p>
        </div>

    </div>

</div>
