@extends('layouts.admin')
@section('title','Order')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h3>Order Detail</h3>
        @include('errors.message')
    </section>
    <section class="content">
        <div class="box-body">

            <h4>Mã Đơn Hàng: <strong><i>{{$info->code}}</i></strong></h4>
            <h4>Tên Người Nhận: <strong><i>{{$info->fullname}}</i></strong></h4>
            <h4>Email: <strong><i>{{$info->email}}</i></strong></h4>
            <h4>Điện Thoại: <strong><i>{{$info->phone}}</i></strong></h4>
            <h4>Hình Thức Nhận Hàng: <strong><i>{{$info->method}}</i></strong></h4>
            <h4>Địa Chỉ Nhận Hàng: <strong><i>{{$info->address}}</i></strong></h4>
            <h4>Ghi Chú: <strong><i>{{$info->note}}</i></strong></h4>
            <h4>Ngày Mua: <strong><i>{{$info->created_at}}</i></strong></h4>
            <div>
                <p>Chi Tiết Đơn Hàng:</p>
                <table class="table table-bordered table-stripe">
                    <thead class="table-dark">
                        <th>#STT</th>
                        <th>Tên SP</th>
                        <th>Giá Sp</th>
                        <th>Số Lượng</th>
                        <th>Số Tiền</th>
                    </thead>
                    <tbody>
                        @php $i=1; $sum=0;$tong=0;  @endphp
                        @foreach($detail as $value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{number_format($value->price)}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>@php $sum =$value->price * $value->quantity; $tong+=$sum @endphp {{number_format($sum)}}</td>
                            @php $giamgia =$value->discount@endphp
                             @php $phivanchuyen =$value->transport_cost@endphp
                        </tr>

                        @endforeach
                        
                        <tr>
                            <td>{{'Tổng Tiền'}}</td>
                            <td colspan="4" align="right" class="text-danger"><strong>{{number_format($tong) . ' VNĐ'}}</strong></td>
                        </tr>
                        <tr>
                            <td>{{'Phí Vận Chuyển'}}</td>
                            <td colspan="4" align="right" class="text-danger"><strong>{{number_format($phivanchuyen) . ' VNĐ'}}</strong></td>
                        </tr>
                        <tr>
                            <td>{{'Giảm Giá'}}</td>
                            <td colspan="4" align="right" class="text-danger"><strong>{{number_format($giamgia) . ' VNĐ'}}</strong></td>
                        </tr>
                        <tr>
                            <td>{{'Thành Tiền'}}</td>
                            <td colspan="4" align="right" class="text-danger"><strong>{{number_format($tong-$giamgia+$phivanchuyen) . ' VNĐ'}}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <form action="{{route('StatusOrder',$info->order_id)}}" method="post" name="status_order_form"> @csrf
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" @if($info->status == 0) checked @endif name="status" id="status" value="0" onchange="status_order_form.submit()" >
                        Chưa Xử Lý
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" @if($info->status == 1) checked @endif name="status" id="status" value="1" onchange="status_order_form.submit()" >
                        Đang Xử Lý
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" @if($info->status == 2) checked @endif name="status" id="status" value="2" onchange="status_order_form.submit()" >
                        Đã Xử Lý
                        </label>
                    </div>
                    <a href="{{route('export',$info->order_id)}}" title="" class="btn btn-primary">Xuất Hóa Đơn</a>
                    <a href="{{route('PDF',$info->order_id)}}" title="" class="btn btn-primary">In Hóa Đơn</a>
                </form>

            </div>
        </div>
    </section>
</div>
@endsection
