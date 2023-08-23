@extends('layouts.admin')
@section('title','Order')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h3>Order</h3>
        @include('errors.errors')
        @include('errors.message')
    </section>
    <section class="content">
        <div class="box-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th width="5px">STT</th>
                    <th width="150px">Mã Đơn Hàng</th>
                    <th>Tên Người Nhận</th>
                    <th >Ngày Tạo</th>
                    <th>Trạng Thái</th>
                    <th>Chi Tiết</th>
                    <th width="100px">Hủy</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1 @endphp
                @foreach($orders as $order)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{str_limit($order->code,'35')}}</td>
                    <td>{{$order->fullname}}</td>
                    <td>{{$order->created_at}}</td>
                    <td align="center">
                        @if ($order->status==0)
                        <label class="badge badge-primary p-2">Chưa Xử Lý</label>
                        @endif
                        @if ($order->status==1)
                        <label class="badge badge-warning p-2">Đang Xử Lý</label>
                        @endif
                        @if($order->status==2)
                        <label class="badge badge-success p-2">Đã Xử Lý</label>
                        @endif
                    </td>
                    <td>
                        <a href="{{url('admin/order/detail/'.$order->id)}}" class="btn btn-primary btn-sm" >Chi Tiết</a>
                        
                    </td>
                    <td><form action="{{route('DeleteOrder',$order->id)}}" method="post">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hủy Đơn Hàng</button>
                        </form></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
