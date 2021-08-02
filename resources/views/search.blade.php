@extends('layout')
@php /** @var string $keyword */ $seo=['{word}'=>$keyword]; @endphp
@section('title',page_title($page).replace(setting('site.search-title'),$seo))
@section('keywords',replace(setting('site.search-keywords'),$seo))
@section('description',replace(setting('site.search-description'),$seo))

@section('content')
    <nav class="nav-2">
        {!! menu('nav-2') !!}
    </nav>
    <div class="list-title">
        <h1>搜索“{{ $keyword }}”的结果</h1>
    </div>
    <div class="keywords">
        <span>热门搜索：</span>
        @foreach($keywords as $kw)
            <a href="{{ route('search',['q'=>$kw]) }}">{{ $kw }}</a>
        @endforeach
    </div>
    <div class="article-list">
        <div class="extend">
            @if(!count($articles)) <span style="margin: 50px 0;display: block;width: 100%;text-align: center;">无结果，换个关键词吧！</span> @endif
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