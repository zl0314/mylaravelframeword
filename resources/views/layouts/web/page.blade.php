@if ($paginator->hasPages())


    @if ($paginator->onFirstPage())
        <a href='javascript:void(0);' class='btn'>
            &lt;
        </a>
    @else
        <a href='{{$paginator->previousPageUrl() }}' class='btn'>
           &lt;
        </a>

    @endif



    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href='javascript:void(0);' class='curr'>{{ $page }}</a>
                @else
                    <a href='{{ $url }}' >{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach



    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href='{{$paginator->nextPageUrl() }}' class='btn'>
           &gt;
        </a>
    @else
        <a href='javascript:void(0);' class='btn'>
            &gt;
        </a>
    @endif


@endif