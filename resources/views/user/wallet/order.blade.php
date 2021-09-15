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
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">我的订单</h3>
                </div>
                <div class="card-table table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th>NO.编号</th>
                            <th>类型</th>
                            <th>金币数量</th>
                            <th>购买内容</th>
                            <th>发生时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><span class="text-muted">{{ $tr->id }}</span></td>
                                <td>{{ $tr->type }}</td>
                                <td>{{ $tr->amount }}</td>
                                <td>87956621</td>
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

@endsection
