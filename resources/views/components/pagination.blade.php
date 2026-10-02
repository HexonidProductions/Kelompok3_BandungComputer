@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1">
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-xs text-slate-400 bg-slate-100 rounded-md cursor-not-allowed">
                Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-xs font-semibold text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition">
                Previous
            </a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)
            {{-- Array String / Titik-titik (...) --}}
            @if (is_string($element))
                <span class="px-3 py-1 text-xs text-slate-400">{{ $element }}</span>
            @endif

            {{-- Array Link Halaman --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 text-xs font-bold text-white bg-blue-600 rounded-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 text-xs font-semibold text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-xs font-semibold text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition">
                Next 
            </a>
        @else
            <span class="px-3 py-1 text-xs text-slate-400 bg-slate-100 rounded-md cursor-not-allowed">
                Next
            </span>
        @endif
    </nav>
@endif