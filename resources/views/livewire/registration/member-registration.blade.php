
<div
    x-data="{
        classification: @entangle('classification'),
        step: 1
    }"
    class="min-h-screen"
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
                Official AGM Registration
            </div>
        </div>
    </header>

    {{-- PAGE CONTENT --}}
    <main class="mx-auto max-w-4xl px-5 py-12 sm:px-8 sm:py-16">

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
        <div class="mb-6 flex items-center justify-center gap-2 sm:gap-3">

            <div class="flex items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold"
                      :class="step === 1 ? 'bg-[#172B3A] text-white' : 'bg-[#789A60] text-white'">
                    <span x-show="step === 1">1</span>
                    <svg x-show="step > 1" x-cloak class="h-4 w-4"
                         viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M16.7 5.3a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.4 0l-3-3a1 1 0 1 1 1.4-1.4L9 11.6l6.3-6.3a1 1 0 0 1 1.4 0Z"
                              clip-rule="evenodd"/>
                    </svg>
                </span>
                <span class="hidden text-xs font-semibold text-[#172B3A] sm:inline">
                    Account Type
                </span>
            </div>

            <div class="h-px w-5 bg-slate-300 sm:w-10"></div>

            <div class="flex items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold"
                      :class="step === 2 ? 'bg-[#172B3A] text-white' : step === 3 ? 'bg-[#789A60] text-white' : 'bg-slate-200 text-slate-500'">
                    <span x-show="step < 3">2</span>
                    <svg x-show="step === 3" x-cloak class="h-4 w-4"
                         viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M16.7 5.3a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.4 0l-3-3a1 1 0 1 1 1.4-1.4L9 11.6l6.3-6.3a1 1 0 0 1 1.4 0Z"
                              clip-rule="evenodd"/>
                    </svg>
                </span>
                <span class="hidden text-xs font-semibold text-slate-500 sm:inline">
                    Find Account
                </span>
            </div>

            <div class="h-px w-5 bg-slate-300 sm:w-10"></div>

            <div class="flex items-center gap-2">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-bold"
                      :class="step === 3 ? 'bg-[#172B3A] text-white' : 'bg-slate-200 text-slate-500'">
                    3
                </span>
                <span class="hidden text-xs font-semibold text-slate-500 sm:inline">
                    Registration
                </span>
            </div>
        </div>

        {{-- REGISTRATION CARD --}}
        <div class="overflow-hidden rounded-2xl border border-[#E3E9E4] bg-white shadow-sm">

            {{-- CARD HEADER --}}
            <div class="border-b border-[#E9EDE9] px-6 py-5 sm:px-8">
                <h3 class="font-semibold text-[#172B3A]"
                    x-text="step === 1
                        ? 'Select Account Classification'
                        : step === 2
                            ? 'Find Your Member Account'
                            : 'Registration Information'">
                </h3>

                <p class="mt-1 text-xs text-slate-500"
                   x-text="step === 1
                    ? 'Choose the classification that matches your electric service account.'
                    : step === 2
                        ? 'Search and select your existing member-consumer record.'
                        : 'Complete the required information below.'">
                </p>
            </div>

            <form wire:submit.prevent="submit">

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

                                <div class="mb-5 flex items-center justify-between">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EAF0E6] text-[#789A60]">
                                        <svg class="h-7 w-7" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor"
                                             stroke-width="1.7">
                                            <path d="m3 10 9-7 9 7"/>
                                            <path d="M5 9v12h14V9M9 21v-7h6v7"/>
                                        </svg>
                                    </div>

                                    <span class="flex h-6 w-6 items-center justify-center rounded-full border border-slate-300 text-transparent peer-checked:border-[#789A60] peer-checked:bg-[#789A60] peer-checked:text-white">
                                        <svg class="h-4 w-4" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M16.7 5.3a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.4 0l-3-3a1 1 0 1 1 1.4-1.4L9 11.6l6.3-6.3a1 1 0 0 1 1.4 0Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </span>
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
                                <p class="mt-1 text-xs text-slate-400">
                                    Single or Joint
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

                                <div class="mb-5 flex items-center justify-between">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#E9EFF5] text-[#365D7A]">
                                        <svg class="h-7 w-7" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor"
                                             stroke-width="1.7">
                                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            <path d="M9 21V9h6v12M7 7h.01M17 7h.01M7 11h.01M17 11h.01M7 15h.01M17 15h.01"/>
                                        </svg>
                                    </div>

                                    <span class="flex h-6 w-6 items-center justify-center rounded-full border border-slate-300 text-transparent peer-checked:border-[#365D7A] peer-checked:bg-[#365D7A] peer-checked:text-white">
                                        <svg class="h-4 w-4" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M16.7 5.3a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.4 0l-3-3a1 1 0 1 1 1.4-1.4L9 11.6l6.3-6.3a1 1 0 0 1 1.4 0Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </span>
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
                        @click="
                            if (classification) {
                                $wire.set('classification', classification);
                                step = 2;
                            }
                        "
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

                    <div>
                        <h4 class="text-lg font-bold text-[#172B3A]">
                            Find Your Member Account
                        </h4>
                        <p class="mt-2 text-sm text-slate-500">
                            Search for your existing member-consumer record to continue.
                        </p>
                    </div>

                    {{-- SELECTED CLASSIFICATION --}}
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


    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- First Name --}}
        <div>
            <label class="mb-2 block text-sm font-semibold text-[#172B3A]">
                First Name
            </label>
            <input
                type="text"
                wire:model.live.debounce.300ms="firstname"
                placeholder="Enter first name"
                class="w-full h-12 rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none transition focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/20"
            >
        </div>

        {{-- Middle Name --}}
        <div>
            <label class="mb-2 block text-sm font-semibold text-[#172B3A]">
                Middle Name
            </label>
            <input
                type="text"
                wire:model.live.debounce.300ms="middlename"
                placeholder="Enter middle name"
                @disabled($classification !== 'residential')
                class="w-full h-12 rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none transition focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/20 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400"
            >
        </div>

        {{-- Last Name --}}
        <div>
            <label class="mb-2 block text-sm font-semibold text-[#172B3A]">
                Last Name
            </label>
            <input
                type="text"
                wire:model.live.debounce.300ms="lastname"
                placeholder="Enter last name"
                @disabled($classification !== 'residential')
                class="w-full h-12 rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none transition focus:border-[#789A60] focus:ring-2 focus:ring-[#789A60]/20 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400"
            >
        </div>

    </div>


    <p class="text-xs text-slate-400">
        <span x-show="classification === 'residential'">
            Enter any combination of first, middle, and last name to find your account.
        </span>

        <span x-show="classification === 'juridical_public_building'">
            For juridical accounts, search using the First Name field only.
        </span>
    </p>

                    {{-- LOADING --}}
                    <div wire:loading.delay wire:target="search"
                         class="flex items-center gap-2 text-xs font-medium text-[#789A60]">
                        <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" opacity=".25"/>
                            <path d="M22 12a10 10 0 0 1-10 10"/>
                        </svg>
                        Searching accounts...
                    </div>

                    {{-- SEARCH RESULTS --}}
                    <div class="space-y-3" wire:loading.remove wire:target="search">

                        @if(strlen(trim($search ?? '')) >= 2)

                            @forelse($members as $member)

                                @php
                                    $memberName = trim(
                                        ($member->firstname ?? '') . ' ' .
                                        ($member->middlename ?? '') . ' ' .
                                        ($member->lastname ?? '')
                                    );
                                @endphp

                                <div wire:key="member-result-{{ $member->id }}"
                                     class="flex flex-col gap-3 rounded-xl border p-4 transition sm:flex-row sm:items-center sm:justify-between
                                     {{ $selectedMemberId == $member->id
                                        ? 'border-[#789A60] bg-[#F5F8F2]'
                                        : 'border-[#E3E9E4] bg-white hover:border-[#AABBA2]' }}">

                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#EAF0E6] text-[#789A60]">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.7">
                                                <circle cx="12" cy="8" r="4"/>
                                                <path d="M4 21a8 8 0 0 1 16 0"/>
                                            </svg>
                                        </div>

                                        <div>
                                            <h5 class="text-sm font-bold text-[#172B3A]">
                                                {{ $memberName }}
                                            </h5>

                                            <p class="mt-1 text-xs text-slate-500">
                                                {{ strtoupper($member->member_type ?? '') }}
                                            </p>
                                        </div>
                                    </div>

                                    <button
                                        type="button"
                                        wire:click="selectMember({{ $member->id }})"
                                        @click="step = 3"
                                        class="h-10 rounded-lg px-5 text-xs font-semibold text-white transition
                                            {{ $selectedMemberId == $member->id
                                                ? 'bg-[#789A60]'
                                                : 'bg-[#172B3A] hover:bg-[#243E50]' }}"
                                    >
                                        {{ $selectedMemberId == $member->id ? 'Selected' : 'Select Account' }}
                                    </button>

                                </div>

                            @empty

                                <div class="rounded-xl border border-dashed border-[#DCE2DF] px-5 py-10 text-center">
                                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="1.7">
                                            <circle cx="11" cy="11" r="7"/>
                                            <path d="m20 20-4-4"/>
                                        </svg>
                                    </div>

                                    <p class="text-sm font-semibold text-[#172B3A]">
                                        No matching account found
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Please check the spelling or try another name.
                                    </p>
                                </div>

                            @endforelse

                        @else

                            <div class="rounded-xl border border-dashed border-[#DCE2DF] px-5 py-10 text-center">
                                <p class="text-sm font-medium text-slate-500">
                                    Start typing to search for your account.
                                </p>
                                <p class="mt-1 text-xs text-slate-400">
                                    Enter at least 2 characters.
                                </p>
                            </div>

                        @endif

                    </div>

                    {{-- BACK --}}
                    <button
                        type="button"
                        @click="step = 1"
                        class="flex h-12 w-full items-center justify-center rounded-xl border border-[#DCE2DF] px-6 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        Back
                    </button>

                </div>


                {{-- ===================================== --}}
                {{-- STEP 3: REGISTRATION DETAILS          --}}
                {{-- ===================================== --}}
                <div x-show="step === 3" x-cloak x-transition
                     class="space-y-8 px-6 py-8 sm:px-8">

                    {{-- SELECTED MEMBER --}}
                    <div class="rounded-xl border border-[#DCE8D5] bg-[#F5F8F2] p-4">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-[#789A60]">
                                    Selected Member Account
                                </p>

                                @if($selectedMember)
                                    <p class="mt-1 text-sm font-bold text-[#172B3A]">
                                        {{ $selectedMember->firstname }}
                                        {{ $selectedMember->middlename }}
                                        {{ $selectedMember->lastname }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ strtoupper($selectedMember->member_type ?? '') }}
                                    </p>
                                @else
                                    <p class="mt-1 text-sm text-red-500">
                                        No member account selected.
                                    </p>
                                @endif
                            </div>

                            <button
                                type="button"
                                @click="step = 2"
                                class="text-xs font-semibold text-[#789A60] hover:underline"
                            >
                                Change Account
                            </button>
                        </div>
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

                                <input
                                    type="text"
                                    name="account_number"
                                    placeholder="Enter your account number"
                                    required
                                    class="h-12 w-full rounded-xl border border-[#DCE2DF] px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                    Complete Address <span class="text-red-500">*</span>
                                </label>

                                <textarea
                                    name="address"
                                    rows="3"
                                    placeholder="House number, street, barangay, municipality"
                                    required
                                    class="w-full rounded-xl border border-[#DCE2DF] px-4 py-3 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                                ></textarea>
                            </div>
                        </div>
                    </section>

                    {{-- RESIDENTIAL INFORMATION --}}
                    <section
                        x-show="classification === 'residential'"
                        x-cloak
                        class="space-y-5"
                    >
                        <div class="flex items-center gap-3">
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#EAF0E6] text-sm font-bold text-[#789A60]">
                                02
                            </span>

                            <div>
                                <h4 class="text-sm font-bold text-[#172B3A]">
                                    Member-Consumer Information
                                </h4>
                                <p class="mt-1 text-xs text-slate-500">
                                    Enter the personal details of the member-consumer.
                                </p>
                            </div>
                        </div>

                        <div class="grid gap-5 sm:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="first_name"
                                       placeholder="First name"
                                       required
                                       autocomplete="given-name"
                                       class="h-12 w-full rounded-xl border border-[#DCE2DF] px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10">
                            </div>

                            <div>
                                <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                    Middle Name
                                </label>
                                <input type="text" name="middle_name"
                                       placeholder="Middle name"
                                       class="h-12 w-full rounded-xl border border-[#DCE2DF] px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10">
                            </div>

                            <div>
                                <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="last_name"
                                       placeholder="Last name"
                                       required
                                       autocomplete="family-name"
                                       class="h-12 w-full rounded-xl border border-[#DCE2DF] px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10">
                            </div>

                            <div>
                                <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                    Suffix
                                </label>
                                <input type="text" name="suffix"
                                       placeholder="e.g. Jr., Sr., III"
                                       class="h-12 w-full rounded-xl border border-[#DCE2DF] px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10">
                            </div>
                        </div>
                    </section>

                    {{-- JURIDICAL INFORMATION --}}
                    <section
                        x-show="classification === 'juridical_public_building'"
                        x-cloak
                        class="space-y-5 rounded-xl border border-[#DCE2DF] bg-[#F8FAF8] p-5"
                    >
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
                                    Provide the organization and its authorized representative details.
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
                                required
                                placeholder="Enter organization or building name"
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
                                    required
                                    placeholder="Authorized representative"
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
                                    required
                                    placeholder="e.g. Manager, Director"
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

                                <input
                                    type="tel"
                                    name="mobile_number"
                                    placeholder="09XX XXX XXXX"
                                    autocomplete="tel"
                                    required
                                    class="h-12 w-full rounded-xl border border-[#DCE2DF] px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-xs font-semibold text-[#263B4B]">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    placeholder="you@example.com"
                                    autocomplete="email"
                                    class="h-12 w-full rounded-xl border border-[#DCE2DF] px-4 text-sm outline-none focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                                >
                            </div>
                        </div>
                    </section>

                    {{-- CONSENT --}}
                    <div class="rounded-xl border border-[#E3E9E4] bg-[#F8FAF8] p-4">
                        <label class="flex cursor-pointer items-start gap-3">
                            <input
                                type="checkbox"
                                name="consent"
                                value="1"
                                required
                                class="mt-0.5 h-4 w-4 rounded border-slate-300 accent-[#789A60]"
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
                            type="submit"
                            class="flex h-12 flex-1 items-center justify-center gap-3 rounded-xl bg-[#172B3A] px-6 text-sm font-semibold text-white shadow-lg shadow-[#172B3A]/10 transition hover:bg-[#243E50]"
                        >
                            Submit Registration

                            <svg class="h-4 w-4" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14m-6-6 6 6-6 6"/>
                            </svg>
                        </button>
                    </div>

                    <p class="text-center text-xs leading-5 text-slate-400">
                        Please review your information before submitting.
                        Your registration will be subject to verification.
                    </p>
                </div>

            </form>
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

    </main>
</div>
