
<div class="space-y-6">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-[#789A60]">
                Member Management
            </p>

            <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-[#172B3A]">
                Members
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Search and manage registered member-consumers.
            </p>
        </div>

        <span class="inline-flex w-fit items-center rounded-full bg-[#EDF3E9] px-3 py-1.5 text-xs font-semibold text-[#587447]">
            <x-lucide-users class="mr-2 h-4 w-4" />
            Member Directory
        </span>
    </div>

    {{-- SEARCH FILTERS --}}
    <div class="rounded-2xl border border-[#E8ECE7] bg-white p-5 shadow-sm">

        <div class="mb-5">
            <div class="flex items-center gap-2">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#EDF3E9]">
                    <x-lucide-search class="h-4 w-4 text-[#789A60]" />
                </div>

                <div>
                    <h2 class="text-base font-bold text-[#172B3A]">
                        Search Members
                    </h2>

                    <p class="text-xs text-slate-500">
                        Filter the directory using the member's name.
                    </p>
                </div>
            </div>
        </div>


<form wire:submit.prevent="$refresh">

    {{-- SEARCH INPUTS --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

        {{-- FIRST NAME --}}
        <div class="space-y-2">
            <label for="firstname"
                class="block text-sm font-semibold text-[#34465A]">
                First Name
            </label>

            <div class="relative">
                <x-lucide-user
                    class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />

                <input
                    type="text"
                    id="firstname"
                    wire:model="firstname"
                    placeholder="Search first name"
                    autocomplete="off"
                    class="h-12 w-full rounded-xl border border-[#E2E8E0] bg-[#FAFBF9] pl-10 pr-4 text-sm text-[#172B3A] outline-none transition duration-200 placeholder:text-slate-400 hover:border-[#C9D5C3] focus:border-[#789A60] focus:bg-white focus:ring-4 focus:ring-[#789A60]/10"
                >
            </div>
        </div>

        {{-- MIDDLE NAME --}}
        <div class="space-y-2">
            <label for="middlename"
                class="block text-sm font-semibold text-[#34465A]">
                Middle Name
            </label>

            <div class="relative">
                <x-lucide-user-round
                    class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />

                <input
                    type="text"
                    id="middlename"
                    wire:model="middlename"
                    placeholder="Search middle name"
                    autocomplete="off"
                    class="h-12 w-full rounded-xl border border-[#E2E8E0] bg-[#FAFBF9] pl-10 pr-4 text-sm text-[#172B3A] outline-none transition duration-200 placeholder:text-slate-400 hover:border-[#C9D5C3] focus:border-[#789A60] focus:bg-white focus:ring-4 focus:ring-[#789A60]/10"
                >
            </div>
        </div>

        {{-- LAST NAME --}}
        <div class="space-y-2">
            <label for="lastname"
                class="block text-sm font-semibold text-[#34465A]">
                Last Name
            </label>

            <div class="relative">
                <x-lucide-user-round
                    class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />

                <input
                    type="text"
                    id="lastname"
                    wire:model="lastname"
                    placeholder="Search last name"
                    autocomplete="off"
                    class="h-12 w-full rounded-xl border border-[#E2E8E0] bg-[#FAFBF9] pl-10 pr-4 text-sm text-[#172B3A] outline-none transition duration-200 placeholder:text-slate-400 hover:border-[#C9D5C3] focus:border-[#789A60] focus:bg-white focus:ring-4 focus:ring-[#789A60]/10"
                >
            </div>
        </div>

    </div>

    {{-- SEARCH ACTIONS --}}
    <div class="mt-6 flex flex-col-reverse gap-3 border-t border-[#EEF0EC] pt-5 sm:flex-row sm:items-center sm:justify-between">

        <p class="text-xs text-slate-400">
            <x-lucide-info class="mr-1 inline h-3.5 w-3.5" />
            Enter one or more fields to filter the member directory.
        </p>

        <div class="flex items-center justify-end gap-2">

            {{-- CLEAR --}}
            <button
                type="button"
                wire:click="clearSearch"
                wire:loading.attr="disabled"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-[#E2E8E0] bg-white px-5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50 disabled:opacity-50">

                <x-lucide-rotate-ccw class="h-4 w-4" />
                Clear
            </button>

            {{-- SEARCH --}}
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#789A60] px-6 text-sm font-bold text-white shadow-sm transition hover:bg-[#688A51] hover:shadow-md disabled:cursor-not-allowed disabled:opacity-60">

                <span wire:loading.remove wire:target="$refresh"
                    class="inline-flex items-center gap-2">
                    <x-lucide-search class="h-4 w-4" />
                    Search Members
                </span>

                <span wire:loading wire:target="$refresh"
                    class="inline-flex items-center gap-2">
                    <x-lucide-loader-circle class="h-4 w-4 animate-spin" />
                    Searching...
                </span>

            </button>

        </div>
    </div>

</form>

    </div>

    {{-- MEMBERS TABLE --}}
    <div class="overflow-hidden rounded-2xl border border-[#E8ECE7] bg-white shadow-sm">

        {{-- TABLE HEADER --}}
        <div class="flex flex-col gap-2 border-b border-[#E8ECE7] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="font-bold text-[#172B3A]">
                    Member Directory
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Registered member-consumer records
                </p>
            </div>

            <span class="text-sm font-medium text-slate-500">
                {{ $members->total() }} members found
            </span>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-[#F7F8F6] text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="whitespace-nowrap px-5 py-4 font-bold">#</th>
                        <th class="whitespace-nowrap px-5 py-4 font-bold">Member Name</th>
                        <th class="whitespace-nowrap px-5 py-4 font-bold">Membership Type</th>
                        <th class="whitespace-nowrap px-5 py-4 font-bold">Membership Status</th>
                        <th class="whitespace-nowrap px-5 py-4 text-right font-bold">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#EEF0EC]">

                    @forelse($members as $member)

                        <tr class="transition hover:bg-[#FAFBF9]">

                            <td class="whitespace-nowrap px-5 py-4 text-slate-500">
                                {{ $members->firstItem() + $loop->index }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                <p class="font-semibold text-[#172B3A]">
                                    {{ trim(($member->firstname ?? '') . ' ' . ($member->middlename ?? '') . ' ' . ($member->lastname ?? '')) }}
                                </p>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                @php
                                    $type = strtoupper($member->member_type ?? '');

                                    $badgeClass = match ($type) {
                                        'SINGLE' => 'bg-[#EDF3E9] text-[#587447]',
                                        'JOINT' => 'bg-[#E8F1FB] text-[#35679A]',
                                        'JURIDICAL' => 'bg-[#F1EAFB] text-[#7952A3]',
                                        default => 'bg-slate-100 text-slate-600',
                                    };
                                @endphp

                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ $badgeClass }}">
                                    {{ $type ?: '—' }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                {{ $member->membership_status ?? '—' }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <button
                                    type="button"
                                    class="inline-flex items-center gap-1 rounded-lg px-3 py-2 text-xs font-bold text-[#789A60] transition hover:bg-[#EDF3E9]">
                                    View Details
                                    <x-lucide-chevron-right class="h-3.5 w-3.5" />
                                </button>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">

                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#EDF3E9]">
                                    <x-lucide-users class="h-7 w-7 text-[#789A60]" />
                                </div>

                                <h3 class="mt-4 font-bold text-[#172B3A]">
                                    No members found
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    Try adjusting your search filters.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($members->hasPages())
            <div class="pagination-light border-t border-[#E8ECE7] bg-white px-5 py-4">
                {{ $members->links() }}
            </div>
        @endif

    </div>

</div>
