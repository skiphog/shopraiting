@if (!empty($contents))
    @push('styles')
        <link rel="stylesheet" href="/css/keep.css">
    @endpush
    <div class="keep">
        <a href="#" class="keep__link">Содержание
            <svg class="icon icon-keep" width="8" height="8">
                <use xlink:href="/img/sprite.svg#down-arrow"></use>
            </svg>
        </a>
        <ul id="menu">
            @foreach($contents as $item)
                <li>
                    <a href="{{ $item['link'] }}">{{ $item['title'] }}</a>
                    @if(!empty($item['child']))
                        <ul>
                            @foreach($item['child'] as $child)
                                <li><a href="{{ $child['link'] }}">{{ $child['title'] }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endif