<nav aria-label="Page navigation example">
    @if ($paginator->lastPage() > 1)
        <ul class="pagination">
            <li class="{{ $paginator->currentPage() == 1 ? ' disabled' : '' }} page-link">
                <a href="{{ $paginator->url(1) }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="{{ $paginator->currentPage() == $i ? ' active' : '' }} page-link">
                    <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="{{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }} page-link">
                <a href="{{ $paginator->url($paginator->currentPage() + 1) }}">Next</a>
            </li>
        </ul>
    @endif
</nav>
