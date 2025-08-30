@if ($paginator->hasPages())
    <div class="pagination-wrap">
        <ul class="pagination">

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled" aria-disabled="true">
                    <span><i class="fas fa-angle-double-left"></i></span>
                </li>
            @else
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Page Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item active"><span>{{ $page }}</span></li>
                        @else
                            <li class="pagination-item"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            @else
                <li class="pagination-item disabled" aria-disabled="true">
                    <span><i class="fas fa-angle-double-right"></i></span>
                </li>
            @endif

        </ul>
    </div>
@endif