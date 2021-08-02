<!doctype html>
<html lang="zh_CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="renderer" content="webkit">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">@yield('meta')
    <link rel="stylesheet" href="{{ asset('default/app.css') }}" type="text/css"/>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_1204018_6odx6a524dw.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.staticfile.org/fancybox/3.5.7/jquery.fancybox.min.css" type="text/css"/>
    @yield('css')
</head>
<body>
<header class="header">
    <div class="container">
        <div class="brand">
            <a href="/" class="logo" title="{{ settings('site.name') }}">{{ settings('site.name') }}</a>
        </div>
        <div class="nav">
            {!! menus('navbar') !!}
        </div>
        <div class="nav navbar">
            <ul>
                @guest
                    <li class="">
                        <a href="{{ route('users.register') }}">注册</a>
                    </li>
                    <li>
                        <a href="{{ route('users.login') }}">登录</a>
                    </li>
                @endguest
                @auth
                    <li>
                        <a href="#" class="avatar" title="我的">
                            <span>我的</span>
                            <i class="iconfont icon-icon-test4"></i>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</header>
<nav class="nav-1">
    {!! menus('nav-1') !!}
</nav>
<section class="content">
    <section class="main">
        @yield('content')
    </section>
    <section class="sidebar">
        @yield('sidebar')
    </section>
</section>
<footer class="footer">
    <div>
        <h4>本网站所有内容来源于互联网，如有侵犯版权请来信告知，我们会第一时间删除！</h4>
        <h4>{{ settings('site.footer') }}</h4>
    </div>
</footer>
<script type="text/javascript" src="https://cdn.staticfile.org/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.staticfile.org/lazysizes/5.1.0/lazysizes.min.js" async></script>
<script type="text/javascript" src="https://cdn.staticfile.org/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="{{ asset('default/app.js') }}"></script>
@yield('script')
{!! settings('site.scripts') !!}
<div id="deleteAd"></div>
</body>
</html>
