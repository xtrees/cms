@extends('cms::user.layout')
@section('title','个人中心')
@section('page-header')
    <div class="col">
        <div class="page-pretitle">My Orders</div>
        <h2 class="page-title">
            我的订单
        </h2>
    </div>
@endsection

@section('page-body')
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">我的订单</h3>
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
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
