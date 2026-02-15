@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 text-gray-200 cursor-not-allowed border border-gray-100 transition duration-300">
                <i class="fa fa-chevron-left text-[10px]"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-12 h-12 flex items-center justify-center rounded-xl bg-white text-gray-400 border border-gray-100 hover:border-black hover:text-black transition duration-300 shadow-sm hover:shadow-xl hover:shadow-black/5">
                <i class="fa fa-chevron-left text-[10px]"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center gap-2 mx-4">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-12 h-12 flex items-center justify-center text-gray-400 font-black text-[10px] tracking-widest">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-12 h-12 flex items-center justify-center rounded-xl bg-black text-white text-[10px] font-black uppercase tracking-widest shadow-xl shadow-black/20 z-10">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center rounded-xl bg-white text-gray-400 border border-gray-100 hover:border-black hover:text-black text-[10px] font-black uppercase tracking-widest transition duration-300 shadow-sm hover:shadow-xl hover:shadow-black/5">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-12 h-12 flex items-center justify-center rounded-xl bg-white text-gray-400 border border-gray-100 hover:border-black hover:text-black transition duration-300 shadow-sm hover:shadow-xl hover:shadow-black/5">
                <i class="fa fa-chevron-right text-[10px]"></i>
            </a>
        @else
            <span class="w-12 h-12 flex items-center justify-center rounded-xl bg-gray-50 text-gray-200 cursor-not-allowed border border-gray-100 transition duration-300">
                <i class="fa fa-chevron-right text-[10px]"></i>
            </span>
        @endif
    </nav>
@endif
