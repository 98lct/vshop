@extends('layouts.guest')
@section('title',$slug)
@section('main')
@include('guest.shared.advets')
<style>
    .info-product{
        padding: 15px;
        background: #fff;
        margin-bottom: 20px;
        border: 1px solid #eee
    }
    .info-product li {
        display: table;
        width: 100%;
        padding: 5px 0;
        border-top: 0.05px solid #eee
    }
    .info-product li label{
        width: 100px;
        font-size: 14px;
        color: #616161;
        padding-right: 6px;
        display: table-cell;
        vertical-align: top;
    }
    .info-product li span{
        color: #3d3d3d;
        font-size: 14px;
        display: table-cell;
        vertical-align: top;
    }
</style>


<section class="container block">
    <ol class="breadcrumb bg-white"><!--asset với url là tương đương-->
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
        <li class="breadcrumb-item"><a href="loai-san-pham/">{{$product->category->name}}</a></li>
        <li class="breadcrumb-item"><a href="">{{$product->name}}</a></li>
    </ol>
    <h1 style="font-size: 24px;" class="float-left"> {{$product->name}}</h1>
    <div class="float-left ml-2" style="line-height: 24px">
        <i class="rating-text fa fa-star"></i>
        <i class="rating-text fa fa-star"></i>
        <i class="rating-text fa fa-star"></i>
        <i class="rating-text fa fa-star"></i>
        <i class="fa fa-star"></i>
    </div>
    <div class="clearfix"></div>
    <hr class="my-2">
    <div class="row">
        <div class="col-lg-9 col-12 col-sm-12 col-md-12">
            <div class="row">
                <div class="col-lg-7">
                    <img src="{{asset('upload/product/'.$product->img)}}" class="img-fluid" alt="{{$product->name}}" title="{{$product->name}}">
                </div>
                <div class="col-lg-5">
                    <h2 class="text-danger mb-3" style="font-size: 24px"><strong>{{number_format($product->pricesale)}}đ</strong> <span class="alert-primary">Giá Hấp Dẫn</span></h2>
                    <div class="color bg-black"></div><div class="color bg-danger"></div><div class="color bg-dark"></div><div class="color bg-primary"></div>
                    @if(!$product->pricesale)
                    <h1>{{$product->price}}</h1>
                    @endif
                    <p class="alert alert-success text-uppercase mt-2" style="line-height: 10px; font-weight: bold; border-radius: 3px"><i class="far fa-clock"></i>&emsp;nhận hàng trong 1h</p>
                    <div style="border:1px solid #ccc;border-radius: 6px" class="p-3 mb-3">
                        <p class="text-left text-uppercase" style="font-weight: 700; font-size: 15px">Thông Tin</p>
                        <span><i class="fas fa-check text-success"></i>&emsp;Đổi trả miễn phí trong vòng 30 ngày </span><br>
                        <span><i class="fas fa-check text-success"></i>&emsp;Giảm 5-10% giá mua phụ kiện</span><br>
                        <span><i class="fas fa-check text-success"></i>&emsp;Bảo hành chính hãng 12 tháng</span><br>
                        <span><i class="fas fa-check text-success"></i>&emsp;Trong hộp có: Sạc, Tai nghe, Sách hướng dẫn, Bút cảm ứng, Cáp, Cây lấy sim, Ốp lưng, Adapter chuyển USB</span>
                    </div>
                    <a href="{{route('AddCart',$product->id)}}" class="btn btn-block btn-orange text-white" style="font-weight: 600">Mua Ngay<br><i style="font-weight: 400; font-size:12px">Giao Hàng trong 1 Giờ, Nhận Hàng ở Siêu Thị</i></a>
                    <p class="my-2"><i >Gọi đặt mua: 1800.1060 </i></p>
                </div>
                <div class="col-lg-12 mb-2"><hr>
                    <h5><b><i>Đặt Điểm Nổi Bật Của </i></b></h5>
                    <article style="height: 900px; overflow: hidden"><!--in từ csdl có hình có chữ dùng như dưới-->
                        <p> {!! $product->detail !!} </p>
                    </article>
                    <p class="readmore text-center btn-link  my-2" style="cursor: pointer">Xem thêm <i class="fas fa-angle-down"></i></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-sm-none d-none d-md-none d-xl-block">
            <ul class="right-slidebar">
                <li><i class="fas fa-box-open"></i><span>Trong hợp có: Sạc, Cáp, Sách hướng dẫn, Que chọt sim,...</span></li>
                <li><i class="fab fa-app-store-ios"></i><span>Bảo hành chính hãng 12 tháng</span></li>
                <li><i class="fas fa-undo-alt"></i><span>1 đổi 1 trong vòng 30 ngày</span></li>
                <li><i class="fas fa-ambulance"></i><span>Vận chuyển trong 2h</span></li>
                <li style="border:none"><i class="fas fa-undo"></i><span>Đổi mới phụ kiện trong 1 năm</span></li>
            </ul>
            <ul class="info-product">
                <h5>Thông Số Kỷ Thuật</h5>
                @if($product->screen)
                <li>
                    <label>Màn Hình</label>
                    <span>{{$product->screen}},{{$product->resolution}}</span>
                </li>
                @endif
                @if($product->operating)
                <li>
                    <label>Hệ Điều Hành</label>
                    <span>{{$product->operating}}</span>
                </li>
                @endif
                @if($product->gpu)
                <li>
                    <label>GPU</label>
                    <span>{{$product->gpu}}</span>
                </li>
                @endif
                @if($product->camera)
                <li>
                    <label>Camera Trước</label>
                    <span>{{$product->camera.'px'}}</span>
                </li>
                @endif
                @if($product->camera_primary)
                <li>
                    <label>Camera Sau</label>
                    <span>{{$product->camera_primary.'px'}}</span>
                </li>
                @endif
                @if($product->chipset)
                <li>
                    <label>CPU</label>
                    <span>{{$product->chipset}}</span>
                </li>
                @endif
                @if($product->ram)
                <li>
                    <label>Ram</label>
                    <span>{{$product->ram. ' GB'}}</span>
                </li>
                @endif
                @if($product->rom)
                <li>
                    <label>Rom</label>
                    <span>{{$product->rom. ' GB'}}</span>
                </li>
                @endif
                @if($product->battery)
                <li>
                    <label>Dung Lượng Pin</label>
                    <span>{{$product->battery. ' MaH'}}</span>
                </li>
                @endif
                @if($product->other_information)
                <li>
                    <label>Ngày Ra Mắt</label>
                    <span>{{str_limit($product->other_information)}}</span>
                </li>
                @endif
                <li><center><button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-block btn-outline-primary">Xem Chi Tiết</button></center></li>
            </ul>
            <ul class="news-right-slidebar">
                <div class="alert alert-info" role="alert">
                    <strong>Tin Tức Mới</strong>
                </div>
                @foreach($lists_news as $value)
                <li>
                    <img  src="{{asset('upload/post/'.$value->img)}}" width="100%">
                    <a href="">{{str_limit($value->title,25)}}</a>
                    <div class="clearfix"></div>
                    <span><i class="far fa-clock"></i> {{$value->created_at}}</span><div class="clearfix"></div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">

        <div class="col-lg-12" >
            <div class="row">
                <div class="col-md-9 ">
                    <div class="row">
                         <h4 class="col-lg-12" >Bình Chọn Sản Phẩm</h4>
                    <div class="vote-index col-lg-4">
                        <?php $tong=0;?>
                        @foreach($sao as $v=> $s)
                            <?php $tong+=++$v*$s?>
                         @endforeach
                         @if($tongsao>0)
                        {{round($tong/$tongsao,2)}} <i class="fa fa-star"></i>
                        @else
                        {{'0'}}<i class="fa fa-star"></i>
                        @endif
                        <div class="stars">
                       
                      
                      <form action="" method="post">
                        @csrf
                        <input class="star star-5" id="star-5" type="radio" {{($voted!=null && $voted->voted==5)? 'checked' :''}} echo name="voted" value="5">
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" {{($voted!=null && $voted->voted==4)? 'checked' :''}} name="voted" value="4">
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" {{($voted!=null && $voted->voted==3)? 'checked' :''}} name="voted" value="3">
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" {{($voted!=null && $voted->voted==2)? 'checked' :''}} name="voted" value="2">
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" type="radio" {{($voted!=null && $voted->voted==1)? 'checked' :''}} name="voted" value="1">
                        <label class="star star-1" for="star-1"></label>
                    </form>
                </div>
                    </div>
                    <div class="voted col-lg-6">
                        @if($tongsao>0)
                        @foreach($sao as $v=> $s)
                         <div class="progress my-2" title="{{$s.' Đánh giá'}}">{{++$v}} <i class="fa fa-star"></i> &nbsp
                          <div class="progress-bar"  style="width:{{$s/$tongsao*100}}%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>

                      </div>
                      
                      @endforeach
                      @else
                     @foreach($sao as $v=> $s)
                         <div class="progress my-2" title="{{$s.' Đánh giá'}}">{{++$v}} <i class="fa fa-star"></i> &nbsp
                          <div class="progress-bar"  style="width:0%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>

                      </div>
                      
                      @endforeach
                      @endif

                    </div>
                     
                    </div>

                    <h4 >Bình Luận</h4>
                    <form action="" method="post" class="mb-3">
                        @csrf

                        <textarea class="form-control mt-3" placeholder="nhập nội dung đánh giá"name="noidung" id="" cols="5" rows="3"></textarea>
                        <p class="error"></p>
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary text-right btn-binhluan">Gửi</button>
                        </div>
                    </form>
                    
                   
                <div id="conment">
                    @foreach($conments as $v) 
                    <div class="media mb-3">
                        <img src="{{asset('upload/user/'.$v->img)}}" class="mr-3" alt="..." style="height: 50px">
                        <div class="media-body">
                            <h6 class="">{{$v->name}}<em>{{$v->created_at}}</em></h6>
                            {{$v->content}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3">
                <h4>So Sánh Sản Phẩm</h4>
                <form action="" method="post" class="mb-3">
                    <input type="text" placeholder="Gõ sản phẩm để so sánh..." class="form-control form-control-sm" value="" name="slug_key">
                </form>
                @foreach($product_same_price as $p)
                <div class="col-item mb-3">
                    <div class="photo">
                        <img height="150px" width="150px" src="{{asset('upload/product/'.$p->img)}}"  alt="{{$p->name}}" title="{{$p->name}}" />
                        @php $b=$p->price-$p->pricesale @endphp
                        @if($p->price > $p->pricesale)
                        <span class="price-sale">giảm {{number_format($b)}} vnd</span>
                        @endif
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-lg-12">
                                <h6 class="text-left ml-2"><a href="{{$p->slug}}.html">{{str_limit($p->name,21,'...')}}</a></h6>
                            </div>
                            <div class="price col-lg-12">
                                <h6 class="price-text-color text-left ml-2">{{number_format($p->price)}} VND</h6>
                            </div>
                            <div class="rating d-none d-md-block col-md-12 text-left">
                                <a href="{{url($product->slug.'&&'.$p->slug)}}">So sánh ngay</a>
                            </div>
                        </div>

                        <div class="clearfix">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>




<hr>
<div class="row">
    <h4 class="col-lg-12">Sản Phẩm Liên Quan</h4>
    @foreach($product_same as $p)
    <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
        <div class="col-item">
            <div class="photo">
                <img class="img-fluid" src="{{asset('upload/product/'.$p->img)}}" class="img-fluid" alt="{{$p->name}}" title="{{$p->name}}" />
                @php $b=$p['price']-$p['pricesale'] @endphp
                @if($p->price > $p->pricesale)
                <span class="price-sale">giảm {{number_format($b)}} vnd</span>
                @endif
            </div>
            <div class="info">
                <div class="row">
                    <div class="price col-lg-12">
                        <h6 class="text-left ml-2"><a href="{{$p->slug}}.html">{{str_limit($p->name,21,'...')}}</a></h6>
                    </div>
                    <div class="price col-lg-12">
                        <h6 class="price-text-color text-left ml-2">{{number_format($p->price)}} VND</h6>
                    </div>
                    <div class="rating d-none d-md-block col-md-12 text-left">
                        <i class="rating-text fa fa-star"></i><i class="rating-text fa fa-star">
                        </i><i class="rating-text fa fa-star"></i><i class="rating-text fa fa-star">
                        </i><i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="clearfix">
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</section>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông Tin Sản Phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @if($product->img)
                    <li class="list-group-item">
                        <center><img src="{{asset('upload/product').'/'.$product->img}}" alt=""></center>
                    </li>
                    @endif
                    @if($product->size)
                    <li class="list-group-item">
                        <label>Kích Thước: </label>
                        <span>{{$product->size. ' mm'}}</span>
                    </li>
                    @endif
                    @if($product->weight)
                    <li class="list-group-item">
                        <label>Nặng: </label>
                        <span>{{$product->weight. ' g'}}</span>
                    </li>
                    @endif
                    @if($product->camera_info)
                    <li class="list-group-item">
                        <label>Thông Tin Camera: </label>
                        <span>{{$product->camera_info}}</span>
                    </li>
                    @endif
                    @if($product->utilities)
                    <li class="list-group-item">
                        <label>Tính Năng: </label>
                        <span>{{$product->utilities}}</span>
                    </li>
                    @endif
                    @if($product->design)
                    <li class="list-group-item">
                        <label>Thiết Kế: </label>
                        <span>{{$product->design}}</span>
                    </li>
                    @endif
                    @if($product->material)
                    <li class="list-group-item">
                        <label>Kiểu Dáng: </label>
                        <span>{{$product->material}}</span>
                    </li>
                    @endif
                    @if($product->screen)
                    <li class="list-group-item">
                        <label>Màn Hình: </label>
                        <span>{{$product->screen}}</span>
                    </li>
                    @endif
                    @if($product->rom_available)
                    <li class="list-group-item">
                        <label>Rom Khả Dụng: </label>
                        <span>{{$product->rom_available}}</span>
                    </li>
                    @endif

                </ul>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
//location.reload();
$('.readmore').click(function(){
    $('.block article').css('height','auto');
    $(this).hide()
})
$('.color').click(function(event) {
    $(this).css('border','3px solid #333')
});
$('p.error').hide();
var user_id = <?= (Auth::check())? (Auth::id()) : '0' ?>;
$('textarea[name="noidung"]').html('');
$('.btn-binhluan').click(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    var content=$('textarea[name="noidung"]').val();
    $.ajax({
        url:"{{route('conments')}}",
        method:'POST',
        data: {
            content:content,
            id:{{$product->id}},
            user_id:user_id,
        },
        success:function(data){  
            $('p.error').html("");
            $('textarea[name="noidung"]').html('');

            if(data.errors==true){
    // $('p.error').show();
    // $('p.error').html(data.message.content[0]);
    alert(data.message.content[0]);

}
if(data.authcheck==true){
    alert(data.auth);
    //window.location({{route('login')}});
    window.open("{{route('login')}}");

    $('textarea[name="noidung"]').val('');
// $('p.error').show();
// $('p.error').html(data.auth);
}
if(data.errors==false){
    alert(data.message.result);
    var output='';
    output+='<div class="media mb-3">';
    output+='<img src="upload/user/'+data.message.news['img']+'" class="mr-3" alt="..." style="height: 50px">';
    output+='<div class="media-body">';
    output+='<h6 class="">'+data.message.news['name']+'</h6>';
    output+=data.message.news['content'];
    output+='</div>';
    $('textarea[name="noidung"]').html(''); $('textarea[name="noidung"]').val(" ");
    $('#conment').prepend(output);

}
}
})
})
$('input[name="voted"]').click(function(){
    var voted=$(this).val();
    //alert(voted);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        url:"{{route('voted')}}",
        method:'POST',
        data: {
            voted:voted,
            product_id:{{$product->id}},
            user_id:user_id,
        },
        success:function(data){
            if(data.auth=='fail'){
              alert(data.message);
              window.open("{{route('login')}}");
          }
          if(data.voted==false)
            alert(data.message);
        if(data.voted==true)
            alert(data.message);
    }
})

})
</script>
<style>
    p.error{
        color: red;
        font-style: italic
    }
    input[name="slug_key"]{
        border-radius: 0
    }
    button.btn-binhluan{
        border-radius: 0; text-align: right;
        float: right;
        margin-bottom: 15px
    }
    textarea[name='noidung']{
        border-radius: 0;

    }
    #conment{
        margin: 15px 0px;
        clear: both;
        /* border: 0.6px solid #ccc; */
        /*  padding:  15px 30px; */
    }
    div.stars {
       /*  width: 270px; */
        display: inline-block;
    }

    input.star { display: none; }

    label.star {
        float: right;
        padding: 10px;
        font-size: 22px;
        color: #444;
        transition: all .2s;
    }

    input.star:checked ~ label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
    }

    input.star-5:checked ~ label.star:before {
        color: #FE7;
        text-shadow: 0 0 30px #952;
    }

    input.star-1:checked ~ label.star:before { color: #F62; }

    label.star:hover { transform: rotate(-15deg) scale(1.3); }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome;
    }
    .fa.fa-star{
        color: yellow;
        margin-right: 5px
    }
    .vote-index{
        margin: 20px auto;
        color:  #fd9727;
        font-size: 30px;
        text-align: center

    }
    .vote{
        border: 1px solid #ccc;
    }
    .progress{
        /* height: 0.75rem; */
        padding: 0 5px;
    }
    .media-body{
        font-style: normal;
        font-size: 13px
    }
    .media-body h6{
        font-size: 13px
    }
    .media-body em{
        font-size: 10px;
        font-weight: 500;
        padding: 0 10px;
        color: #2ba832;
    }
</style>
<?php session()->put('detail_url',$_SERVER['REQUEST_URI'])
?>
@stop
