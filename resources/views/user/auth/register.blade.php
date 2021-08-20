@extends('cms::user.auth.layout')
@section('title','注册')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pluritech/ionicons@3.0.0/dist/css/ionicons.min.css">
    <style>
        body {
            background: #f1f7fc;
        }

        .login-clean {
            padding: 80px 0;
        }

        .login-clean form {
            max-width: 640px;
            width: 90%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 4px;
            color: #505e6c;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }

        .login-clean .illustration {
            text-align: center;
            padding: 0 0 20px;
            font-size: 100px;
            color: rgb(244, 71, 107);
        }

        .login-clean form .form-control {
            background: #f7f9fc;
            border: none;
            border-bottom: 1px solid #dfe7f1;
            border-radius: 0;
            box-shadow: none;
            outline: none;
            color: inherit;
            text-indent: 8px;
            height: 42px;
        }

        .login-clean form .btn-primary {
            background: #f4476b;
            border: none;
            border-radius: 4px;
            padding: 11px;
            box-shadow: none;
            margin-top: 26px;
            text-shadow: none;
            outline: none !important;
        }

        .login-clean form .btn-primary:hover, .login-clean form .btn-primary:active {
            background: #eb3b60;
        }

        .login-clean form .btn-primary:active {
            transform: translateY(1px);
        }

        .login-clean form .forgot {
            display: block;
            text-align: center;
            font-size: 12px;
            color: #6f7a85;
            opacity: 0.9;
            text-decoration: none;
        }

        .login-clean form .forgot:hover, .login-clean form .forgot:active {
            opacity: 1;
            text-decoration: none;
        }
    </style>
@endsection
@section('body')
    <section class="login-clean" style="margin-top: 5%">
        <form method="post" action="{{ route('users.register') }}">
            @csrf
            <h3 class="">注册 / Register</h3>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="mb-3">
                <input title="email" class="form-control" type="email" name="email" placeholder="邮箱"
                       value="{{old('email')}}">
            </div>
            <div class="mb-3">
                <input title="name" class="form-control" type="text" name="name" placeholder="昵称"
                       value="{{old('name')}}">
            </div>
            <div class="mb-3">
                <input title="password" class="form-control" type="password" name="password" placeholder="密码">
            </div>
            <div class="mb-3">
                <input title="password_confirmation" class="form-control" type="password" name="password_confirmation"
                       placeholder="重复密码">
            </div>
            @include('cms::partials.error',[$errors])
            <div class="mb-3">
                <button class="btn btn-primary d-block w-100" type="submit">注册</button>
            </div>
            <a class="forgot" href="{{ route('users.login') }}">已注册，登录?</a>
        </form>
    </section>
@endsection
