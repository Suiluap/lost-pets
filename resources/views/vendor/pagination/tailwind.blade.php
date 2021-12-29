@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <div class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200">
                    <i class="fas fa-angle-left"></i>
                </div>
            @else
                <a href="{{ $paginator->previousPageUrl() }}">
                    <div class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer hover:bg-gray-300">
                        <i class="fas fa-angle-left"></i>
                    </div>
                </a>
            @endif

            <div class="w-8 flex justify-center items-center cursor-pointer leading-5 rounded-full bg-indigo-400 text-white">{{$paginator->currentPage()}}</div>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}">
                    <div class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer hover:bg-gray-300">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </a>
            @else
                <div class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200">
                    <i class="fas fa-angle-right"></i>
                </div>
            @endif
        </div>

        <div class="hidden sm:flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200">
                    <i class="fas fa-angle-left"></i>
                </div>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <div class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer hover:bg-gray-300">
                        <i class="fas fa-angle-left"></i>
                    </div>
                </a>
            @endif

            <div class="flex h-8 rounded-full bg-gray-200">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                    <div class="w-8 sm:flex justify-center items-center hidden leading-5 cursor-default rounded-full">{{ $element }}</div>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <div class="w-8 sm:flex justify-center items-center hidden cursor-default leading-5 rounded-full bg-indigo-400 text-white">{{ $page }}</div>
                            @else
                                <a href="{{ $url }}" class="w-8 sm:flex justify-center items-center hidden cursor-pointer leading-5 rounded-full hover:bg-gray-300">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <div class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer hover:bg-gray-300">
                        <i class="fas fa-angle-right"></i>
                    </div>
                </a>
            @else
                <div class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200">
                    <i class="fas fa-angle-right"></i>
                </div>
            @endif
        </div>
    </nav>
@endif
