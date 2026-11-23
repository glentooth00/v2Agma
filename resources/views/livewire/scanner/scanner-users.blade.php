<div class="min-h-screen bg-[#F7F8F6] px-4 py-6 sm:px-6 lg:px-8">

    {{-- PAGE HEADER --}}
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>

            <h1 class="text-2xl font-bold tracking-tight text-[#172B3A]">
                Scanner Users
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage authorized staff accounts and their assigned scanning stations.
            </p>
        </div>

        {{-- <x-ui.button
            type="button"
            wire:click="openScannerUserModal"
            class="inline-flex items-center justify-center gap-2 bg-[#172B3A] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#243F52]">
            <x-lucide-user-plus class="size-4" />
            Add Scanner User
        </x-ui.button> --}}

        <button
    type="button"
    wire:click="openScannerUserModal"
    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#172B3A] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#243F52]"
>
    <x-lucide-user-plus class="size-4" />
    Add Scanner User
</button>

    </div>


{{-- SUMMARY CARDS --}}
<div class="mb-7 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

    {{-- ALL ACCOUNTS --}}
    <div class="rounded-2xl border border-[#E6EBE3] bg-white p-5">
        <div class="flex items-center justify-between">
            <div class="flex size-10 items-center justify-center rounded-xl bg-[#F0F5EC] text-[#789A60]">
                <x-lucide-users class="size-5" />
            </div>
            <span class="text-xs font-medium text-slate-400">ALL ACCOUNTS</span>
        </div>
        <p class="mt-5 text-3xl font-bold tracking-tight text-[#172B3A]">
            {{ number_format($totalUsers) }}
        </p>
        <p class="mt-1 text-sm text-slate-500">Total scanner users</p>
    </div>

    {{-- ACTIVE ACCOUNTS --}}
    <div class="rounded-2xl border border-[#E3EBE5] bg-white p-5">
        <div class="flex items-center justify-between">
            <div class="flex size-10 items-center justify-center rounded-xl bg-[#EFF6F1] text-[#64977B]">
                <x-lucide-user-check class="size-5" />
            </div>
            <span class="text-xs font-medium text-slate-400">AVAILABLE</span>
        </div>
        <p class="mt-5 text-3xl font-bold tracking-tight text-[#172B3A]">
            {{ number_format($activeUsers) }}
        </p>
        <p class="mt-1 text-sm text-slate-500">Active accounts</p>
    </div>

    {{-- DISABLED ACCOUNTS --}}
    <div class="rounded-2xl border border-[#ECE8E0] bg-white p-5">
        <div class="flex items-center justify-between">
            <div class="flex size-10 items-center justify-center rounded-xl bg-[#F7F3EC] text-[#A58D6B]">
                <x-lucide-user-round-x class="size-5" />
            </div>
            <span class="text-xs font-medium text-slate-400">DISABLED</span>
        </div>
        <p class="mt-5 text-3xl font-bold tracking-tight text-[#172B3A]">
            {{ number_format($disabledUsers) }}
        </p>
        <p class="mt-1 text-sm text-slate-500">Disabled accounts</p>
    </div>

    {{-- STATIONS --}}
    <div class="rounded-2xl border border-[#E5EAF0] bg-white p-5">
        <div class="flex items-center justify-between">
            <div class="flex size-10 items-center justify-center rounded-xl bg-[#EEF3F8] text-[#6686A8]">
                <x-lucide-scan-line class="size-5" />
            </div>
            <span class="text-xs font-medium text-slate-400">STATIONS</span>
        </div>
        <p class="mt-5 text-3xl font-bold tracking-tight text-[#172B3A]">
            {{ number_format($totalStations) }}
        </p>
        <p class="mt-1 text-sm text-slate-500">Assigned scanning stations</p>
    </div>

