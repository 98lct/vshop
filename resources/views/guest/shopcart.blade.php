@extends('layouts.guest')
@section('title',' Giỏ Hàng')
@section('main')
<script type="text/javascript">
    function UpdateCart(qty,rowId)
    {
        $.get(
            '{{asset('cart/update')}}',
            {qty:qty,rowId:rowId},
            function(){
                location.reload();
            });
    }
    $('document').ready(function(){
        $('.error').hide();
        $('.address_home').hide();
        $('.address').hide();
        
        
        $('.btn-thanhtoan').click(function(){
            $('.error').html('');
            var name=$('input[name="name"]').val();
            var phone=$('input[name="phone"]').val();
            var method=$('input[name="method"]').val();
            var discount=$('#discount').val();
            var address=$('textarea[name="address"]').val();
            var email=$('input[name="email"]').val();
            var note=$('textarea[name="note"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $.ajax({
                url:"{{route('checkout')}}",
                method:'POST',
                data: {
                    name:name,phone:phone,address:address,email:email,discount:discount,method:method,note:note
                },
                success:function(data){  
                    $('.error').html('');
                    $('.error').show();
                    if(data.errors==true || data.makm==true){
                        if (data.message.name != undefined) {
                            $('.name').html(data.message.name[0]);
                        }
                        if (data.message.phone != undefined) {
                            $('.phone').html(data.message.phone[0]);
                        }
                        if (data.message.address != undefined) {
                            $('.diachi').html(data.message.address[0]);
                        }
                        if (data.message.email != undefined) {
                            $('.email').html(data.message.email[0]);
                        }
                        if(data.message.makm !=undefined){
                            $('.discount').html(data.message.makm);
                        }
                    }
                    
                    else{
                        window.location='/';
                        
                    }

                },
                

            });
        });
        
    });



</script>
<section class="block">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Trang Chủ</a></li>
                <li class="active">/Giỏ Hàng</li>
            </ol>
        </div>
        @if(count($cart))
        <table class="table table-bordered table-striped table-cart">
            <thead class="thead-dark">
                <tr class="cart_menu">
                    <td>Hình</td>
                    <td>Tên Sản Phẩm</td>
                    <td>Giá</td>
                    <td>Số Lượng</td>
                    <td>
                        Tổng Cộng <br>
                        <strong class="text-danger">{{Cart::total()}}</strong>
                    </td>
                    <td><a class="btn btn-danger btn-sm" href="{{route('DestroyCart')}}">Xóa Tất Cả</a></td>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                <tr>
                    <td class="cart_product">
                        <img src="{{asset('upload/product/'.$item->options->img)}}" height="50px" alt="{{$item->options->img}}">
                        <!--$item->options->all()['img'])-->
                    </td>
                    <td >
                        <h4><a href="">{{ $item->name }}</a></h4>
                        <p>ID: {{ $item->id }}</p>
                    </td>
                    <td >
                        <p>{{ number_format($item->price)}} VNĐ</p>
                    </td>
                    <td >
                        <div class=" form-inline">
                            <input class=" form-control form-inline" type="number" name="qty" value="{{$item->qty}}" onchange="UpdateCart(this.value,'{{$item->rowId}}')">
                        </div>
                    </td>
                    <td >
                        <p >{{ number_format($item->subtotal)}} VNĐ</p>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{route('RemoveCart',$item->rowId)}}"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
                @else
                <p>Giỏ Hàng Đang Trống</p>
                @endif
            </tbody>
        </table>
        @if(Auth::check())
        @if(count($cart)>0)<a href="{{route('index.checkout')}}" class="btn btn-sm btn-success" id="btn-thanhtoan">Thanh Toán</a>@endif
        @else
        @if(count($cart)>0)<p>Đăng Nhập Tại <a class="btn btn-link" href="{{route('login')}}">Đây</a> Để Thanh Toán</p>@endif
        @endif
       
    </div>





</section> <!--/#cart_items-->
<style>
    .error{
        color: red;
        margin: 5px 0;
        font-style: italic;
    }
