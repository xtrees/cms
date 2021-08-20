@extends('cms::content.content')

@section('contents')
    {!! $content->body !!}
    <br>
    <br>
    @foreach($galleries as $key=> $ga)
        <img class="gallery-image lazyload" data-fancybox="gallery" data-src="{{image_get($ga,'url')}}"
             alt="{{ $content->title.'_'.$key }}" src="{{lazy(image_get($ga,'url'))}}">
    @endforeach
    <div class="pager-holder">
        {{ $galleries->links('pagination::bootstrap-4') }}
    </div>
@endsection
