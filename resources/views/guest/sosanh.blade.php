@extends('layouts.guest')
@section('title','So Sánh ')
@section('main')
<div class="container product-page block">
    <div class="row">
        <a class="btn btn-outline-info" href="{{session('detail_url')}}">Về Trang Trước</a>
        

        <table class="table table-striped table-bordered table-responsive">
            <tr>
                <td colspan="3"><h3 class="text-primary text-center">So sánh Sản Phẩm</h3></td>
            </tr>
            <tr>
                <td scope="col">Tên Sản Phẩm</td>
                <td scope="col" >{{$product1->name}}</td>
                <td scope="col">{{$product2->name}}</td>
            </tr>
            <tr>
                <td>Hình ảnh</td>
                <td><img src="{{asset('upload/product/'.$product1->img)}}" height="400px" alt=""></td>
                <td><img src="{{asset('upload/product/'.$product2->img)}}" height="400px" alt=""></td>
            </tr>
            <tr>
                <td>Màn hình</td>
                <td>{{$product1->screen}},{{$product1->resolution}}</td>
                <td>{{$product2->screen}},{{$product2->resolution}}</td>
            </tr>
            <tr>
                <td>Hệ điều hành</td>
                <td>{{$product1->operating}}</td>
                <td>{{$product2->operating}}</td>
            </tr>
            <tr>
                <td>Camera Trước</td>
                <td>{{$product1->camera.'px'}}</td>
                <td>{{$product2->camera.'px'}}</td>
            </tr>
            <tr>
                <td>Camera Sau</td>
                <td>{{$product1->camera_primary.'px'}}</td>
                <td>{{$product2->camera_primary.'px'}}</td>
            </tr>
            <tr>
                <td>Bộ xử lý</td>
                <td>{{$product1->chipset}}</td>
                <td>{{$product2->chipset}}</td>
            </tr>
            <tr>
                <td>Ram</td>
                <td>{{$product1->ram}}</td>
                <td>{{$product2->ram}}</td>
            </tr>
            <tr>
                <td>Bộ nhớ</td>
                <td>{{$product1->rom}}</td>
                <td>{{$product2->rom}}</td>
            </tr>
            <tr>
                <td>Dung lượng pin</td>
                <td>{{$product1->battery. ' MaH'}}</td>
                <td>{{$product2->battery. ' MaH'}}</td>
            </tr>
            <tr>
                <td>Tính năng</td>
                <td>{{$product1->utilities}}</td>
                <td>{{$product2->utilities}}</td>
            </tr>
            <tr>
                <td>Thiết kế, kiểu dáng</td>
                <td>{{$product1->design}},{{$product1->material}}</td>
                <td>{{$product2->design}},{{$product2->material}}</td>

            </tr>
            <tr>
                <td>Thông tin camera</td>
                <td>{{$product1->camera_info}}</td>
                <td>{{$product2->camera_info}}</td>
            </tr>
            <tr>
                <td>Giá</td>
                <td>{{($product1->pricesale!=null)?$product1->pricesale :$product1->price}}</td>
                 <td>{{($product2->pricesale!=null)?$product2->pricesale :$product2->price}}</td>

            </tr>
            <tr>
                <td>Đặt Mua</td>
                <td><a class="btn btn-outline-primary text-center" href="{{route('AddCart',$product1->id)}}">Mua Ngay</a></td>
                <td><a class="btn btn-outline-primary text-center" href="{{route('AddCart',$product2->id)}}">Mua Ngay</a></td>
            </tr>
        </table>
    </div>
</div>

@endsection