</div>


    {{-- MAIN CONTENT --}}
    <div class="overflow-hidden rounded-2xl border border-[#E6EBE3] bg-white">

        {{-- TABLE HEADER --}}
        <div class="flex flex-col justify-between gap-4 border-b border-[#EEF0EC] p-5 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-base font-bold text-[#172B3A]">
                    Authorized Accounts
                </h2>
                <p class="mt-1 text-xs text-slate-500">
                    Staff accounts permitted to access the AGMA ONE Scanner app.
                </p>
            </div>

            <div class="flex flex-col gap-2 sm:flex-row">
                <div class="relative">
                    <x-lucide-search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                    <input
                        type="search"
                        placeholder="Search scanner users..."
                        class="w-full rounded-xl border border-[#E5EAE3] bg-[#FAFBF9] py-2.5 pl-9 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/10 sm:w-64"
                    />
                </div>

                <select
                    class="rounded-xl border border-[#E5EAE3] bg-[#FAFBF9] px-3 py-2.5 text-sm text-slate-600 outline-none focus:border-[#789A60]"
                >
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] text-left">
                <thead>
                    <tr class="border-b border-[#EEF0EC] bg-[#FAFBF9]">
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Staff Member</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Username</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Assigned Station</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Last Activity</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-slate-400">Status</th>
                        <th class="px-6 py-4 text-right text-[10px] font-bold uppercase tracking-wider text-slate-400">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#F0F2EE]">

                    @forelse ($scannerUsers as $user)

                        @php
                            $fullName = trim(
                                $user->firstname . ' ' .
                                ($user->middlename ? $user->middlename . ' ' : '') .
                                $user->lastname
                            );

                            $initials = strtoupper(
                                substr($user->firstname, 0, 1) .
                                substr($user->lastname, 0, 1)
                            );
                        @endphp

                        <tr wire:key="scanner-user-{{ $user->id }}"
                            class="transition hover:bg-[#FAFBF9]">

                            {{-- STAFF MEMBER --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-[#EDF2E9] text-xs font-bold text-[#607D4E]">
                                        {{ $initials }}
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-[#172B3A]">
                                            {{ $fullName }}
                                        </p>
                                        <p class="mt-0.5 text-xs text-slate-400">
                                            Scanner Staff
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- USERNAME --}}
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $user->username }}
                            </td>

                            {{-- ASSIGNED STATION --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-2 rounded-lg border border-[#E6EBE3] bg-[#F8FAF6] px-2.5 py-1.5 text-xs font-semibold text-[#526B45]">
                                    <x-lucide-scan-line class="size-3.5" />
                                    {{ $user->assigned_station }}
                                </span>
                            </td>

                            {{-- LAST ACTIVITY --}}
                            <td class="px-6 py-4 text-sm text-slate-500">
                                <span class="text-slate-400">—</span>
                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-4">
                                @if ($user->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#EDF6EF] px-2.5 py-1 text-xs font-semibold text-[#4D805C]">
                                        <span class="size-1.5 rounded-full bg-[#65A477]"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                        <span class="size-1.5 rounded-full bg-slate-400"></span>
                                        Disabled
                                    </span>
                                @endif
                            </td>


{{-- ACTIONS --}}
<td class="px-6 py-4">
    <div class="flex items-center justify-end gap-1">

        <x-ui.dialog>
            <x-ui.dialog-trigger>
                <button
                    type="button"
                    title="Manage scanner user"
                    wire:click="editScannerUser({{ $user->id }})"
                    class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                    <x-lucide-ellipsis class="size-4" />
                </button>
            </x-ui.dialog-trigger>

            <x-ui.dialog-content class="sm:max-w-[500px]">

                <x-ui.dialog-header>
                    <x-ui.dialog-title>
                        Manage Scanner User
                    </x-ui.dialog-title>

                    <x-ui.dialog-description>
                        Update staff information, login credentials, station assignment, and account access.
                    </x-ui.dialog-description>
                </x-ui.dialog-header>

                <form wire:submit="updateScannerUser" class="space-y-5">

                    {{-- PERSONAL INFORMATION --}}
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <x-lucide-user-round class="size-4 text-[#789A60]" />
                            <h3 class="text-xs font-bold uppercase tracking-wider text-[#172B3A]">
                                Personal Information
                            </h3>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">

                            <div class="grid gap-2">
                                <x-ui.label for="editFirstname">
                                    First Name
                                </x-ui.label>

                                <x-ui.input
                                    id="editFirstname"
                                    wire:model="editFirstname"
                                    placeholder="First name"
                                />

                                @error('editFirstname')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid gap-2">
                                <x-ui.label for="editMiddlename">
                                    Middle Name
                                </x-ui.label>

                                <x-ui.input
                                    id="editMiddlename"
                                    wire:model="editMiddlename"
                                    placeholder="Middle name (optional)"
                                />

                                @error('editMiddlename')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid gap-2 sm:col-span-2">
                                <x-ui.label for="editLastname">
                                    Last Name
                                </x-ui.label>

                                <x-ui.input
                                    id="editLastname"
                                    wire:model="editLastname"
                                    placeholder="Last name"
                                />

                                @error('editLastname')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="border-t border-[#EEF0EC]"></div>

                    {{-- LOGIN CREDENTIALS --}}
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <x-lucide-shield-check class="size-4 text-[#789A60]" />
                            <h3 class="text-xs font-bold uppercase tracking-wider text-[#172B3A]">
                                Login Credentials
                            </h3>
                        </div>

                        <div class="grid gap-2">
                            <x-ui.label for="editUsername">
                                Username
                            </x-ui.label>

                            <x-ui.input
                                id="editUsername"
                                wire:model="editUsername"
                                placeholder="Enter username"
                            />

                            @error('editUsername')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid gap-2">
                            <x-ui.label for="newPassword">
                                New Password
                            </x-ui.label>

                            <x-ui.input
                                id="newPassword"
                                type="password"
                                wire:model="newPassword"
                                placeholder="Enter new password"
                            />

                            @error('newPassword')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror

                            <p class="text-xs text-slate-400">
                                Leave blank to retain the current password. Minimum 8 characters.
                            </p>
                        </div>
                    </div>

                    <div class="border-t border-[#EEF0EC]"></div>

                    {{-- STATION AND STATUS --}}
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <x-lucide-settings class="size-4 text-[#789A60]" />
                            <h3 class="text-xs font-bold uppercase tracking-wider text-[#172B3A]">
                                Scanner Assignment
                            </h3>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">

                            <div class="grid gap-2">
                                <x-ui.label for="editAssignedStation">
                                    Assigned Station
                                </x-ui.label>

                                <x-ui.input
                                    id="editAssignedStation"
                                    wire:model="editAssignedStation"
                                    placeholder="e.g. STATION-01"
                                />

                                @error('editAssignedStation')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid gap-2">
                                <x-ui.label for="editStatus">
                                    Account Status
                                </x-ui.label>

                                <select
                                    id="editStatus"
                                    wire:model="editStatus"
                                    class="h-10 w-full rounded-xl border border-[#E2E8E0] bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/10">

                                    <option value="active">Active</option>
                                    <option value="disabled">Disabled</option>
                                </select>

                                @error('editStatus')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="rounded-xl border border-[#E6EBE3] bg-[#F8FAF6] p-3">
                            <div class="flex items-start gap-2">
                                <x-lucide-info class="mt-0.5 size-4 shrink-0 text-[#789A60]" />

                                <p class="text-xs leading-relaxed text-slate-500">
                                    Disabled accounts will not be allowed to authenticate in the scanner application.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <x-ui.dialog-footer>
                        <x-ui.button type="submit">
                            <span wire:loading.remove wire:target="updateScannerUser">
                                Save Changes
                            </span>

                            <span wire:loading wire:target="updateScannerUser">
                                Saving...
                            </span>
                        </x-ui.button>
                    </x-ui.dialog-footer>

                </form>

                        </x-ui.dialog-content>
                    </x-ui.dialog>

                </div>
            </td>


            </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="px-6 py-14 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="mb-3 flex size-12 items-center justify-center rounded-full bg-[#F0F3ED] text-[#8A9B7B]">
                                        <x-lucide-users class="size-5" />
                                    </div>

                                    <p class="text-sm font-semibold text-[#172B3A]">
                                        No scanner users found
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Add a scanner user to get started.
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- TABLE FOOTER --}}
        <div class="flex flex-col justify-between gap-3 border-t border-[#EEF0EC] px-5 py-4 sm:flex-row sm:items-center">
            <p class="text-xs text-slate-400">
                Showing <span class="font-semibold text-slate-600">4</span> of
                <span class="font-semibold text-slate-600">14</span> scanner users
            </p>

            <div class="flex items-center gap-2">
                <button type="button" disabled
                    class="rounded-lg border border-[#E5EAE3] px-3 py-2 text-xs font-medium text-slate-300">
                    Previous
                </button>
                <span class="rounded-lg bg-[#172B3A] px-3 py-2 text-xs font-semibold text-white">1</span>
                <button type="button"
                    class="rounded-lg border border-[#E5EAE3] px-3 py-2 text-xs font-medium text-slate-500 hover:bg-[#F7F8F6]">
                    Next
                </button>
            </div>
        </div>

    <x-ui.sonner />

</div>

    {{-- SECURITY NOTE --}}
    <div class="mt-5 flex items-start gap-3 rounded-xl border border-[#E5EAF0] bg-[#F5F8FB] p-4">
        <x-lucide-shield-check class="mt-0.5 size-5 shrink-0 text-[#6686A8]" />
        <div>
            <p class="text-sm font-semibold text-[#344B60]">Scanner access is restricted</p>
            <p class="mt-1 text-xs leading-relaxed text-slate-500">
                Only administrator-authorized accounts can sign in to the AGMA ONE Scanner app.
                Deactivating an account should also revoke its active API tokens.
            </p>
        </div>
    </div>


    {{-- ADD SCANNER USER MODAL --}}
    @if ($showScannerUserModal)
        <div
            class="fixed inset-0 z-[9999] flex items-center justify-center overflow-y-auto bg-[#172B3A]/40 px-4 py-6 backdrop-blur-sm"
            wire:key="scanner-user-modal"
            x-data
            x-on:keydown.escape.window="$wire.closeScannerUserModal()"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div
                class="my-auto w-full max-w-2xl overflow-hidden rounded-2xl border border-[#E6EBE3] bg-white shadow-2xl"
                wire:click.stop
            >
                {{-- MODAL HEADER --}}
                <div class="flex items-center justify-between border-b border-[#E6EBE3] px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="flex size-11 items-center justify-center rounded-xl bg-[#EEF3E9] text-[#789A60]">
                            <x-lucide-user-plus class="size-5" />
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-[#172B3A]">
                                Add Scanner User
                            </h2>
                            <p class="mt-0.5 text-sm text-slate-500">
                                Create an authorized scanner account.
                            </p>
                        </div>
                    </div>

                    <button
                        type="button"
                        wire:click="closeScannerUserModal"
                        class="flex size-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
                        aria-label="Close modal"
                    >
                        <x-lucide-x class="size-5" />
                    </button>
                </div>

                {{-- MODAL FORM --}}
                <form wire:submit="saveScannerUser">
                    <div class="max-h-[70vh] space-y-6 overflow-y-auto px-6 py-6">

                        {{-- PERSONAL INFORMATION --}}
                        <div>
                            <div class="mb-4">
                                <h3 class="text-sm font-semibold text-[#172B3A]">
                                    Personal Information
                                </h3>
                                <p class="mt-1 text-xs text-slate-500">
                                    Enter the scanner user's complete name.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                <div>
                                    <label class="mb-1.5 block text-xs font-semibold text-slate-600">
                                        First Name <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="firstname"
                                        placeholder="First name"
                                        class="w-full rounded-xl border border-[#DCE3D8] bg-white px-3.5 py-3 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                                    >

                                    @error('firstname')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="mb-1.5 block text-xs font-semibold text-slate-600">
                                        Middle Name
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="middlename"
                                        placeholder="Middle name"
                                        class="w-full rounded-xl border border-[#DCE3D8] bg-white px-3.5 py-3 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                                    >

                                    @error('middlename')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="mb-1.5 block text-xs font-semibold text-slate-600">
                                        Last Name <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="lastname"
                                        placeholder="Last name"
                                        class="w-full rounded-xl border border-[#DCE3D8] bg-white px-3.5 py-3 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                                    >

                                    @error('lastname')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ACCOUNT CONFIGURATION --}}
                        <div class="border-t border-[#EDF0EA] pt-5">
                            <div class="mb-4">
                                <h3 class="text-sm font-semibold text-[#172B3A]">
                                    Account Configuration
                                </h3>
                                <p class="mt-1 text-xs text-slate-500">
                                    Configure the user's access and assigned station.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="mb-1.5 block text-xs font-semibold text-slate-600">
                                        Account Status <span class="text-red-500">*</span>
                                    </label>

                                    <select
                                        wire:model="status"
                                        class="w-full rounded-xl border border-[#DCE3D8] bg-white px-3.5 py-3 text-sm text-[#172B3A] outline-none transition focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                                    >
                                        <option value="active">Active</option>
                                        <option value="disabled">Disabled</option>
                                    </select>

                                    @error('status')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="mb-1.5 block text-xs font-semibold text-slate-600">
                                        Assigned Station <span class="text-red-500">*</span>
                                    </label>

                                    <select
                                        wire:model="assignedStation"
                                        class="w-full rounded-xl border border-[#DCE3D8] bg-white px-3.5 py-3 text-sm text-[#172B3A] outline-none transition focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                                    >
                                        <option value="">Select station</option>
                                        @foreach (range(1, 7) as $station)
                                            <option value="STATION-{{ str_pad($station, 2, '0', STR_PAD_LEFT) }}">
                                                STATION-{{ str_pad($station, 2, '0', STR_PAD_LEFT) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('assignedStation')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- LOGIN CREDENTIALS --}}
                        <div class="border-t border-[#EDF0EA] pt-5">
                            <div class="mb-4">
                                <h3 class="text-sm font-semibold text-[#172B3A]">
                                    Login Credentials
                                </h3>
                                <p class="mt-1 text-xs text-slate-500">
                                    These credentials will be used in the AGMA ONE Scanner app.
                                </p>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="mb-1.5 block text-xs font-semibold text-slate-600">
                                        Username <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="username"
                                        placeholder="Enter username"
                                        autocomplete="off"
                                        class="w-full rounded-xl border border-[#DCE3D8] bg-white px-3.5 py-3 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                                    >

                                    @error('username')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="mb-1.5 block text-xs font-semibold text-slate-600">
                                        Password <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        type="password"
                                        wire:model="password"
                                        placeholder="Minimum 8 characters"
                                        autocomplete="new-password"
                                        class="w-full rounded-xl border border-[#DCE3D8] bg-white px-3.5 py-3 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/15"
                                    >

                                    @error('password')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- SECURITY INFORMATION --}}
                        <div class="flex items-start gap-3 rounded-xl border border-[#E5EAF0] bg-[#F5F8FB] p-4">
                            <x-lucide-shield-check class="mt-0.5 size-5 shrink-0 text-[#6686A8]" />

                            <div>
                                <p class="text-xs font-semibold text-[#344B60]">
                                    Authorized scanner access
                                </p>
                                <p class="mt-1 text-xs leading-relaxed text-slate-500">
                                    Scanner accounts are intended for authorized event personnel only.
                                    Keep login credentials secure and do not share them with unauthorized users.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- MODAL FOOTER --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-[#E6EBE3] bg-[#FAFBF9] px-6 py-4 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            wire:click="closeScannerUserModal"
                            class="inline-flex items-center justify-center rounded-xl border border-[#DCE3D8] bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="saveScannerUser"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#172B3A] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#243F52] disabled:cursor-not-allowed disabled:opacity-60"
                        >
                            <span wire:loading.remove wire:target="saveScannerUser">
                                <x-lucide-user-plus class="size-4" />
                            </span>

                            <span wire:loading wire:target="saveScannerUser">
                                <x-lucide-loader-circle class="size-4 animate-spin" />
                            </span>

                            <span wire:loading.remove wire:target="saveScannerUser">
                                Create Scanner User
                            </span>

                            <span wire:loading wire:target="saveScannerUser">
                                Creating...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif


    @script
    <script>
        $wire.on('scanner-user-created', () => {
            window.toast.success('Scanner user created successfully');
        });

        $wire.on('scanner-user-updated', () => {
            window.toast.success('Scanner user updated successfully');
        });
    </script>
    @endscript

</div>



<!-------------------- Modal  ---------------->

