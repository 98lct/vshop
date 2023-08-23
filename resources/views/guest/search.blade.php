@php use Carbon\Carbon; @endphp
@extends('layouts.guest')
@section('title','Tìm Kiếm '.$key)
@section('main')

<section class="container block">
	<div class="row">
		<h6 class="alert alert-success">Có <i>{{$searchs->count()}}</i> Kết Quả Tìm Kiếm Cho Từ Khóa <b>{{$key}}</b></h6>
	</div>
	<div class="row">
	@foreach($searchs as $product)
        <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-3">
           <div class="col-item">
               <div class="photo">
                   <img src="{{asset('upload/product/'.$product->img)}}" class="img-fluid" alt="{{$product->name}}" title="{{$product->name}}" />
                   @php
                       $now = Carbon::now('Asia/Ho_Chi_Minh');
                       $dt=new Carbon($product->created_at);
                           if(($now->diffInDays($dt))<=3)
                           echo '<span class="product-status"><i class="fas fa-bolt"></i>Mới</span>';
                   @endphp
                   @php $b=$product->price-$product->pricesale @endphp
                   @if($product->price > $product->pricesale)
                       <span class="price-sale">giảm {{number_format($b)}} vnd</span>
                   @endif
               </div>
               <div class="info">
                   <div class="row">
                       <div class="price col-lg-12">
                           <h6 class="text-left ml-2"><a href="{{$product->slug}}">{{str_limit($product->name,21,'...')}}</a></h6>
                       </div>
                       <div class="price col-lg-12">
                           <h6 class="price-text-color text-left ml-2">{{number_format($product->price)}} VND</h6>
                       </div>
                       <div class="rating d-none d-md-block col-md-12 text-left">
                           <i class="rating-text fa fa-star"></i><i class="rating-text fa fa-star">
                           </i><i class="rating-text fa fa-star"></i><i class="rating-text fa fa-star">
                           </i><i class="fa fa-star"></i>
                       </div>
                   </div>
                   <div class="separator clear-left">
                       <a href="" class="btn btn-block btn-add-cart">
                           <span class="d-none d-md-block ">Thêm Vào Giỏ</span>
                           <i class="fas fa-shopping-cart text-center"></i>
                           <div class="clearfix"></div>
                       </a>
                   </div>
                   <div class="clearfix">
                   </div>
               </div>
           </div>
        </div>
      @endforeach
	</div>

    {{ $searchs->appends(['key' => $key ])->links() }}
</section>
@endsection
