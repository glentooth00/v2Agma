
{{-- CUSTOM LIGHT PAGINATION --}}
@if($members->hasPages())
    <div class="border-t border-[#E8ECE7] bg-white px-5 py-4">

        <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">

            {{-- RESULTS INFO --}}
            <p class="text-xs font-medium text-slate-500">
                Showing
                <span class="font-bold text-[#172B3A]">{{ $members->firstItem() }}</span>
                to
                <span class="font-bold text-[#172B3A]">{{ $members->lastItem() }}</span>
                of
                <span class="font-bold text-[#172B3A]">{{ $members->total() }}</span>
                members
            </p>

            {{-- PAGE BUTTONS --}}
            <div class="flex flex-wrap items-center justify-center gap-1.5">

                {{-- PREVIOUS --}}
                <button
                    type="button"
                    wire:click="previousPage"
                    @disabled($members->onFirstPage())
                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-[#E2E8E0] bg-white text-slate-500 transition hover:bg-[#EDF3E9] hover:text-[#587447] disabled:cursor-not-allowed disabled:bg-[#F8FAF7] disabled:text-slate-300">
                    <x-lucide-chevron-left class="h-4 w-4" />
                </button>

                {{-- PAGE NUMBERS --}}
                @for($page = 1; $page <= $members->lastPage(); $page++)

                    @if($page == $members->currentPage())
                        <span
                            aria-current="page"
                            class="flex h-9 min-w-9 items-center justify-center rounded-lg border border-[#789A60] bg-[#789A60] px-3 text-sm font-bold text-white shadow-sm">
                            {{ $page }}
                        </span>
                    @else
                        <button
                            type="button"
                            wire:click="gotoPage({{ $page }})"
                            class="flex h-9 min-w-9 items-center justify-center rounded-lg border border-[#E2E8E0] bg-white px-3 text-sm font-semibold text-slate-600 transition hover:border-[#C9D5C3] hover:bg-[#EDF3E9] hover:text-[#587447]">
                            {{ $page }}
                        </button>
                    @endif

                @endfor

                {{-- NEXT --}}
                <button
                    type="button"
                    wire:click="nextPage"
                    @disabled(!$members->hasMorePages())
                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-[#E2E8E0] bg-white text-slate-500 transition hover:bg-[#EDF3E9] hover:text-[#587447] disabled:cursor-not-allowed disabled:bg-[#F8FAF7] disabled:text-slate-300">
                    <x-lucide-chevron-right class="h-4 w-4" />
                </button>

            </div>
        </div>
    </div>
@endif
