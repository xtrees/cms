@extends('cms::layout')
@section('title',settings('home.title'))
@section('keywords',settings('home.keywords'))
@section('description',settings('home.description'))
@section('content')
    <nav class="nav-2">
        {!! menus('nav-1') !!}
    </nav>
    <div class="top-1">
        <div class="extend">
            @foreach(collection('rem1',16) as $item)
                <a href="{{ obg($item,'url') }}">
                    <img src="{{ image_get($item,'thumbnail.url') }}" alt="{{ obg($item,'title') }}">
                </a>
            @endforeach
        </div>
    </div>
    <div class="list-title">
        <h1>最新发布</h1>
    </div>
    <div class="article-list">
        <div class="extend">
            @foreach(collection('rem1',12) as $item)
                @include('cms::content.item',$item)
            @endforeach
        </div>
    </div>
    <div class="list-title">
        <h1>精选推荐</h1>
    </div>
    <div class="article-list">
        <div class="extend">
            @foreach(collection('rem2',12)  as $item)
                @include('cms::content.item',$item)
            @endforeach
        </div>
    </div>
@endsection

@section('sidebar')
    @include('cms::sidebar.main')
@endsection
