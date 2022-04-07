
@if ($paginator->hasPages())
    <ul class="pager">
        @if ($paginator->onFirstPage())
            <li class="no-more disabled"><span>← Previous</span></li>
        @else
            <li><a class="inactive" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>
        @endif
     
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span class="triple-dots" style="cursor: default">{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active"><span>{{ $page }}</span></li>
                    @else
                        <li><a class="inactive" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a class="inactive" href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
        @else
            <li class="no-more disabled"><span>Next →</span></li>
        @endif
    </ul>
@endif 