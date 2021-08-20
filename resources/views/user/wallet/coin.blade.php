@extends('cms::user.layout')
@section('title','个人中心')
@section('page-header')
    <div class="col">
        <div class="page-pretitle">Recharge Center</div>
        <h2 class="page-title">
            金币充值
        </h2>
    </div>
@endsection


@section('page-body')
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-md">
                <div class="card-body text-center">
                    <div class="text-uppercase text-muted font-weight-medium"></div>
                    <div class="display-5 my-3">{{ $ }}</div>
                    <div class="text-center mt-4">
                        <a href="#" class="btn w-100">Choose plan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
