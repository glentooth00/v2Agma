
<div
    x-data="{
    classification: @entangle('classification'),
    dateOfBirth: @entangle('dateOfBirth'),
    step: 1,
    consentAccepted: @entangle('consentAccepted')
    }"
    x-on:member-selected.window="step = 3"
    x-on:registration-reset.window="step = 1"
    class="min-h-screen bg-[#F7F8F6]"
>
    {{-- HEADER --}}
    <header class="border-b border-[#E5EAE5] bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-5">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#172B3A] text-[#A9C98E]">
                    <svg viewBox="0 0 40 40" fill="none" class="h-7 w-7">
                        <path d="M20 4L35 12.5V27.5L20 36L5 27.5V12.5L20 4Z"
                              stroke="currentColor" stroke-width="2.5"/>
                        <path d="M13 24L20 11L27 24M15.5 20H24.5"
                              stroke="currentColor" stroke-width="2.5"
                              stroke-linecap="round"/>
                    </svg>
                </div>

                <div>
                    <h1 class="text-lg font-extrabold tracking-widest text-[#172B3A]">
                        AGMA <span class="text-[#789A60]">ONE</span>
                    </h1>
                    <p class="text-[10px] tracking-[0.16em] text-slate-500">
                        MEMBER REGISTRATION PORTAL
                    </p>
                </div>
            </div>

            <div class="hidden items-center gap-2 text-xs font-medium text-slate-500 sm:flex">
                <span class="h-2 w-2 rounded-full bg-[#8BAF72]"></span>
                Official AGMA Registration
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-5 py-12 sm:px-8 sm:py-16">


        @if ($registrationSaved)

            {{-- SUCCESSFUL REGISTRATION / MEMBER CARD --}}
            <div class="flex flex-col items-center gap-5 py-8">

                <div
                        id="agma-member-card"
                        class="w-full max-w-sm rounded-2xl bg-[#172B3A] p-6 text-white shadow-xl"
                    >

                    {{-- CARD HEADER --}}
                    <div class="border-b border-[#526675] pb-4 text-center">
                        <h2 class="text-xl font-extrabold tracking-widest">
                            AGMA <span class="text-[#A8C58D]">ONE</span>
                        </h2>

                        <p class="mt-1 text-[9px] tracking-[0.16em] text-[#A8C58D]">
                            OFFICIAL ASSEMBLY ACCESS · MEMBER PASS
                        </p>
                    </div>

                    {{-- QR CODE --}}
                    <div class="my-5 flex justify-center">
                        <div class="rounded-xl bg-white p-3 [&_svg]:block [&_svg]:h-40 [&_svg]:w-40">
                            {!! $qrCode !!}
                        </div>
                    </div>

                    <p class="mb-4 text-center text-[9px] tracking-widest text-[#A8C58D]">
                        SCAN TO VERIFY MEMBERSHIP
                    </p>

                    {{-- MEMBER DETAILS --}}
                    <div class="text-center">
                        <p class="text-lg font-bold">
                            {{ $selectedMember->firstname ?? '' }}
                            {{ $selectedMember->middlename ?? '' }}
                            {{ $selectedMember->lastname ?? '' }}
                        </p>

                        {{-- <p class="mt-1 text-sm font-semibold text-[#A8C58D]">
                            {{ $selectedMember->membership_id ?? $selectedMemberId }}
                        </p> --}}

                        <p class="mt-1 text-xs text-slate-300">
                            REGISTERED ACCOUNT NUMBER
                        </p>

                        <p class="mt-1 text-sm font-bold">
                            {{ $selectedAccountNumber }}
                        </p>
                    </div>

                    {{-- CARD FOOTER --}}
                    <div class="mt-6 border-t border-[#526675] pt-4 text-center">
                        <p class="text-[9px] font-semibold tracking-widest text-[#A8C58D]">
                            PRESENT THIS PASS AT THE ASSEMBLY
                        </p>

                        <p class="mt-2 text-[9px] text-slate-400">
                            Every member. Every voice. One assembly.
                        </p>
                    </div>

                </div>

                {{-- DOWNLOAD BUTTON --}}
                <button
                    type="button"
                    onclick="downloadAgmaCard()"
                    class="inline-flex w-full max-w-sm items-center justify-center gap-2 rounded-xl border border-[#789A60] bg-[#F3F7F0] px-5 py-3 text-sm font-semibold text-[#587447] transition hover:bg-[#EAF1E5]"
                >
                    <x-lucide-download class="size-4" />
                    Download Member ID
                </button>

                {{-- REGISTER ANOTHER ACCOUNT --}}
                <button
                    type="button"
                    wire:click="registerAnotherAccount"
                    class="text-sm font-semibold text-[#789A60] hover:underline"
                >
                    Register Another Account
                </button>

            </div>

        @else

        {{-- INTRO --}}
        <div class="mb-10 text-center">
            <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#EAF0E6] text-[#789A60]">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.6">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>

            <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-[#789A60]">
                Annual General Meeting
            </p>

            <h2 class="text-3xl font-bold tracking-tight text-[#172B3A] sm:text-4xl">
                Member Registration
            </h2>

            <p class="mx-auto mt-4 max-w-xl text-sm leading-7 text-slate-500">
                Welcome, member-consumer! Register your participation
                in the Annual General Meeting Assembly.
            </p>
        </div>


        {{-- PROGRESS --}}
        <div class="mb-6 flex w-full items-center justify-center gap-2 sm:gap-3">

            {{-- STEP 1 --}}
            <div class="flex min-w-0 items-center gap-2">
                <span
                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-[11px] font-bold sm:h-8 sm:w-8 sm:text-xs"
                    :class="step === 1
                        ? 'bg-[#172B3A] text-white'
                        : 'bg-[#789A60] text-white'"
                >
                    <span x-show="step === 1">1</span>
                    <svg x-show="step > 1" x-cloak class="h-4 w-4"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.7 5.3a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.4 0l-3-3a1 1 0 1 1 1.4-1.4L9 11.6l6.3-6.3a1 1 0 0 1 1.4 0Z"
                            clip-rule="evenodd"/>
                    </svg>
                </span>

                <span class="text-[10px] font-semibold text-[#172B3A] sm:text-xs whitespace-nowrap">
                    Account Type
                </span>
            </div>

            {{-- CONNECTOR --}}
            <div class="h-px w-4 shrink-0 bg-slate-300 sm:w-8"></div>

            {{-- STEP 2 --}}
            <div class="flex min-w-0 items-center gap-2">
                <span
                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-[11px] font-bold sm:h-8 sm:w-8 sm:text-xs"
                    :class="step === 2
                        ? 'bg-[#172B3A] text-white'
                        : step > 2
                            ? 'bg-[#789A60] text-white'
                            : 'bg-slate-200 text-slate-500'"
                >
                    <span x-show="step <= 2">2</span>
                    <svg x-show="step > 2" x-cloak class="h-4 w-4"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.7 5.3a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.4 0l-3-3a1 1 0 1 1 1.4-1.4L9 11.6l6.3-6.3a1 1 0 0 1 1.4 0Z"
                            clip-rule="evenodd"/>
                    </svg>
                </span>

                <span
                    class="text-[10px] font-semibold whitespace-nowrap sm:text-xs"
                    :class="step >= 2 ? 'text-[#172B3A]' : 'text-slate-500'"
                >
                    Find Account
                </span>
            </div>

            {{-- CONNECTOR --}}
            <div class="h-px w-4 shrink-0 bg-slate-300 sm:w-8"></div>

            {{-- STEP 3 --}}
            <div class="flex min-w-0 items-center gap-2">
                <span
                    class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-[11px] font-bold sm:h-8 sm:w-8 sm:text-xs"
                    :class="step === 3
                        ? 'bg-[#172B3A] text-white'
                        : 'bg-slate-200 text-slate-500'"
                >
                    3
                </span>

                <span
                    class="text-[10px] font-semibold whitespace-nowrap sm:text-xs"
                    :class="step === 3 ? 'text-[#172B3A]' : 'text-slate-500'"
                >
                    Registration
                </span>
            </div>

        </div>


        {{-- REGISTRATION CARD --}}
        <div class="overflow-hidden rounded-2xl border border-[#E3E9E4] bg-white shadow-sm">

            {{-- CARD HEADER --}}
            <div class="border-b border-[#E9EDE9] px-6 py-5 sm:px-8">
                <h3 class="font-semibold text-[#172B3A]"
                    x-text="
                        step === 1
                            ? 'Select Account Classification'
                            : step === 2
                                ? 'Find Your Member Account'
                                : 'Registration Information'
                    ">
                </h3>

                <p class="mt-1 text-xs text-slate-500"
                   x-text="
                        step === 1
                            ? 'Choose the classification that matches your electric service account.'
                            : step === 2
                                ? 'Search and select your existing cooperative member record.'
                                : 'Complete the required information below.'
                   ">
                </p>
            </div>

            {{-- ===================================== --}}
            {{-- STEP 1: ACCOUNT CLASSIFICATION       --}}
            {{-- ===================================== --}}
            <div x-show="step === 1" x-transition
                 class="space-y-6 px-6 py-8 sm:px-8">

                <div class="text-center">
                    <h4 class="text-lg font-bold text-[#172B3A]">
                        What type of account do you have?
                    </h4>
                    <p class="mt-2 text-sm text-slate-500">
                        Please select one option to continue.
                    </p>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">

                    {{-- RESIDENTIAL --}}
                    <label class="relative cursor-pointer">
                        <input
                            type="radio"
                            name="account_classification"
                            value="residential"
                            x-model="classification"
                            class="peer sr-only"
                        >

                        <div class="h-full rounded-2xl border-2 border-[#E3E9E4] p-6 transition
                            peer-checked:border-[#789A60]
                            peer-checked:bg-[#F5F8F2]
                            hover:border-[#AABBA2]">

                            <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-xl bg-[#EAF0E6] text-[#789A60]">
                                <svg class="h-7 w-7" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor"
                                     stroke-width="1.7">
                                    <path d="m3 10 9-7 9 7"/>
                                    <path d="M5 9v12h14V9M9 21v-7h6v7"/>
                                </svg>
                            </div>

                            <h5 class="text-lg font-bold text-[#172B3A]">
                                Residential
                            </h5>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                For individual household member-consumers
                                with residential electric service accounts.
                            </p>

                            <p class="mt-4 text-xs font-semibold text-[#789A60]">
                                Individual / Household Account
                            </p>
                        </div>
                    </label>

                    {{-- JURIDICAL --}}
                    <label class="relative cursor-pointer">
                        <input
                            type="radio"
                            name="account_classification"
                            value="juridical_public_building"
                            x-model="classification"
                            class="peer sr-only"
                        >

                        <div class="h-full rounded-2xl border-2 border-[#E3E9E4] p-6 transition
                            peer-checked:border-[#365D7A]
                            peer-checked:bg-[#F3F7FA]
                            hover:border-[#AABBA2]">

                            <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-xl bg-[#E9EFF5] text-[#365D7A]">
                                <svg class="h-7 w-7" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor"
                                     stroke-width="1.7">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <path d="M9 21V9h6v12M7 7h.01M17 7h.01M7 11h.01M17 11h.01M7 15h.01M17 15h.01"/>
                                </svg>
                            </div>

                            <h5 class="text-lg font-bold text-[#172B3A]">
                                Juridical / Public Building
                            </h5>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                For organizations, companies, institutions,
                                government offices, and public buildings.
                            </p>

                            <p class="mt-4 text-xs font-semibold text-[#365D7A]">
                                Organization / Establishment Account
                            </p>
                        </div>
                    </label>
                </div>

                <p x-show="!classification" x-cloak
                   class="text-center text-xs text-slate-400">
                    Select an account type to enable the Continue button.
                </p>

                <button
                    type="button"
                    @click="if (classification) step = 2"
                    :disabled="!classification"
                    class="flex h-12 w-full items-center justify-center gap-3 rounded-xl bg-[#172B3A] px-6 text-sm font-semibold text-white transition hover:bg-[#243E50] disabled:cursor-not-allowed disabled:opacity-40"
                >
                    Continue
                    <svg class="h-4 w-4" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14m-6-6 6 6-6 6"/>
                    </svg>
                </button>
            </div>

            {{-- ===================================== --}}
            {{-- STEP 2: FIND MEMBER ACCOUNT           --}}
            {{-- ===================================== --}}
            <div x-show="step === 2" x-cloak x-transition
                 class="space-y-6 px-6 py-8 sm:px-8">

                {{-- SELECTED ACCOUNT TYPE --}}
                <div class="flex items-center justify-between rounded-xl border border-[#E3E9E4] bg-[#F8FAF8] p-4">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Selected Account Type
                        </p>
                        <p class="mt-1 text-sm font-bold text-[#172B3A]"
                           x-text="classification === 'residential'
                                ? 'Residential'
                                : 'Juridical / Public Building'">
                        </p>
                    </div>

                    <button type="button"
                            @click="step = 1"
                            class="text-xs font-semibold text-[#789A60] hover:underline">
                        Change
                    </button>
                </div>

                {{-- SEARCH INSTRUCTIONS --}}
                <div>
                    <h4 class="text-base font-bold text-[#172B3A]">
                        Search for your member record
                    </h4>
                    <p class="mt-1 text-sm leading-6 text-slate-500">
                        Enter your name as registered with the cooperative.
                        Select your record from the search results.
                    </p>
                </div>

                {{-- RESIDENTIAL SEARCH --}}
                <div x-show="classification === 'residential'" class="space-y-5">


                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    {{-- First Name --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            First Name
                        </label>
                        <input
                            type="text"
                            wire:model="firstname"
                            placeholder="Enter first name"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#789A60] focus:ring-[#789A60]"
                        >
                    </div>

                    {{-- Middle Name --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Middle Name
                        </label>
                        <input
                            type="text"
                            wire:model="middlename"
                            placeholder="Enter middle name"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#789A60] focus:ring-[#789A60]"
                        >
                    </div>

                    {{-- Last Name --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Last Name
                        </label>
                        <input
                            type="text"
                            wire:model="lastname"
                            placeholder="Enter last name"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-[#789A60] focus:ring-[#789A60]"
                        >
                    </div>
                </div>

                {{-- Search Button --}}
<div class="mt-4 flex justify-end">
    <button
        type="button"
        wire:click="searchMember"
        wire:loading.attr="disabled"
        wire:target="searchMember"
        class="inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-[#789A60] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#66864F] disabled:opacity-60 sm:w-auto"
    >
        <span wire:loading.remove wire:target="searchMember">
            <x-lucide-search class="h-4 w-4" />
        </span>

        <span wire:loading wire:target="searchMember">
            <x-lucide-loader-circle class="h-4 w-4 animate-spin" />
        </span>

        <span wire:loading.remove wire:target="searchMember">Search Member</span>
        <span wire:loading wire:target="searchMember">Searching...</span>
    </button>
</div>


                    {{-- CLEAR SEARCH --}}
                    <div class="flex justify-end">
                        <button
                            type="button"
                            wire:click="$set('firstname', '')"
                            class="text-xs font-semibold text-slate-500 hover:text-[#789A60]"
                        >
                            Clear first name
                        </button>
                        <button
                            type="button"
                            wire:click="clearSearch"
                            class="ml-4 text-xs font-semibold text-[#789A60] hover:underline"
                        >
                            Clear all fields
                        </button>
                    </div>
                </div>

                {{-- JURIDICAL SEARCH --}}
                <div x-show="classification === 'juridical_public_building'"
                     x-cloak>
                    <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                        Organization / Establishment Name
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                             viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.8">
                            <circle cx="11" cy="11" r="7"/>
                            <path d="m20 20-4-4"/>
                        </svg>
                        <input
                            type="text"
                            wire:model="firstname"
                            placeholder="Enter organization name"
                            autocomplete="off"
                            class="h-12 w-full rounded-xl border border-[#DCE2DF] bg-white pl-10 pr-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                        >
                    </div>
                </div>


                @php
                    $hasSearch = trim($firstname ?? '') !== ''
                        || (
                            $classification === 'residential'
                            && (
                                trim($middlename ?? '') !== ''
                                || trim($lastname ?? '') !== ''
                            )
                        );
                @endphp

            @if($searchPerformed)
    <div wire:loading.remove wire:target="searchMember"
        class="overflow-hidden rounded-xl border border-[#E3E9E4]">

        <div class="border-b border-[#E9EDE9] bg-[#F8FAF8] px-4 py-3">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                Matching Member Records
            </p>
        </div>

        @forelse($members as $member)
            <button
                type="button"
                wire:key="registration-member-{{ $member->membership_id }}"
                wire:click="selectMember('{{ $member->membership_id }}')"
                wire:loading.attr="disabled"
                wire:target="selectMember"
                class="flex w-full items-center justify-between gap-4 border-b border-[#EEF1EE] px-4 py-4 text-left transition last:border-b-0 hover:bg-[#F5F8F2] disabled:cursor-wait disabled:opacity-60"
            >

                <div class="flex min-w-0 items-center gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#EAF0E6] text-[#789A60]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor"
                            stroke-width="1.7">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                        </svg>
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-bold text-[#172B3A]">
                            {{ $member->firstname }}
                            @if($member->middlename)
                                {{ $member->middlename }}
                            @endif
                            {{ $member->lastname }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $member->member_type ?? 'Member' }}
                        </p>
                    </div>
                </div>

                <span class="flex shrink-0 items-center gap-2 text-xs font-semibold text-[#789A60]">
                    <span wire:loading.remove wire:target="selectMember">
                        Select
                    </span>

                    <span wire:loading wire:target="selectMember">
                        Selecting...
                    </span>

                    <svg wire:loading.remove wire:target="selectMember"
                        class="h-4 w-4" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </span>
            </button>
        @empty
            <div class="px-5 py-10 text-center">
                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                    <svg class="h-6 w-6" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor"
                        stroke-width="1.7">
                        <circle cx="11" cy="11" r="7"/>
                        <path d="m20 20-4-4"/>
                    </svg>
                </div>

                <p class="text-sm font-semibold text-[#172B3A]">
                    No matching member found
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    Check the spelling or try another name.
                </p>
            </div>
        @endforelse
    </div>
@else
    <div class="rounded-xl border border-dashed border-[#DCE2DF] bg-[#FAFBFA] px-5 py-10 text-center">
        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-[#EAF0E6] text-[#789A60]">
            <svg class="h-6 w-6" viewBox="0 0 24 24"
                fill="none" stroke="currentColor"
                stroke-width="1.7">
                <circle cx="11" cy="11" r="7"/>
                <path d="m20 20-4-4"/>
            </svg>
        </div>

        <p class="text-sm font-semibold text-[#172B3A]">
            Search for your account
        </p>

        <p class="mt-1 text-xs text-slate-500">
            Enter your name and click Search Member to find your record.
        </p>
    </div>
@endif

                <div class="flex items-center justify-between border-t border-[#E9EDE9] pt-5">
                    <button
                        type="button"
                        @click="step = 1"
                        class="flex h-11 items-center justify-center rounded-xl border border-[#DCE2DF] px-5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        Back
                    </button>

                    <p class="text-xs text-slate-400">
                        Select your record to continue.
                    </p>
                </div>
            </div>

            {{-- ===================================== --}}
            {{-- STEP 3: REGISTRATION INFORMATION     --}}
            {{-- ===================================== --}}
            <div x-show="step === 3" x-cloak x-transition
                 class="space-y-8 px-6 py-8 sm:px-8">

                {{-- SELECTED MEMBER --}}
                <div class="rounded-xl border border-[#DCE8D5] bg-[#F5F8F2] p-5">
                    <div class="mb-3 flex items-center justify-between">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-[#789A60]">
                            Selected Member Account
                        </p>
                        <span class="rounded-full bg-[#E3EEDB] px-3 py-1 text-[10px] font-bold text-[#587447]">
                            Selected
                        </span>
                    </div>

                    @if($selectedMember)
                        <p class="text-lg font-bold text-[#172B3A]">
                            {{ $selectedMember->firstname }}
                            {{ $selectedMember->middlename }}
                            {{ $selectedMember->lastname }}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $selectedMember->member_type ?? 'Member' }} Account
                        </p>
                    @else
                        <p class="text-sm text-red-500">
                            No member account selected. Please go back and select a record.
                        </p>
                    @endif

                    <button
                        type="button"
                        @click="step = 2"
                        class="mt-3 text-xs font-semibold text-[#789A60] hover:underline"
                    >
                        Change selected member
                    </button>
                </div>

                {{-- SELECTED ACCOUNT TYPE --}}
                <div class="flex items-center justify-between rounded-xl border border-[#E3E9E4] bg-[#F8FAF8] p-4">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Account Classification
                        </p>
                        <p class="mt-1 text-sm font-bold text-[#172B3A]"
                           x-text="classification === 'residential'
                                ? 'Residential'
                                : 'Juridical / Public Building'">
                        </p>
                    </div>
                    <button type="button"
                            @click="step = 1"
                            class="text-xs font-semibold text-[#789A60] hover:underline">
                        Change
                    </button>
                </div>

                {{-- ACCOUNT INFORMATION --}}
                <section>
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#EAF0E6] text-sm font-bold text-[#789A60]">
                            01
                        </span>
                        <div>
                            <h4 class="text-sm font-bold text-[#172B3A]">
                                Cooperative Account Information
                            </h4>
                            <p class="mt-1 text-xs text-slate-500">
                                Provide your electric service account details.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                Membership / Account Number <span class="text-red-500">*</span>
                            </label>

                            <x-ui.select
                                wire:model.live="selectedAccountNumber"
                                name="account_number"
                                :options="$accounts->pluck('c_id', 'c_id')->map(fn ($id) => (string) $id)->toArray()"
                                placeholder="Select an account number"
                                class="w-full"
                            />

                            @if($selectedMember && $accounts->isEmpty())
                                <p class="mt-2 text-xs text-red-500">
                                    No accounts found for this member.
                                </p>
                            @endif
                        </div>
                    </div>
                </section>

                {{-- RESIDENTIAL INFORMATION --}}
                <section x-show="classification === 'residential'"
                         x-cloak class="space-y-5">

                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#EAF0E6] text-sm font-bold text-[#789A60]">
                            02
                        </span>
                        <div>
                            <h4 class="text-sm font-bold text-[#172B3A]">
                                Member-Consumer Information
                            </h4>
                            <p class="mt-1 text-xs text-slate-500">
                                Your selected member record.
                            </p>
                        </div>
                    </div>


                @if($selectedMember)
                    <div class="grid gap-4 sm:grid-cols-2">

                        {{-- FIRST NAME --}}
                        <div class="rounded-xl border border-[#E3E9E4] p-4">
                            <p class="text-[10px] font-bold uppercase text-slate-400">
                                First Name
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#172B3A]">
                                {{ $selectedMember->firstname }}
                            </p>
                        </div>

                        {{-- MIDDLE NAME --}}
                        <div class="rounded-xl border border-[#E3E9E4] p-4">
                            <p class="text-[10px] font-bold uppercase text-slate-400">
                                Middle Name
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#172B3A]">
                                {{ $selectedMember->middlename ?: '—' }}
                            </p>
                        </div>

                        {{-- LAST NAME --}}
                        <div class="rounded-xl border border-[#E3E9E4] p-4">
                            <p class="text-[10px] font-bold uppercase text-slate-400">
                                Last Name
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#172B3A]">
                                {{ $selectedMember->lastname }}
                            </p>
                        </div>

                        {{-- MEMBERSHIP TYPE --}}
                        <div class="rounded-xl border border-[#E3E9E4] p-4">
                            <p class="text-[10px] font-bold uppercase text-slate-400">
                                Membership Type
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#172B3A]">
                                {{ $selectedMember->member_type ?? '—' }}
                            </p>
                        </div>

                        {{-- MEMBERSHIP TYPE --}}
                        <div class="rounded-xl border border-[#E3E9E4] p-4">
                            <p class="text-[10px] font-bold uppercase text-slate-400">
                                Complete Address
                            </p>
                            <p class="mt-1 text-sm font-semibold text-[#172B3A]">
                                {{ $selectedMember->complete_address?? '—' }}
                            </p>
                        </div>
                        {{-- HIDDEN ADDRESS INFORMATION --}}
                        <div hidden>
                            <input type="hidden" wire:model="district">
                            <input type="hidden" wire:model="brgy">
                            <input type="hidden" wire:model="street">
                            <input type="hidden" wire:model="municipality">
                        </div>

                    </div>
                @endif

                </section>

                {{-- JURIDICAL INFORMATION --}}
                <section x-show="classification === 'juridical_public_building'"
                         x-cloak
                         class="space-y-5 rounded-xl border border-[#DCE2DF] bg-[#F8FAF8] p-5">

                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#E9EFF5] text-[#365D7A]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-8h6v8"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#172B3A]">
                                Organization Information
                            </h4>
                            <p class="mt-1 text-xs text-slate-500">
                                Provide the authorized representative details.
                            </p>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                            Organization / Establishment Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="organization_name"
                            placeholder="Enter organization or building name"
                            required
                            class="h-12 w-full rounded-xl border border-[#DCE2DF] bg-white px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                        >
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                Representative Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="representative_name"
                                placeholder="Authorized representative"
                                required
                                class="h-12 w-full rounded-xl border border-[#DCE2DF] bg-white px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                Position / Designation <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="representative_position"
                                placeholder="e.g. Manager, Director"
                                required
                                class="h-12 w-full rounded-xl border border-[#DCE2DF] bg-white px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                            >
                        </div>
                    </div>
                </section>

                {{-- CONTACT INFORMATION --}}
                <section>
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#EAF0E6] text-sm font-bold text-[#789A60]">
                            03
                        </span>
                        <div>
                            <h4 class="text-sm font-bold text-[#172B3A]">
                                Contact Information
                            </h4>
                            <p class="mt-1 text-xs text-slate-500">
                                How can we contact you regarding the assembly?
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                Mobile Number <span class="text-red-500">*</span>
                            </label>
                            <x-ui.input type="tel" name="mobile_number" autocomplete="tel" placeholder="09XX XXX XXXX" />
                        </div>

                        <div>
                            <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                Email Address
                            </label>
                            <x-ui.input type="email" name="email" autocomplete="email" placeholder="you@example.com" />
                        </div>
                       <div class="w-full min-w-0">
                        <label for="date_of_birth" class="mb-2 block text-xs font-semibold text-[#263B4B]">
                            Date of Birth <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="date"
                            id="date_of_birth"
                            name="date_of_birth"
                            x-model="dateOfBirth"
                            required
                            class="h-12 w-full min-w-0 rounded-xl border border-[#DCE2DF] bg-white px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                        >
                    </div>
                    </div>
                </section>

                    <section>
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#EAF0E6] text-sm font-bold text-[#789A60]">
                            04
                        </span>
                        <div>
                            <h4 class="text-sm font-bold text-[#172B3A]">
                                Valid ID Upload
                            </h4>
                            <p class="mt-1 text-xs text-slate-500">
                                Upload valid valid identification documents for verification. Accepted formats: JPG, PNG, PDF. Maximum file size: 15MB.
                            </p>
                        </div>
                    </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                            Valid ID <span class="text-red-500">*</span>
                        </label>

                        <x-ui.file-upload
                            name="validId"
                            wire:model="validId"
                            accept=".png,.jpg,.jpeg,.pdf"
                            maxSizeLabel="PNG, JPG, JPEG or PDF (Max 5 MB)"
                            required
                        />

                        @error('validId')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror

                        <div wire:loading wire:target="validId" class="mt-2 text-xs text-[#789A60]">
                            Uploading ID...
                        </div>
                    </div>
                </div>

                </section>

               {{-- CONSENT --}}
                <div class="rounded-xl border border-[#E3E9E4] bg-[#F8FAF8] p-4">
                    <label class="flex cursor-pointer items-start gap-3">
                        <input
                            type="checkbox"
                            x-model="consentAccepted"
                            class="mt-1 rounded border-slate-300 text-[#789A60] focus:ring-[#789A60]"
                        >

                        <span class="text-xs leading-6 text-slate-600">
                            I certify that the information I provided is accurate
                            and authorize the cooperative to use my information
                            for AGM registration and attendance verification
                            purposes.
                            <span class="text-red-500">*</span>
                        </span>
                    </label>
                </div>

                @if ($errors->any())
                    <div class="rounded-xl border border-red-200 bg-red-50 p-4">
                        <p class="mb-2 text-sm font-bold text-red-700">
                            Please correct the following:
                        </p>

                        <ul class="list-inside list-disc space-y-1 text-xs text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- ACTIONS --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row">
                    <button
                        type="button"
                        @click="step = 2"
                        class="flex h-12 items-center justify-center rounded-xl border border-[#DCE2DF] px-6 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        Back
                    </button>

                    <button
                        type="button"
                        wire:click="submitRegistration"
                        wire:loading.attr="disabled"
                        wire:target="submitRegistration"
                        :disabled="!dateOfBirth || !consentAccepted"
                        :class="(!dateOfBirth || !consentAccepted)
                            ? 'cursor-not-allowed bg-slate-300 text-slate-500 shadow-none'
                            : 'cursor-pointer bg-[#172B3A] text-white hover:bg-[#243F52] shadow-md'"
                        class="inline-flex w-full items-center justify-center rounded-xl px-6 py-3 text-sm font-bold transition duration-200 disabled:cursor-not-allowed"
                    >
                        <span wire:loading.remove wire:target="submitRegistration">
                            Submit Registration
                        </span>

                        <span wire:loading wire:target="submitRegistration">
                            Submitting...
                        </span>
                    </button>
                </div>
                <p class="text-center text-xs leading-5 text-slate-400">
                    Please review your information before submitting.
                    Your registration will be subject to verification.
                </p>
            </div>
        </div>

        {{-- FOOTER --}}
        <footer class="mt-10 text-center">
            <p class="text-xs text-slate-400">
                © {{ date('Y') }} AGMA ONE · Annual General Meeting Management
            </p>
            <p class="mt-2 text-xs text-slate-400">
                Member-Consumer Registration Portal
            </p>
        </footer>

        @endif

    </main>
</div>
