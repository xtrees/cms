<ul>
    @foreach ($items as $item)
        <li class="{{ data_get($item,'active') }}">
            <a href="{{ url(data_get($item,'url')) }}" target="{{ $item->target }}">
                @if(!empty($item->icon))
                    <i class="{{ $item->icon }}"></i>
                @endif
                <span>{{ $item->title }}</span>
            </a>
            @if(!$item->children->isEmpty())
                @include('cms::menu.default', ['items' => $item->children, 'options' => $options])
            @endif
        </li>
    @endforeach
</ul>
