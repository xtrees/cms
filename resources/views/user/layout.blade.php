<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title')-{{settings('site.name')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta3/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@1.41.2/iconfont/tabler-icons.min.css">
</head>
<body class="antialiased">
<div class="wrapper">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href=".">{{ settings('site.name') }}</a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <img class="avatar avatar-sm" src="{{ Auth::user()->avatarUrl }}" alt="logo">
                        <div class="d-none d-xl-block ps-2">
                            <div>{{Auth::user()->name}}</div>
                            <div class="mt-1 small text-muted">{{ data_get(Auth::user(),'role.name') }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('users.home') }}" class="dropdown-item">个人中心</a>
                        <div class="dropdown-divider"></div>
                        <form method="post" action="{{route('users.logout')}}">
                            <button class="dropdown-item">退出</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-home" style="font-size: 20px;"></i>
                                </span>
                                <span class="nav-link-title">网站首页</span>
                            </a>
                        </li>
                        <li class="nav-item {{route_active('users.history*')}}">
                            <a class="nav-link" href="{{ route('users.history.favorites') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-heart" style="font-size: 20px;"></i>
                                </span>
                                <span class="nav-link-title">我的收藏</span>
                            </a>
                        </li>
                        <li class="nav-item {{route_active('users.wallet*')}}">
                            <a class="nav-link" href="{{ route('users.wallet.coin') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-coin" style="font-size: 20px;"></i>
                                </span>
                                <span class="nav-link-title">充值中心</span>
                            </a>
                        </li>
                        <li class="nav-item {{route_active('users.home')}}">
                            <a class="nav-link" href="{{ route('users.home') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-user" style="font-size: 20px;"></i>
                                </span>
                                <span class="nav-link-title">个人中心</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    @yield('page-header')
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-12">
                        @if (flash()->message)
                            <div class="alert alert-dismissible {{ flash()->class }}" role="alert">
                                {{ flash()->message }}
                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                            </div>
                        @endif
                    </div>
                </div>
                @yield('page-body')
            </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0"></ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; {{date('Y')}}
                                <a href="/" class="link-secondary">{{ settings('site.name') }}</a>.
                                All rights reserved.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta3/dist/js/tabler.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('script')
</body>
</html>
