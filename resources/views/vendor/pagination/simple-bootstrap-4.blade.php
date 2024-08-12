@if ($paginator->hasPages())
<div class="col-lg-6 text-center">
    <nav class="navigation pagination d-inline-block">
        <div class="nav-links">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    {{-- <span class="page-link">@lang('pagination.previous')</span> --}}
                    <a class="prev page-numbers" href="#">Prev</a>
                </li>
            @else
                <li class="page-item">
                    <a class="next page-numbers" href="{{ $paginator->previousPageUrl() }}">Prev</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="prev page-numbers" href="{{ $paginator->nextPageUrl() }}">prev</a>
                    {{-- <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a> --}}
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <a class="next page-numbers" href="#">Next</a>
                    {{-- <span class="page-link">@lang('pagination.next')</span> --}}
                </li>
            @endif
        </div>
    </nav>
</div>
@endif
