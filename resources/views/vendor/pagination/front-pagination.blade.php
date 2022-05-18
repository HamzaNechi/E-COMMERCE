@if ($paginator->hasPages())
<ul class="pagination-box pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <!-- <li class="disabled"><span>&laquo;</span></li> -->
    @else
    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="lastudioicon-arrow-left"></i></a></li>
    @endif
​
    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="disabled"><a><span>{{ $element }}</span></a></li>
    @endif
​
    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="active"><a>{{ $page }}</a></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach
​
    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li><a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="lastudioicon-arrow-right"></i></a></li>
    @else
    <!-- <li class="disabled"><span>&raquo;</span></li> -->
    @endif
</ul>
​
@endif