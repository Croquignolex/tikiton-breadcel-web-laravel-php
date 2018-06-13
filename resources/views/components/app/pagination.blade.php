<!--Start Pagination Area-->
@if($paginationTools->pagesNumber > 0)
    <div class="pagination">
        <ul>
            @if($paginationTools->previousPage != 0)
                <li>
                    <a href="{{ $url . $paginationTools->previousPage }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for($i = $paginationTools->currentPage -  $paginationTools->itemsBeforeAndAfter; $i < $paginationTools->currentPage; $i++)
                    @if($i > 0)
                        <li>
                            <a href="{{ $url . $i }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endif
                @endfor
            @endif

            <li class="active"><span>{{ $paginationTools->currentPage }}</span></li>

            @for($i = $paginationTools->currentPage + 1; $i <= $paginationTools->pagesNumber; $i++)
                <li>
                    <a href="{{ $url . $i }}">
                        {{ $i }}
                    </a>
                </li>
                @if($i >= $paginationTools->currentPage + $paginationTools->itemsBeforeAndAfter)
                    @break
                @endif
            @endfor

            @if($paginationTools->nextPage != 0)
                <li>
                    <a href="{{ $url . $paginationTools->nextPage }}" aria-label="Previous">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
<!--End Pagination Area-->