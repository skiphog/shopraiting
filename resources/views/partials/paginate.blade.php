<?php

/**
 * @var \Illuminate\Pagination\Paginator|\Illuminate\Pagination\LengthAwarePaginator $paginator
*/

?>
@if ($paginator->hasPages())
    {{--@if(request()->getQueryString())
        @section('paginate', ' | Страница ' . $paginator->currentPage())
    @endif--}}
    @section('paginate', ' | Страница ' . $paginator->currentPage())
    @section('canonical',  request()->url() . (1 !== $paginator->currentPage() ? '?page=' . $paginator->currentPage(): ''))
    <div class="pagination">
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <div class="pagination__item">
                        @if ($page === $paginator->currentPage())
                            <a class="pagination__btn">{{ $page }}</a>
                        @else
                            @if(1 === $page)
                                <a href="{{ str_replace('?page=1', '', $url) }}" class="pagination__btn">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}" class="pagination__btn">{{ $page }}</a>
                            @endif
                        @endif
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
@endif
