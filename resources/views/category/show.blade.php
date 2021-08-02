@extends('layout')
@section('title',page_title($page).obg($category,'title'))
@section('keywords',obg($category,'keywords'))
@section('description',obg($category,'summary'))
@section('content')
    <nav class="nav-2">
        {!! menus('nav-2') !!}
    </nav>
    <div class="list-title">
        <h1>{{ obg($category,'name') }}</h1>
    </div>
    @if($page == 1)
        <div class="list-detail">{!! obg($category,'summary') !!}</div>
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
