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
                            <th>NO.编号</th>
                            <th>类型</th>
                            <th>金币数量</th>
                            <th>内容</th>
                            <th>发生时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $trans)
                            <tr>
                                <td><span class="text-muted">{{ $trans->id }}</span></td>
                                <td>{{ $trans->type }}</td>
                                <td>{{ $trans->amount }}</td>
                                <td>{{$trans->created_at}}</td>
                                <td class="text-end">
                                    <a href="#">详情</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $transactions->links() !!}
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
