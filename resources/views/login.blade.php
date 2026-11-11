
<x-layout.login title="Welcome Back">

<div class="min-h-screen grid lg:grid-cols-[1.08fr_0.92fr]">

    {{-- LEFT BRANDING PANEL --}}
    <section class="relative hidden min-h-screen flex-col justify-between overflow-hidden bg-[#172B3A] px-12 py-10 text-white lg:flex xl:px-16">

        {{-- Background decoration --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -right-40 -top-40 h-[550px] w-[550px] rounded-full border border-white/[0.06]"></div>
            <div class="absolute -right-20 -top-20 h-[400px] w-[400px] rounded-full border border-white/[0.06]"></div>
            <div class="absolute -bottom-52 -left-40 h-[600px] w-[600px] rounded-full bg-[#8BAF72]/10 blur-3xl"></div>

            <div class="absolute inset-0 opacity-[0.07]"
                 style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 28px 28px;">
            </div>
        </div>

        {{-- Brand --}}
        <div class="relative z-10 flex items-center gap-3">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#8BAF72] text-[#172B3A]">
                <svg viewBox="0 0 40 40" fill="none" class="h-7 w-7">
                    <path d="M20 4L35 12.5V27.5L20 36L5 27.5V12.5L20 4Z"
                          stroke="currentColor" stroke-width="2.5"/>
                    <path d="M13 24L20 11L27 24M15.5 20H24.5"
                          stroke="currentColor" stroke-width="2.5"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div>
                <h1 class="text-xl font-extrabold tracking-[0.16em]">
                    AGMA<span class="text-[#A9C98E]"> ONE</span>
                </h1>
                <p class="mt-0.5 text-[10px] font-medium tracking-[0.22em] text-slate-400">
                    MANAGEMENT SUITE
                </p>
            </div>
        </div>

        {{-- Main content --}}
        <div class="relative z-10 my-auto max-w-xl py-16">

            <div class="mb-8 inline-flex items-center gap-2 rounded-full border border-[#A9C98E]/20 bg-[#A9C98E]/10 px-4 py-2">
                <span class="h-2 w-2 rounded-full bg-[#A9C98E]"></span>
                <span class="text-xs font-medium tracking-wide text-[#C3DDB0]">
                    ONE PLATFORM. BETTER OPERATIONS.
                </span>
            </div>

            <h2 class="text-4xl font-semibold leading-[1.2] tracking-tight xl:text-5xl">
                Manage with
                <span class="text-[#A9C98E]">clarity.</span>
                <br>
                Move forward
                <br>
                with confidence.
            </h2>

            <p class="mt-7 max-w-md text-sm leading-7 text-slate-300">
                A centralized management experience designed to
                simplify daily operations, organize information,
                and help your organization work better together.
            </p>

            {{-- Abstract dashboard illustration --}}
            <div class="mt-12 max-w-md rounded-2xl border border-white/10 bg-white/[0.06] p-5 shadow-2xl backdrop-blur-sm">

                <div class="flex items-center justify-between border-b border-white/10 pb-4">
                    <div>
                        <p class="text-[10px] font-medium uppercase tracking-[0.2em] text-slate-400">
                            AGMA OVERVIEW
                        </p>
                        <p class="mt-1 text-sm font-semibold text-white">
                            Your operations, connected.
                        </p>
                    </div>

                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#A9C98E]/15 text-[#A9C98E]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M4 19V5m0 14h16M8 15l3-4 3 2 5-7"/>
                        </svg>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 py-5">
                    <div class="rounded-xl bg-white/[0.06] p-3">
                        <div class="mb-3 h-7 w-7 rounded-lg bg-blue-400/15"></div>
                        <div class="h-2 w-12 rounded-full bg-white/30"></div>
                        <div class="mt-2 h-4 w-8 rounded bg-white/80"></div>
                    </div>

                    <div class="rounded-xl bg-white/[0.06] p-3">
                        <div class="mb-3 h-7 w-7 rounded-lg bg-[#A9C98E]/20"></div>
                        <div class="h-2 w-12 rounded-full bg-white/30"></div>
                        <div class="mt-2 h-4 w-10 rounded bg-white/80"></div>
                    </div>

                    <div class="rounded-xl bg-white/[0.06] p-3">
                        <div class="mb-3 h-7 w-7 rounded-lg bg-amber-400/15"></div>
                        <div class="h-2 w-12 rounded-full bg-white/30"></div>
                        <div class="mt-2 h-4 w-7 rounded bg-white/80"></div>
                    </div>
                </div>

                <div class="flex items-center gap-3 rounded-xl border border-white/10 bg-white/[0.04] p-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#A9C98E]/15 text-[#A9C98E]">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12l4 4L19 6"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-white">Everything in one place</p>
                        <p class="mt-1 text-[10px] text-slate-400">Connected. Organized. Accessible.</p>
                    </div>
                    <div class="ml-auto h-2 w-2 rounded-full bg-[#A9C98E]"></div>
                </div>

            </div>
        </div>

        {{-- Left footer --}}
        <div class="relative z-10 flex items-center justify-between border-t border-white/10 pt-6">
            <p class="text-xs text-slate-400">
                © {{ date('Y') }} AGMA ONE
            </p>
            <p class="text-xs tracking-wide text-slate-400">
                BUILT FOR BETTER MANAGEMENT.
            </p>
        </div>
    </section>


    {{-- RIGHT LOGIN PANEL --}}
    <section class="flex min-h-screen items-center justify-center bg-[#F7F8F6] px-6 py-12 sm:px-12">

        <div class="w-full max-w-[410px]">

            {{-- Mobile brand --}}
            <div class="mb-14 flex items-center gap-3 lg:hidden">
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
                    <p class="text-[10px] tracking-[0.18em] text-slate-500">
                        MANAGEMENT SUITE
                    </p>
                </div>
            </div>

            {{-- Heading --}}
            <div class="mb-9">
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-[#789A60]">
                    YOUR WORKSPACE AWAITS
                </p>

                <h2 class="text-3xl font-bold tracking-tight text-[#172B3A]">
                    Welcome back.
                </h2>

                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Sign in to access your AGMA management workspace.
                </p>
            </div>

            {{-- Session message --}}
            @if (session('status'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Login form --}}
             {{-- action="{{ route('login.store') }}" --}}
            <form method="POST" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-[#263B4B]">
                        Email address
                    </label>

                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-slate-400"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="3" y="5" width="18" height="14" rx="2"/>
                            <path d="m3 7 9 6 9-6"/>
                        </svg>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="username"
                            required
                            autofocus
                            class="h-13 w-full rounded-xl border border-[#DCE2DF] bg-white pl-12 pr-4 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 hover:border-[#AAB8AF] focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                        >
                    </div>

                    @error('email')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div x-data="{ showPassword: false }">

                    <div class="mb-2 flex items-center justify-between">
                        <label for="password" class="text-sm font-semibold text-[#263B4B]">
                            Password
                        </label>

                        {{-- {{ route('password.request') }} --}}
                        @if (Route::has('password.request'))
                            <a href=""
                               class="text-xs font-semibold text-[#789A60] transition hover:text-[#536F42]">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 h-[18px] w-[18px] -translate-y-1/2 text-slate-400"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="4" y="10" width="16" height="11" rx="2"/>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                        </svg>

                        <input
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            id="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                            class="h-13 w-full rounded-xl border border-[#DCE2DF] bg-white pl-12 pr-12 text-sm text-[#172B3A] outline-none transition placeholder:text-slate-400 hover:border-[#AAB8AF] focus:border-[#789A60] focus:ring-4 focus:ring-[#789A60]/10"
                        >

                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-[#172B3A]"
                            :aria-label="showPassword ? 'Hide password' : 'Show password'"
                        >
                            <svg x-show="!showPassword" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>

                            <svg x-show="showPassword" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                                <path d="M9.9 5.2A10 10 0 0 1 12 5c6.4 0 10 7 10 7a16 16 0 0 1-3.2 4.1M6.2 6.2C3.5 8 2 12 2 12s3.6 7 10 7a10 10 0 0 0 4-.8"/>
                            </svg>
                        </button>
                    </div>

                    @error('password')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember me --}}
                <div class="flex items-center gap-2.5">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        value="1"
                        class="h-4 w-4 rounded border-slate-300 accent-[#789A60] focus:ring-[#789A60]"
                    >

                    <label for="remember" class="text-sm text-slate-600">
                        Keep me signed in
                    </label>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="group flex h-13 w-full items-center justify-center gap-3 rounded-xl bg-[#172B3A] px-6 text-sm font-semibold text-white shadow-lg shadow-[#172B3A]/10 transition hover:bg-[#243E50] focus:outline-none focus:ring-4 focus:ring-[#789A60]/20 active:scale-[0.99]"
                >
                    Sign in

                    <svg class="h-4 w-4 transition-transform group-hover:translate-x-1"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14m-6-6 6 6-6 6"/>
                    </svg>
                </button>

            </form>

            {{-- Security information --}}
            <div class="mt-9 flex items-start gap-3 rounded-xl border border-[#E4E9E5] bg-white p-4">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#EAF0E6] text-[#789A60]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                </div>

                <div>
                    <p class="text-xs font-semibold text-[#263B4B]">
                        Secure workspace access
                    </p>
                    <p class="mt-1 text-xs leading-5 text-slate-500">
                        Your account is protected. Access is restricted
                        to authorized AGMA users.
                    </p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-12 flex items-center justify-between border-t border-[#E5E9E6] pt-6">
                <p class="text-xs text-slate-400">
                    © {{ date('Y') }} AGMA ONE
                </p>

                <p class="text-xs font-medium text-slate-400">
                    Management Suite
                </p>
            </div>

        </div>
    </section>

</div>

</x-layout.login>
