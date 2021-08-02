<a href="{{$item->url}}" title="{{ $item->title }}">
    <span>
        <img class="lazyload" src="{{ cover_get($item,'thumbnail.url') }}" alt="{{ $item->title }}">
    </span>
    <h3>{{ $item->title }}</h3>
    <div class="sub-title">
        <span><i class="iconfont icon-icon-test1"></i>{{ $item->views }}</span>
        <span><i class="iconfont icon-icon-test2"></i>{{ $item->favorites }}</span>
    </div>
</a>
