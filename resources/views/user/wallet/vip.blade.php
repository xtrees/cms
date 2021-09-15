@extends('cms::user.layout')
@section('title','个人中心')
@section('page-header')
    <div class="col">
        <div class="page-pretitle">Recharge Center</div>
        <h2 class="page-title">
            会员充值
        </h2>
    </div>
@endsection

@section('page-body')
    <div class="row">
        @foreach($offers as $offer)
            <div class="col-sm-6 col-lg-3">
                <div class="card card-md mt-3">
                    <div class="card-body text-center">
                        <div class="text-uppercase text-muted font-weight-medium">{{ $offer->duration }}天</div>
                        <div class="display-5 my-3">￥{{ $offer->price }}</div>
                        <div>
                            {{ $offer->title }}
                        </div>
                        <div class="text-center mt-4">
                            <button type="button" class="btn w-100 recharge" data-id="{{ $offer->id }}">立即充值</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <form id="create-order" method="post" action="{{ route('users.wallet.order') }}">
            @csrf
            <input id="oid" type="hidden" name="offer">
        </form>
    </div>

@endsection

@section('script')
@endsection
