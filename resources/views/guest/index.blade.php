@php
    use App\Models\Category;
 use App\Models\Product;  //  $bg_smartphone=Category::where('id',1)->first();
    use Carbon\Carbon;
@endphp
@extends('layouts.guest')
@section('title','Home')
@section('main')

<!--slidebar && slider-->
@include('guest.shared.slider&menu')
<!---adv--->
@include('guest.shared.advets')
<!--product-->
@foreach($product_block as $product)
<section class="block container">
    <div class="row">
        <div class="col-lg-12 category">
            <h3 class="category-title float-left">{{$product->name}}<i class="fas fa-phone"></i></h3>
            <nav class="category-menu">
                <ul class="float-right">
                    @php
                        $category_li=Category::where([
                            ['status','<>',0],
                            ['parent_id',$product['id']]
                        ])->limit(12)->get(); // lấy ra 12 category con thuộc category chính
                        $b=[];
                        foreach ($category_li as $value)
                        {
                            echo '<li><a href="">'.$value['name'].'</a></li>'; // in ra các category con để làm menu
                            array_push($b,$value['id']); // thêm giá trị id của category con vào mảng $b để truy vấn WhereIn sau đó
                        }
                      //  print_r($b)
                        $products_all=Product::where([
                            ['status','<>',0],
                        ])->whereIn('category_id', $b)->take(8)
                        ->orderBy('created_at','desc')->get();
                        $products_all_continue=Product::where([
                            ['status','<>',0],
                        ])->whereIn('category_id', $b)->skip(8)->take(8)->orderBy('created_at','desc')->get();
                    @endphp
                    <?php //echo $smartphone_li?>
                    <li class="li-no-padding">
                        <a class=" fa fa-chevron-left btn btn-category" href="#carousel-example{{$product->id}}" data-slide="prev"></a>
                        <a class=" fa fa-chevron-right btn btn-category" href="#carousel-example{{$product->id}}"data-slide="next"></a>
                    </li>
                </ul>
            </nav>
            <div class="clearfix"></div>
        </div>
        <div class="col-lg-3 bg-category category-img" style="background-image:url(upload/category/{{$product->img}});height: auto; background-size:cover; background-repeat: no-repeat; background-position: {{$product->img_possition}}">
        </div>
        <div class="col-lg-9 bg-category">
            <div class="col-md-12">
                <div id="carousel-example{{$product->id}}" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active carousel-item">
                            <div class="row">
                                @foreach($products_all as $product)
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="{{asset('upload/product').'/'.$product->img}}" class="img-fluid" alt="{{$product->name}}" title="{{$product->name}}" />
                                            @php
                                                $now = Carbon::now('Asia/Ho_Chi_Minh');
                                                $dt=new Carbon($product['created_at']);
                                                    if(($now->diffInDays($dt))<=3)
                                                    echo '<span class="product-status"><i class="fas fa-bolt"></i>Mới</span>';
                                            @endphp
                                            @php $b=$product['price']-$product['pricesale'] @endphp
                                            @if($product->price > $product->pricesale)
                                                <span class="price-sale">giảm {{number_format($b)}} vnd</span>
                                            @endif
                                        </div>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-lg-12">
                                                    <h6 class="text-left ml-2"><a title="{{$product->name}}" href="{{route('ProductDetail',[$product->slug])}}">{{str_limit($product->name,21,'...')}}</a></h6>
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

                                                    <a href="{{route('AddCart',$product->id)}}" class="btn btn-block btn-add-cart">
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
                        </div>
                        <div class="item carousel-item">
                             <div class="row">
                                @foreach($products_all_continue as $product)
                                <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="{{asset('upload/product').'/'.$product->img}}" class="img-fluid" alt="a" />
                                            @php
                                                $now = Carbon::now('Asia/Ho_Chi_Minh');
                                                $dt=new Carbon($product['created_at']);
                                                    if(($now->diffInDays($dt))<=3)
                                                    echo '<span class="product-status"><i class="fas fa-bolt"></i>Mới</span>';
                                            @endphp
                                            @php $b=$product['price']-$product['pricesale'] @endphp
                                            @if($product->price > $product->pricesale)
                                                <span class="price-sale">giảm {{number_format($b)}} vnd</span>
                                            @endif
                                        </div>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-lg-12">
                                                    <h6 class="text-left ml-2"><a href="{{route('ProductDetail',[$product->slug])}}" title="{{$product->name}}">{{str_limit($product->name,21,'...')}}</a></h6>
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
                                                <a href="{{route('AddCart',$product->id)}}" class="btn btn-block btn-add-cart">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach

@stop