</style>
@endsection
@extends('layouts.guest')
@section('title',' Giỏ Hàng')
@section('main')
<script type="text/javascript">
    function UpdateCart(qty,rowId)
    {
        $.get(
            '{{asset('cart/update')}}',
            {qty:qty,rowId:rowId},
            function(){
                location.reload();
            });
    }
    $('document').ready(function(){
        $('.error').hide();
        //$('.address_home').hide();
       // $('.address').hide();
        //$('#form-thanhtoan').hide();
        // $('#btn-thanhtoan').click(function(){
        //     $(this).hide(500);
        //     $('#form-thanhtoan').show(500);
        //     $('.table-cart').hide(500);
        // });
        // $("#form-thanhtoan #home").click(function(){
        //     $('.address').show(500);$('.address_home').hide();
        // });
        // $("#form-thanhtoan #store").click(function(){
        //     $('.address_home').show(500);
        //     $('.address').hide(500);
        // });

        $('.btn-thanhtoan').click(function(){
            $('.error').html('');
            var name=$('input[name="name"]').val();
            var phone=$('input[name="phone"]').val();
            var method=$('input[name="method"]').val();
            var discount=$('#discount').val();
            var address=$('textarea[name="address"]').val();
            var email=$('input[name="email"]').val();
            var note=$('textarea[name="note"]').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $.ajax({
                url:"{{route('checkout')}}",
                method:'POST',
                data: {
                    name:name,phone:phone,address:address,email:email,discount:discount,method:method,note:note
                },
                success:function(data){
                    $('.error').html('');
                    $('.error').show();
                    if(data.errors==true || data.makm==true){
                        if (data.message.name != undefined) {
                            $('.name').html(data.message.name[0]);
                        }
                        if (data.message.phone != undefined) {
                            $('.phone').html(data.message.phone[0]);
                        }
                        if (data.message.address != undefined) {
                            $('.diachi').html(data.message.address[0]);
                        }
                        if (data.message.email != undefined) {
                            $('.email').html(data.message.email[0]);
                        }
                        if(data.message.makm !=undefined){
                            $('.discount').html(data.message.makm);
                        }
                    }

                    else{
                        window.location='/';

                    }

                },


            });
        });
        // $('#discount').change(function(){

        // $('.discount').html('');
        // var discount=$('#discount').val();
        //     //alert(discount);
        //     $.ajaxSetup({
        //           headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url:"{{route('checkout')}}",
        //         method:'POST',
        //         data: {
        //             discount:discount,
        //         },
        //         success:function(data){
        //             if(data.error==true){
        //              $('.discount').show();
        //              $('.discount').html(data.result);
        //          }
        //         //    if(data.error==false){
        //         //     $('.discount').css('color','green');
        //         //     $('.discount').html(data.message);
        //         // }

        //     }
        // });
        // });
    });



