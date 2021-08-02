@extends('layout')
@section('title',page_title($page).obg($tag,'seo_t'))
@section('keywords',obg($tag,'seo_k'))
@section('description',obg($tag,'seo_d'))

@section('content')
    <nav class="nav-2">
        {!! menu('nav-2') !!}
    </nav>
    <div class="list-title">
        <h1>{{ obg($tag,'name') }}</h1>
    </div>
    @if($page == 1)
        <div class="list-detail">{!! obg($tag,'body') !!}</div>
    @endif
    <div class="article-list">
        <div class="extend">
            @foreach($articles as $article)
                @include('article.list-item',$article)
            @endforeach
        </div>
    </div>
    <div class="pager">
        {{ $articles->links() }}
    </div>
@endsection

@section('sidebar')
    @include('sidebar.main')
@endsection