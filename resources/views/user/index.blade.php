@extends('cms::user.layout')
@section('title','个人中心')
@section('page-header')
    <div class="col">
        <div class="page-pretitle">User Center</div>
        <h2 class="page-title">
            个人中心
        </h2>
    </div>
@endsection

@section('page-body')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card card-link">
                <div class="card-cover card-cover-blurred text-center card-cover-blurred">
                           <span class="avatar avatar-xl avatar-rounded"
                                 style="background-image: url({{ data_get($user,'avatarUrl') }})"></span>
                </div>
                <div class="card-body text-center">
                    <div class="card-title mb-1">{{ $user->name }}</div>
                    <div class="text-muted">
                        <i class="ti ti-calendar-time" style="font-size: 14px;"></i>
                        加入于<strong>{{ Str::limit($user->created_at,10,'') }}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-green text-white avatar">
                                 <i class="ti ti-trophy" style="font-size: 24px;"></i>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">{{ $user->role->name }}
                                <small class="text-muted">{{ $user->role_expired_at ?? '无限制'}}</small>
                            </div>
                            <div class="text-muted">用户等级
                                <a href="#" class="btn btn-sm btn-outline-primary float-end">升级</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-blue text-white avatar">
                                 <i class="ti ti-coin" style="font-size: 24px;"></i>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">{{ $user->coins }} 个</div>
                            <div class="text-muted">我的金币
                                <a href="{{ route('users.wallet.coin') }}"
                                   class="btn btn-sm btn-outline-primary float-end">充值</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-red text-white avatar">
                                <i class="ti ti-link" style="font-size: 24px;"></i>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">{{ $user->coins }} 人</div>
                            <div class="text-muted">
                                我的邀请
                                <a href="#" class="btn btn-sm btn-outline-secondary float-end">邀请</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-yellow text-white avatar">
                                <i class="ti ti-shopping-cart" style="font-size: 24px;"></i>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">{{ $user->coins }} 个</div>
                            <div class="text-muted">我的购买</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <ul class="nav nav-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#basic-setting" class="nav-link active" data-bs-toggle="tab">基本设置</a>
                            </li>
                            <li class="nav-item">
                                <a href="#password-setting" class="nav-link" data-bs-toggle="tab">密码设置</a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="basic-setting">
                                    <form method="post" action="{{ route('users.update') }}">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="form-label">邮箱</label>
                                            <div>
                                                @if($user->email_verified_at)
                                                    <input name="email" title="email" type="email" class="form-control"
                                                           readonly
                                                           value="{{old('email',$user->email)}}"
                                                           placeholder="电子邮箱">
                                                @else
                                                    <div class="input-group">
                                                        <input name="email" title="email" type="email"
                                                               class="form-control"
                                                               value="{{old('email',$user->email)}}"
                                                               placeholder="电子邮箱">
                                                        <button class="btn btn-primary" type="button">立即验证</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">昵称</label>
                                            <div>
                                                <input name="name" title="name" type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       value="{{ old('name',$user->name) }}"
                                                       placeholder="昵称">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">性别</label>
                                            @include('cms::components.select',[
    'class'=>'form-select',
    'name'=>'sex',
    'selected'=>old('sex',$user->sex),
    'options'=>[['val'=>-1,'txt'=>'保密'],['val'=>0,'txt'=>'美女'],['val'=>1,'txt'=>'帅哥'],]
    ])
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">手机</label>
                                            <div>
                                                <input name="phone" title="phone" type="number"
                                                       class="form-control @error('phone') is-invalid @enderror"
                                                       maxlength="11"
                                                       value="{{ old('phone',$user->phone) }}"
                                                       placeholder="手机号">
                                                <div class="invalid-feedback">请输入正确的11位手机号</div>
                                            </div>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-primary">保存</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="password-setting">
                                    <form method="post" action="{{ route('users.password') }}">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="form-label">旧密码</label>
                                            <div>
                                                <input name="old_password" title="old_password" type="password"
                                                       class="form-control @error('old_password') is-invalid @enderror"
                                                       placeholder="旧密码" value="{{ old('old_password') }}">
                                                <div class="invalid-feedback">请输入正确旧密码</div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">新密码</label>
                                            <div>
                                                <input name="password" title="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       placeholder="8-20位新密码">
                                                <div class="invalid-feedback">请输入8-20位新密码</div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">重复新密码</label>
                                            <div>
                                                <input name="password_confirmation" title="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       placeholder="重复新密码">
                                                <div class="invalid-feedback">请再次输入新密码</div>
                                            </div>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-primary">保存</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
    </script>
@endsection
