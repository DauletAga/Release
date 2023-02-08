@if ($paginator->hasPages())

    @if ($paginator->onFirstPage())
        <ul class="pagination pagination-tabs card-pagination disabled">
            <li class="page-item disabled">
                <a class="page-link ps-0 pe-4 border-end" href="#">
                    <i class="fe fe-arrow-left me-1"></i> {{ ('Предыдущая') }}
                </a>
            </li>
        </ul>
    @else
        <ul class="pagination pagination-tabs card-pagination">
            <li class="page-item">
                <a class="page-link ps-0 pe-4 border-end" href="{{ $paginator->previousPageUrl() }}">
                    <i class="fe fe-arrow-left me-1"></i> {{ ('Предыдущая') }}
                </a>
            </li>
        </ul>
    @endif

    <ul class="pagination pagination-tabs card-pagination">
        @foreach ($elements as $element)
            @if (is_string($element))
                <li><a class="page disabled" aria-disabled="true" href="#">{{ $element }}</a></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a class="page" href="#">{{ $page }}</a></li>
                    @else
                        <li><a class="page" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>


    @if ($paginator->hasMorePages())
        <ul class="pagination pagination-tabs card-pagination">
            <li class="page-item">
                <a class="page-link ps-4 pe-0 border-start" href="{{ $paginator->nextPageUrl() }}">
                    {{ ('Следующая') }} <i class="fe fe-arrow-right ms-1"></i>
                </a>
            </li>
        </ul>
    @else
        <ul class="pagination pagination-tabs card-pagination disabled">
            <li class="page-item disabled">
                <a class="page-link ps-4 pe-0 border-start" href="#">
                    {{ ('Следующая') }} <i class="fe fe-arrow-right ms-1"></i>
                </a>
            </li>
        </ul>
    @endif
@endif