</script>
<section class="block">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Trang Chủ</a></li>
                <li class="active">/Giỏ Hàng</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-8">
                @if(count($cart))
                <table class="table table-bordered table-striped table-cart">
                    <thead class="thead-dark">
                        <tr class="cart_menu">
                            <td>Hình</td>
                            <td>Tên Sản Phẩm</td>
                            <td>Giá</td>
                            <td>Số Lượng</td>
                            <td>
                                Tổng Cộng <br>
                                <strong class="text-danger">{{Cart::total()}}</strong>
                            </td>
                            <td><a class="btn btn-danger btn-sm" href="{{route('DestroyCart')}}">Xóa Tất Cả</a></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                        <tr>
                            <td class="cart_product">
                                <img src="{{asset('upload/product/'.$item->options->img)}}" height="50px" alt="{{$item->options->img}}">
                                <!--$item->options->all()['img'])-->
                            </td>
                            <td >
                                <h4><a href="">{{ $item->name }}</a></h4>
                                <p>ID: {{ $item->id }}</p>
                            </td>
                            <td >
                                <p>{{ number_format($item->price)}} VNĐ</p>
                            </td>
                            <td >
                                <div class=" form-inline">
                                    <input class=" form-control form-inline" type="number" name="qty" value="{{$item->qty}}" onchange="UpdateCart(this.value,'{{$item->rowId}}')">
                                </div>
                            </td>
                            <td >
                                <p >{{ number_format($item->subtotal)}} VNĐ</p>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{route('RemoveCart',$item->rowId)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p>Giỏ Hàng Đang Trống</p>
                        @endif
                    </tbody>
                </table>
                @if(Auth::check())
                @if(count($cart)>0)<button class="btn btn-sm btn-success" id="btn-thanhtoan">Thanh Toán</button>@endif
                @else
                @if(count($cart)>0)<p>Đăng Nhập Tại <a class="btn btn-link" href="{{route('login')}}">Đây</a> Để Thanh Toán</p>@endif
                @endif
            </div>
            <div class="col-md-4">
                <form id="" method="POST" action="">
                    @csrf
                    <center><h3>Tiếp Hành Thanh Toán</h3><sup>Vui Lòng Điền Đầy Đủ Thông Tin</sup></center>
                    <div class="alert alert-danger" style="display:none">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Họ Tên Người Nhận</label>
                        <input type="text" class="form-control" name="name"  placeholder="Nhập Tên Người Nhận">
                        <p class="error name"></p>

                    </div>
                    <div class="form-group">
                        <label>Số Điện Thoại</label>
                        <input type="number" class="form-control" name="phone"  placeholder="Nhập Số ĐT Người Nhận">
                        <p class="error phone"></p>

                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email"  placeholder="Nhập Email Người Nhận">
                        <p class="error email"></p>

                    </div>

                    <div class="form-group form-inline">
                        <label>Hình Thức Nhận Hàng</label>
                        <div class="p-2">
                            <input type="radio" id="store" class="form-control"  name="method" value="store">Cửa Hàng
                            <input type="radio" id="home" class="form-control"  name="method" value="home">Tại Nhà
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Bạn có mã giảm giá</label>
                        <input type="text" class="form-control" id="discount" name="discount"  placeholder="Nhập Mã Giảm Giá">
                        <p class="error discount"></p>
                    </div>
                    <div class="form-group address">
                        <label>Địa Chỉ Nhận Hàng</label>
                        <textarea name="address" class="form-control"></textarea>
                        <p class="error diachi"></p>

                    </div>
                    <div class="form-group address_home">
                        <label for="">Địa Chỉ Của Hàng</label>
                        <select name="address" id="address" class="form-control">
                            <option value="Trần Quang Khải,Q1,HCMC">123,Trần Quang Khải,Q1,HCMC</option>
                            <option value="29 Thảo Điền,Q2,HCMC">29 Thảo Điền,Q2,HCMC</option>
                            <option value="19 Lê Văn Việt,Q9,HCMC">19 Lê Văn Việt ,Q9,HCMC</option>
                            <option value="192 Võ Văn Ngân ,Q Thủ Đức,HCMC">192 Võ Văn Ngân ,Q Thủ Đức,HCMC</option>
                        </select>
                    </div>
                    <input type="hidden" name="code">
                    <div class="form-group">
                        <label>Ghi Chú</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-thanhtoan">Thanh Toán</button>
                    </div>

                </form>
            </div>
        </div>





    </div>
</section> <!--/#cart_items-->
<style>
    .error{
        color: red;
        margin: 5px 0;
        font-style: italic;
    }
</style>
@endsection
@extends('layouts.guest')
@section('title',' Giỏ Hàng')
@section('main')
<script type="text/javascript">
    function UpdateCart(qty,rowId)
    {
        $.get(
            '{{asset('cart/update')}}',
            {qty:qty,rowId:rowId},
            function(){
                location.reload();
            });
    }
    $('document').ready(function(){
        $('.error').hide();
        $('.address_home').hide();
        $('.address').hide();
        $('#form-thanhtoan').hide();
        $('#btn-thanhtoan').click(function(){
            $(this).hide(500);
            $('#form-thanhtoan').show(500);
            $('.table-cart').hide(500);
        });
        $("#form-thanhtoan #home").click(function(){
            $('.address').show(500);$('.address_home').hide();
        });
        $("#form-thanhtoan #store").click(function(){
            $('.address_home').show(500);
            $('.address').hide(500);
        });

        $('.btn-thanhtoan').click(function(){
            $('.error').html('');
            var name=$('input[name="name"]').val();
            var phone=$('input[name="phone"]').val();
            var method=$('input[name="method"]').val();
            var discount=$('#discount').val();
            var address=$('textarea[name="address"]').val();
            var email=$('input[name="email"]').val();
            var note=$('textarea[name="note"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $.ajax({
                url:"{{route('checkout')}}",
                method:'POST',
                data: {
                    name:name,phone:phone,address:address,email:email,discount:discount,method:method,note:note
                },
                success:function(data){
                    $('.error').html('');
                    $('.error').show();
                    if(data.errors==true || data.makm==true){
                        if (data.message.name != undefined) {
                            $('.name').html(data.message.name[0]);
                        }
                        if (data.message.phone != undefined) {
                            $('.phone').html(data.message.phone[0]);
                        }
                        if (data.message.address != undefined) {
                            $('.diachi').html(data.message.address[0]);
                        }
                        if (data.message.email != undefined) {
                            $('.email').html(data.message.email[0]);
                        }
                        if(data.message.makm !=undefined){
                            $('.discount').html(data.message.makm);
                        }
                    }

                    else{
                        window.location='/';

                    }

                },


            });
        });
        // $('#discount').change(function(){

        // $('.discount').html('');
        // var discount=$('#discount').val();
        //     //alert(discount);
        //     $.ajaxSetup({
        //           headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url:"{{route('checkout')}}",
        //         method:'POST',
        //         data: {
        //             discount:discount,
        //         },
        //         success:function(data){
        //             if(data.error==true){
        //              $('.discount').show();
        //              $('.discount').html(data.result);
        //          }
        //         //    if(data.error==false){
        //         //     $('.discount').css('color','green');
        //         //     $('.discount').html(data.message);
        //         // }

        //     }
        // });
        // });
    });



