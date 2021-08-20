@extends('cms::layout')
@section('title',page_title($page).obg($content,'title'))
@section('keywords',obg($content,'keywords'))
@section('description',obg($content,'summary'))
@section('meta')
    <link rel="canonical" href="{{ data_get($content,'url') }}">
    <meta property="og:title" content="{{ $content->title }}"/>
    <meta property="og:image" content="{{ image_get($content,'thumbnail.url') }}"/>
@endsection

@section('content')
    <div class="wrap">
        <article class="article">
            <header>
                <h1>{{ $content->title }}</h1>
                <a href="{{ object_get($category,'url') }}">
                    <i class="iconfont icon-icon-test6"></i>{{object_get($category,'name')}}
                </a>
                <span><i class="iconfont icon-icon-test1"></i>{{ $content->views }}</span>
                <span><i class="iconfont icon-icon-test2"></i>{{ $content->favorites }}</span>
                <span><i class="iconfont icon-icon-test3"></i>{{ $content->published_at }}</span>
            </header>
            <div class="post-body">
                @yield('contents')
            </div>
        </article>

        <div class="tags">
            <span>标签:</span>
            @if(count($content->tags) ==0)
                <span>暂无标签</span>
            @endif
            @foreach($content->tags as $tag)
                <a href="{{ object_get($tag,'url') }}"
                   title="{{ object_get($tag,'name') }}">{{ object_get($tag,'name') }}</a>
            @endforeach
        </div>
        <nav class="article-nav">
        <span class="article-nav-prev">
            上一篇：
            @if(empty($prev))
                没有了
            @else
                <a href="{{ object_get($prev,'url') }}" rel="prev">{{ object_get($prev,'title') }}</a>
            @endif
        </span>
            <span class="article-nav-next">
            下一篇：
            @if(empty($next))
                    没有了
                @else
                    <a href="{{ object_get($next,'url') }}" rel="next">{{ object_get($next,'title') }}</a>
                @endif
            </span>
        </nav>

        <div class="article-list">
            <h3 class="column-title">相关推荐</h3>
            <div class="extend">
                @if(empty($related))
                    暂无相关推荐
                @else
                    @foreach($related as $item)
                        @include('cms::content.item',$item)
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @include('cms::sidebar.main')
@endsection
