
<x-layout.app title="Members">

    <div class="space-y-6">

        {{-- PAGE HEADER --}}
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
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

            <div class="flex items-center gap-2">
                <span class="rounded-full bg-[#EDF3E9] px-3 py-1.5 text-xs font-semibold text-[#587447]">
                    Member Directory
                </span>
            </div>
        </div>

        {{-- SEARCH FILTERS --}}
        <div class="rounded-2xl border border-[#E8ECE7] bg-white p-5 shadow-sm">

            <div class="mb-4">
                <h2 class="text-base font-bold text-[#172B3A]">
                    Search Members
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Enter the member's name to find a record.
                </p>
            </div>

            <form method="GET" action="{{ route('members.members-data') }}">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                    {{-- FIRST NAME --}}
                    <div>
                        <label for="first_name"
                            class="mb-2 block text-sm font-semibold text-[#34465A]">
                            First Name
                        </label>

                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            value="{{ request('first_name') }}"
                            placeholder="Enter first name"
                            class="w-full rounded-xl border border-[#E2E8E0] bg-white px-4 py-3 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                        >
                    </div>

                    {{-- MIDDLE NAME --}}
                    <div>
                        <label for="middle_name"
                            class="mb-2 block text-sm font-semibold text-[#34465A]">
                            Middle Name
                        </label>

                        <input
                            type="text"
                            id="middle_name"
                            name="middle_name"
                            value="{{ request('middle_name') }}"
                            placeholder="Enter middle name"
                            class="w-full rounded-xl border border-[#E2E8E0] bg-white px-4 py-3 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                        >
                    </div>

                    {{-- LAST NAME --}}
                    <div>
                        <label for="last_name"
                            class="mb-2 block text-sm font-semibold text-[#34465A]">
                            Last Name
                        </label>

                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            value="{{ request('last_name') }}"
                            placeholder="Enter last name"
                            class="w-full rounded-xl border border-[#E2E8E0] bg-white px-4 py-3 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                        >
                    </div>

                    {{-- MEMBERSHIP STATUS --}}
                    <div>
                        <label for="membership_status"
                            class="mb-2 block text-sm font-semibold text-[#34465A]">
                            Membership Status
                        </label>

                        <select
                            id="membership_status"
                            name="membership_status"
                            class="w-full rounded-xl border border-[#E2E8E0] bg-white px-4 py-3 text-sm text-[#172B3A] outline-none transition focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                        >
                            <option value="">All Statuses</option>

                            <option value="Active"
                                {{ request('membership_status') === 'Active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="Inactive"
                                {{ request('membership_status') === 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                {{-- SEARCH BUTTONS --}}
                <div class="mt-5 flex flex-wrap justify-end gap-2">
                    <a href="{{ route('members.members-data') }}"
                        class="rounded-xl border border-[#E2E8E0] bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Clear
                    </a>

                    <button type="submit"
                        class="rounded-xl bg-[#789A60] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#688A51]">
                        Search Members
                    </button>
                </div>
            </form>
        </div>

        {{-- MEMBERS TABLE --}}
        <div class="overflow-hidden rounded-2xl border border-[#E8ECE7] bg-white shadow-sm">

            <div class="flex flex-col gap-2 border-b border-[#E8ECE7] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-bold text-[#172B3A]">
                        Member Directory
                    </h2>
                    <p class="mt-1 text-xs text-slate-500">
                        List of registered member-consumers
                    </p>
                </div>

                <span class="text-sm font-medium text-slate-500">
                    {{ isset($members) ? $members->total() : 0 }} members found
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#F7F8F6] text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-5 py-4 font-bold">#</th>
                            <th class="px-5 py-4 font-bold">Account Number</th>
                            <th class="px-5 py-4 font-bold">Member Name</th>
                            <th class="px-5 py-4 font-bold">Classification</th>
                            <th class="px-5 py-4 font-bold">Contact Number</th>
                            <th class="px-5 py-4 text-right font-bold">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#EEF0EC]">

                        @forelse($members ?? [] as $member)
                            <tr class="transition hover:bg-[#FAFBF9]">

                                <td class="whitespace-nowrap px-5 py-4 text-slate-500">
                                    {{ $members->firstItem() + $loop->index }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-[#172B3A]">
                                    {{ $member->account_number ?? '—' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4">
                                    <p class="font-semibold text-[#172B3A]">
                                        {{ trim(($member->first_name ?? '') . ' ' . ($member->middle_name ?? '') . ' ' . ($member->last_name ?? '')) }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4">
                                    <span class="rounded-full bg-[#EDF3E9] px-3 py-1 text-xs font-semibold text-[#587447]">
                                        {{ $member->classification ?? '—' }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                    {{ $member->mobile ?? '—' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-right">
                                    <button type="button"
                                        class="rounded-lg px-3 py-2 text-xs font-bold text-[#789A60] transition hover:bg-[#EDF3E9]">
                                        View Details
                                    </button>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-[#EDF3E9]">
                                        <x-lucide-users class="h-6 w-6 text-[#789A60]" />
                                    </div>

                                    <h3 class="mt-4 font-bold text-[#172B3A]">
                                        No members found
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        There are currently no member records to display.
                                    </p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if(isset($members) && $members->hasPages())
                <div class="border-t border-[#E8ECE7] px-5 py-4">
                    {{ $members->links() }}
                </div>
            @endif

        </div>

    </div>

</x-layout.app>