</script>
<section class="block">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Trang Chủ</a></li>
                <li class="active">/Giỏ Hàng</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-8">
                @if(count($cart))
                <table class="table table-bordered table-striped table-cart">
                    <thead class="thead-dark">
                        <tr class="cart_menu">
                            <td>Hình</td>
                            <td>Tên Sản Phẩm</td>
                            <td>Giá</td>
                            <td>Số Lượng</td>
                            <td>
                                Tổng Cộng <br>
                                <strong class="text-danger">{{Cart::total()}}</strong>
                            </td>
                            <td><a class="btn btn-danger btn-sm" href="{{route('DestroyCart')}}">Xóa Tất Cả</a></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                        <tr>
                            <td class="cart_product">
                                <img src="{{asset('upload/product/'.$item->options->img)}}" height="50px" alt="{{$item->options->img}}">
                                <!--$item->options->all()['img'])-->
                            </td>
                            <td >
                                <h4><a href="">{{ $item->name }}</a></h4>
                                <p>ID: {{ $item->id }}</p>
                            </td>
                            <td >
                                <p>{{ number_format($item->price)}} VNĐ</p>
                            </td>
                            <td >
                                <div class=" form-inline">
                                    <input class=" form-control form-inline" type="number" name="qty" value="{{$item->qty}}" onchange="UpdateCart(this.value,'{{$item->rowId}}')">
                                </div>
                            </td>
                            <td >
                                <p >{{ number_format($item->subtotal)}} VNĐ</p>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{route('RemoveCart',$item->rowId)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p>Giỏ Hàng Đang Trống</p>
                        @endif
                    </tbody>
                </table>
                @if(Auth::check())
                @if(count($cart)>0)<button class="btn btn-sm btn-success" id="btn-thanhtoan">Thanh Toán</button>@endif
                @else
                @if(count($cart)>0)<p>Đăng Nhập Tại <a class="btn btn-link" href="{{route('login')}}">Đây</a> Để Thanh Toán</p>@endif
                @endif
            </div>
            <div class="col-md-4">
                <form id="form-thanhtoan" method="POST" action="">
                    @csrf
                    <center><h3>Tiếp Hành Thanh Toán</h3><sup>Vui Lòng Điền Đầy Đủ Thông Tin</sup></center>
                    <div class="alert alert-danger" style="display:none">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Họ Tên Người Nhận</label>
                        <input type="text" class="form-control" name="name"  placeholder="Nhập Tên Người Nhận">
                        <p class="error name"></p>

                    </div>
                    <div class="form-group">
                        <label>Số Điện Thoại</label>
                        <input type="number" class="form-control" name="phone"  placeholder="Nhập Số ĐT Người Nhận">
                        <p class="error phone"></p>

                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email"  placeholder="Nhập Email Người Nhận">
                        <p class="error email"></p>

                    </div>

                    <div class="form-group form-inline">
                        <label>Hình Thức Nhận Hàng</label>
                        <div class="p-2">
                            <input type="radio" id="store" class="form-control"  name="method" value="store">Cửa Hàng
                            <input type="radio" id="home" class="form-control"  name="method" value="home">Tại Nhà
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Bạn có mã giảm giá</label>
                        <input type="text" class="form-control" id="discount" name="discount"  placeholder="Nhập Mã Giảm Giá">
                        <p class="error discount"></p>
                    </div>
                    <div class="form-group address">
                        <label>Địa Chỉ Nhận Hàng</label>
                        <textarea name="address" class="form-control"></textarea>
                        <p class="error diachi"></p>

                    </div>
                    <div class="form-group address_home">
                        <label for="">Địa Chỉ Của Hàng</label>
                        <select name="address" id="address" class="form-control">
                            <option value="Trần Quang Khải,Q1,HCMC">123,Trần Quang Khải,Q1,HCMC</option>
                            <option value="29 Thảo Điền,Q2,HCMC">29 Thảo Điền,Q2,HCMC</option>
                            <option value="19 Lê Văn Việt,Q9,HCMC">19 Lê Văn Việt ,Q9,HCMC</option>
                            <option value="192 Võ Văn Ngân ,Q Thủ Đức,HCMC">192 Võ Văn Ngân ,Q Thủ Đức,HCMC</option>
                        </select>
                    </div>
                    <input type="hidden" name="code">
                    <div class="form-group">
                        <label>Ghi Chú</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-thanhtoan">Thanh Toán</button>
                    </div>

                </form>
            </div>
        </div>





    </div>
</section> <!--/#cart_items-->
<style>
    .error{
        color: red;
        margin: 5px 0;
        font-style: italic;
    }
</style>
@endsection
@extends('layouts.guest')
@section('title',' Giỏ Hàng')
@section('main')
<script type="text/javascript">
    function UpdateCart(qty,rowId)
    {
        $.get(
            '{{asset('cart/update')}}',
            {qty:qty,rowId:rowId},
            function(){
                location.reload();
            });
    }
    $('document').ready(function(){
        $('.error').hide();
        

        $('.btn-thanhtoan').click(function(){
            $('.error').html('');
            var name=$('input[name="name"]').val();
            var phone=$('input[name="phone"]').val();
            var method=$('input[name="method"]').val();
            var discount=$('#discount').val();
            var address=$('textarea[name="address"]').val();
            var email=$('input[name="email"]').val();
            var note=$('textarea[name="note"]').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $.ajax({
                url:"{{route('checkout')}}",
                method:'POST',
                data: {
                    name:name,phone:phone,address:address,email:email,discount:discount,method:method,note:note
                },
                success:function(data){
                    $('.error').html('');
                    $('.error').show();
                    if(data.errors==true || data.makm==true){
                        if (data.message.name != undefined) {
                            $('.name').html(data.message.name[0]);
                        }
                        if (data.message.phone != undefined) {
                            $('.phone').html(data.message.phone[0]);
                        }
                        if (data.message.address != undefined) {
                            $('.diachi').html(data.message.address[0]);
                        }
                        if (data.message.email != undefined) {
                            $('.email').html(data.message.email[0]);
                        }
                        if(data.message.makm !=undefined){
                            $('.discount').html(data.message.makm);
                        }
                    }

                    else{
                        window.location='/';

                    }

                },


            });
        });
        // $('#discount').change(function(){

        // $('.discount').html('');
        // var discount=$('#discount').val();
        //     //alert(discount);
        //     $.ajaxSetup({
        //           headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url:"{{route('checkout')}}",
        //         method:'POST',
        //         data: {
        //             discount:discount,
        //         },
        //         success:function(data){
        //             if(data.error==true){
        //              $('.discount').show();
        //              $('.discount').html(data.result);
        //          }
        //         //    if(data.error==false){
        //         //     $('.discount').css('color','green');
        //         //     $('.discount').html(data.message);
        //         // }

        //     }
        // });
        // });
    });



</script>
<section class="block">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Trang Chủ</a></li>
                <li class="active">/Giỏ Hàng</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-8">
                @if(count($cart))
                <table class="table table-bordered table-striped table-cart">
                    <thead class="thead-dark">
                        <tr class="cart_menu">
                            <td>Hình</td>
                            <td>Tên Sản Phẩm</td>
                            <td>Giá</td>
                            <td>Số Lượng</td>
                            <td>
                                Tổng Cộng <br>
                                <strong class="text-danger">{{Cart::total()}}</strong>
                            </td>
                            <td><a class="btn btn-danger btn-sm" href="{{route('DestroyCart')}}">Xóa Tất Cả</a></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                        <tr>
                            <td class="cart_product">
                                <img src="{{asset('upload/product/'.$item->options->img)}}" height="50px" alt="{{$item->options->img}}">
                            </td>
                            <td >
                                <h4><a href="">{{ $item->name }}</a></h4>
                                <p>ID: {{ $item->id }}</p>
                            </td>
                            <td >
                                <p>{{ number_format($item->price)}} VNĐ</p>
                            </td>
                            <td >
                                <div class=" form-inline">
                                    <input class=" form-control form-inline" type="number" name="qty" value="{{$item->qty}}" onchange="UpdateCart(this.value,'{{$item->rowId}}')">
                                </div>
                            </td>
                            <td >
                                <p >{{ number_format($item->subtotal)}} VNĐ</p>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{route('RemoveCart',$item->rowId)}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p>Giỏ Hàng Đang Trống</p>
                        @endif
                    </tbody>
                </table>
                @if(Auth::check())
                @if(count($cart)>0)<button class="btn btn-sm btn-success" id="btn-thanhtoan">Thanh Toán</button>@endif
                @else
                @if(count($cart)>0)<p>Đăng Nhập Tại <a class="btn btn-link" href="{{route('login')}}">Đây</a> Để Thanh Toán</p>@endif
                @endif
            </div>
            <div class="col-md-4">
                <form id="" method="POST" action="">
                    @csrf
                    <center><h3>Tiếp Hành Thanh Toán</h3><sup>Vui Lòng Điền Đầy Đủ Thông Tin</sup></center>
                    <div class="alert alert-danger" style="display:none">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Họ Tên Người Nhận</label>
                        <input type="text" class="form-control" name="name"  placeholder="Nhập Tên Người Nhận">
                        <p class="error name"></p>

                    </div>
                    <div class="form-group">
                        <label>Số Điện Thoại</label>
                        <input type="number" class="form-control" name="phone"  placeholder="Nhập Số ĐT Người Nhận">
                        <p class="error phone"></p>

                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email"  placeholder="Nhập Email Người Nhận">
                        <p class="error email"></p>

                    </div>

                    <div class="form-group form-inline">
                        <label>Hình Thức Nhận Hàng</label>
                        <div class="p-2">
                            <input type="radio" id="store" class="form-control"  name="method" value="store">Cửa Hàng
                            <input type="radio" id="home" class="form-control"  name="method" value="home">Tại Nhà
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Bạn có mã giảm giá</label>
                        <input type="text" class="form-control" id="discount" name="discount"  placeholder="Nhập Mã Giảm Giá">
                        <p class="error discount"></p>
                    </div>
                    <div class="form-group address">
                        <label>Địa Chỉ Nhận Hàng</label>
                        <textarea name="address" class="form-control"></textarea>
                        <p class="error diachi"></p>

                    </div>
                    <div class="form-group address_home">
                        <label for="">Địa Chỉ Của Hàng</label>
                        <select name="address" id="address" class="form-control">
                            <option value="Trần Quang Khải,Q1,HCMC">123,Trần Quang Khải,Q1,HCMC</option>
                            <option value="29 Thảo Điền,Q2,HCMC">29 Thảo Điền,Q2,HCMC</option>
                            <option value="19 Lê Văn Việt,Q9,HCMC">19 Lê Văn Việt ,Q9,HCMC</option>
                            <option value="192 Võ Văn Ngân ,Q Thủ Đức,HCMC">192 Võ Văn Ngân ,Q Thủ Đức,HCMC</option>
                        </select>
                    </div>
                    <input type="hidden" name="code">
                    <div class="form-group">
                        <label>Ghi Chú</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-thanhtoan">Thanh Toán</button>
                    </div>

                </form>
            </div>
        </div>





    </div>
</section> <!--/#cart_items-->
<style>
    .error{
        color: red;
        margin: 5px 0;
        font-style: italic;
    }
</style>
@endsection
