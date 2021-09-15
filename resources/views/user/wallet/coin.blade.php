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
        @foreach($offers as $offer)
            <div class="col-sm-6 col-lg-3">
                <div class="card card-md mt-3">
                    <div class="card-body text-center">
                        <div class="text-uppercase text-muted font-weight-medium">{{ $offer->duration }}金币</div>
                        <div class="display-5 my-3">￥{{ $offer->price }}</div>
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
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">我的金币流水</h3>
                </div>
                <div class="card-table table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th>NO.</th>
                            <th>编号</th>
                            <th>产品</th>
                            <th>价格</th>
                            <th>金额</th>
                            <th>支付方式</th>
                            <th>创建时间</th>
                            <th>状态</th>
                            <th>支付时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td><span class="text-muted">{{ $oreder->id }}</span></td>
                            <td><a href="invoice.html" class="text-reset" tabindex="-1">{{ $order->no }}</a></td>
                            <td>{{ $order->offer->name }}</td>
                            <td>
                                {{ $order->price }}
                            </td>
                            <td>
                                87956621
                            </td>
                            <td>
                                15 Dec 2017
                            </td>
                            <td>
                                <span class="badge bg-success me-1"></span> Paid
                            </td>
                            <td>$887</td>
                            <td class="text-end"></td>
                            <td class="text-end"></td>
                        </tr>
                        @endforeach
                        @foreach($transactions as $tr)
                            <tr>
                                <td><span class="text-muted">{{ $tr->id }}</span></td>
                                <td>
                                    {{ $tr->type }}
                                </td>
                                <td>{{ $tr->amount }}</td>
                                <td>
                                    87956621
                                </td>
                                <td>{{$tr->created_at}}</td>
                                <td class="text-end"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.recharge').click(function () {
            $('#oid').val($(this).data('id'));
            $('#create-order').submit();
        });
    </script>
@endsection
