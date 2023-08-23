
@extends('layouts.admin')
@section('title','Product')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sản Phẩm</h1>
        @include('errors.errors')
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <form method="post" action="{{route('EditProduct',$product->id)}}" enctype="multipart/form-data">
                    @csrf  @method('PUT')
                    <label for="ipt_to_slug">Name</label>
                    <div class="input-group">
                        <input type="text" id="ipt_to_slug" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$product->name}}" onkeyup="ChangeToSlug();">
                    </div>
                </div>
                <div class="form-group">
                    <label>Liên Kết (Slug)</label>
                    <div class="input-group">
                        <input type="text" name="slug" id="slug" class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}" value="{{$product->slug}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" name="category_id" style="width: 100%">
                        <?php echo $category_option ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <select class="form-control select2" name="brand_id" style="width: 100%">
                        <?php echo $brand_option ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Detail</label>
                    <textarea class="form-control ckeditor" id="ckeditor" name="detail">{{$product->detail}}</textarea>
                </div>
                <div class="form-group">
                    <label>Describe</label>
                    <div class="input-group">
                        <textarea name="describe" class="form-control {{ $errors->has('describe') ? ' is-invalid' : '' }}"  rows="5">{{$product->describe}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Camera Informaiton</label>
                    <div class="input-group">
                        <textarea name="camera_info" class="form-control {{ $errors->has('camera_info') ? ' is-invalid' : '' }}"  rows="5">{{$product->camera_info}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Connect</label>
                    <div class="input-group">
                        <textarea name="connect" class="form-control {{ $errors->has('connect') ? ' is-invalid' : '' }}" rows="5">{{$product->connect}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Utilities</label>
                    <div class="input-group">
                        <textarea name="utilities" class="form-control {{ $errors->has('utilities') ? ' is-invalid' : '' }}"  rows="5">{{$product->utilities}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Other Information</label>
                    <div class="input-group">
                        <textarea name="other_information" class="form-control {{ $errors->has('other_information') ? ' is-invalid' : '' }}" >{{$product->other_information}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>GPU</label>
                    <div class="input-group">
                        <input type="text" name="gpu" class="form-control {{ $errors->has('gpu') ? ' is-invalid' : '' }}"  value="{{$product->gpu}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Trạng Thái</label>
                    <select class="form-control" name="status">
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                        <option value="2">Nổi Bật</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Screen--inches</label>
                    <div class="input-group">
                        <input type="text" name="screen" class="form-control {{ $errors->has('screen') ? ' is-invalid' : '' }}" value="{{$product->screen}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Resolution--inches</label>
                    <div class="input-group">
                        <input type="text" name="resolution" class="form-control {{ $errors->has('resolution') ? ' is-invalid' : '' }}" value="{{$product->resolution}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Chipset</label>
                    <div class="input-group">
                        <input type="text" name="chipset" class="form-control {{ $errors->has('chipset') ? ' is-invalid' : '' }}" value="{{$product->chipset}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Design</label>
                    <div class="input-group">
                        <input type="text" name="design" class="form-control {{ $errors->has('design') ? ' is-invalid' : '' }}" value="{{$product->design}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Material</label>
                    <div class="input-group">
                        <input type="text" name="material" class="form-control {{ $errors->has('material') ? ' is-invalid' : '' }}" value="{{$product->material}}" >
                    </div>
                </div>  
                <div class="form-group">
                    <label>Size--mm</label>
                    <div class="input-group">
                        <input type="text" name="size" class="form-control {{ $errors->has('size') ? ' is-invalid' : '' }}" value="{{$product->size}}" >
                    </div>
                </div>  
                <div class="form-group">
                    <label>Weight--g</label>
                    <div class="input-group">
                        <input type="text" name="weight" class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}" value="{{$product->weight}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Operating</label>
                    <div class="input-group">
                        <input type="text" name="operating" class="form-control {{ $errors->has('operating') ? ' is-invalid' : '' }}" value="{{$product->operating}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Rom--GB</label>
                    <div class="input-group">
                        <input type="number" name="rom" class="form-control {{ $errors->has('rom') ? ' is-invalid' : '' }}" value="{{$product->rom}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Rom Available--GB</label>
                    <div class="input-group">
                        <input type="number" name="rom_available" class="form-control {{ $errors->has('rom_available') ? ' is-invalid' : '' }}" value="{{$product->rom_available}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Number</label>
                    <div class="input-group">
                        <input type="number" name="number" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}" value="{{$product->number}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Price--VND</label>
                    <div class="input-group">
                        <input type="number" name="price" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{$product->price}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>PriceSale--VND</label>
                    <div class="input-group">
                        <input type="number" name="pricesale" class="form-control {{ $errors->has('pricesale') ? ' is-invalid' : '' }}" value="{{$product->pricesale}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Ram--GB</label>
                    <div class="input-group">
                        <input type="number" name="ram" class="form-control {{ $errors->has('ram') ? ' is-invalid' : '' }}" value="{{$product->ram}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Battery--mAH</label>
                    <div class="input-group">
                        <input type="number" name="battery" class="form-control {{ $errors->has('battery') ? ' is-invalid' : '' }}" value="{{$product->battery}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Camera Primary--megapixel</label>
                    <div class="input-group">
                        <input type="number" name="camera_primary" class="form-control {{ $errors->has('camera_primary') ? ' is-invalid' : '' }}" value="{{$product->camera_primary}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Camera --megapixel</label>
                    <div class="input-group">
                        <input type="number" name="camera" class="form-control {{ $errors->has('camera') ? ' is-invalid' : '' }}" value="{{$product->camera}}" >
                    </div>
                </div>
               
                <div class="form-group list-group">
                    <label class="list-group-item list-group-item-primary">Hình Chính(Image)</label>
                    <div class="input-group list-group-item">
                        <center>
                            <img id="img" src="{{asset('upload/product/'.$product->img)}}" style="height:150px; width: auto;">
                            <input name="img" id="imgipt" type="file"  class="form-control {{ $errors->has('img') ? ' is-invalid' : '' }}" onchange="showimg(this);">
                        </center>
                    </div>                  
                </div>  
                <div class="form-group"> 
                    <label>Chức Năng</label> <br>
                      <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i></button>
                      <button type="reset" class="btn btn-outline-dark"><i class="fa fa-eraser"></i></button>
                    </form> 
                </div>
            </div> 
        </div>
    </section>

</div>
@endsection

