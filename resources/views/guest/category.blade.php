@extends('layouts.guest')
@section('title','Loại SP')
@section('main')
<div class="container product-page block">
    <div class="row">
        <div class="col-md-3">
            <form action="" method="POST">
                <h5 class="list-group-item list-group-item-info">Giá</h5>
                <input type="hidden" id="hidden_minimum_price" value="0" />
                <input type="hidden" id="hidden_maximum_price" value="50000000" />
                <p id="price_show">0 - 50000000</p>
                <div id="slider" class="mb-4"></div>
                {{-- <div class="form-group list-group mb-4 filter-block">
                    <h5 class="list-group-item list-group-item-info">Thương Hiệu</h5>
                    @foreach($brands as $brand)
                    <div class="list-group-item px-4">
                        <input class="form-check-input common_selector brand" name="brand" type="checkbox" value="{{$brand->id}}">
                        <label class="form-check-label">
                            {{$brand->name}}
                        </label>
                    </div>
                    @endforeach
                </div> --}}
                <div class="form-group list-group filter-block">
                    {{-- @foreach($categorys as $category)
                    <div class="list-group-item px-4">
                        <input class="form-check-input common_selector category" name="category" type="checkbox" value="{{$category->id}}">
                        <label class="form-check-label">
                            {{$category->name}}
                        </label>
                    </div>
                    @endforeach --}}
                    {!! $category_input !!}
                </div>  
        </div>
        <div class="col-md-9">
            <div class="row block">
                <div class="col-md-4">
                    <label for="" class="form-inline">Tiêu Chí</label>
                    <select name="orderby" id="orderby" class="form-control form-control-sm form-inline">
                        <option value="">---Chọn Tiêu Chí---</option>
                        <option value="price asc">Giá: Thấp-Cao</option>
                        <option value="price desc">Giá: Cao-Thấp</option>
                        <option value="name desc">Tên: Z-A</option>
                        <option value="name asc">Tên: A-Z</option>
                        <option value="created_at desc">Mới Nhất</option>
                        <option value="created_at asc">Củ Nhất</option>
                        <option value="views desc">Xem Nhiều</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Hiển Thị</label>
                    <select name="limit" id="limit" class="form-control form-control-sm">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="">All</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Chế Độ Xem</label>
                    <select name="view" class="view" >
                        <option value="gird">Lưới</option>
                        <option value="list">Danh Sách</option>
                    </select>   
                        @csrf
                    <div class="form-group">
                      <input type="text" class="form-control form-control-sm search" id="search" placeholder="Gõ từ khóa" >
                    </div>
                </div>
                
                </form>
            </div>
            <div class="filter_data row">
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function(){    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            filter_data();
            function filter_data()
            {
                 $('.filter_data').html('<div id="loading" style="" ><img style="position: absolute; top:10%; left:50%" src="img/Rolling-0.9s-200px.gif" height="50px"></div>');
                var brand = get_filter('brand');
                var category = get_filter('category');
                var orderby =$('#orderby').val();
                var limit =$('#limit').val();
                var view =$('.view').val();
                var key =$('#search').val();
                var max_price =$('#hidden_maximum_price').val();
                var min_price =$('#hidden_minimum_price').val();
                $.ajax({
                    
                    url:   "{{route('Category')}}",
                    method: 'POST',
                    data: {
                        min_price:min_price, 
                        max_price:max_price, 
                        brand:brand, 
                        category:category,
                        orderby:orderby,
                        limit:limit,
                        key:key,
                        view:view,
                    },
                    success:function(result){  
                        if(result.error==false)
                            $('.filter_data').html(result.message.SuccessMessage[0]);
                        if(result.error==true)
                           $('.filter_data').html(result.message);
                    },
                });
            }
            function get_filter(class_name)
            {
                var filter = [];
                $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }
            $('.common_selector').click(function(){
                filter_data();
            });
            $('.view').change(function(){
                filter_data();
            });
            $('#orderby').change(function(){
                filter_data();
            });
            $('#limit').change(function(){
                filter_data();
            });
            $('#search').keyup(function(){
                filter_data();
            });
            $('#slider').slider({
                range:true,
                min:100000,
                max:50000000,
                values:[100000, 50000000],
                step:1000000,
                stop:function(event, ui)
                {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            });
        });
    </script>       
@endsection