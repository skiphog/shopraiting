<?php

/**
 * @var \Illuminate\Pagination\Paginator|\Illuminate\Pagination\LengthAwarePaginator $paginator
*/

?>
@if ($paginator->hasPages())
    @if(request()->getQueryString())
        @section('canonical', $paginator->path())
    @endif
    <div class="pagination">
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <div class="pagination__item">
                        @if ($page === $paginator->currentPage())
                            <a class="pagination__btn">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="pagination__btn">{{ $page }}</a>
                        @endif
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
@endif
