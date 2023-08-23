
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
                    <form method="post" action="{{route('AddProduct')}}" enctype="multipart/form-data">
                    @csrf  
                    <label for="ipt_to_slug">Name</label>
                    <div class="input-group">
                        <input type="text" id="ipt_to_slug" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Điện Thoại" value="{{ old('name') }}" onkeyup="ChangeToSlug();">
                    </div>
                </div>
                <div class="form-group">
                    <label>Liên Kết (Slug)</label>
                    <div class="input-group">
                        <input type="text" name="slug" id="slug" class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}" placeholder="dien-thoai">
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
                    <textarea class="form-control ckeditor" id="ckeditor" name="detail">{{ old('detail') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Describe</label>
                    <div class="input-group">
                        <textarea name="describe" class="form-control {{ $errors->has('describe') ? ' is-invalid' : '' }}" placeholder="Smartphone Cao cấp nhiều tính năng" rows="5">{{ old('describe') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Camera Informaiton</label>
                    <div class="input-group">
                        <textarea name="camera_info" class="form-control {{ $errors->has('camera_info') ? ' is-invalid' : '' }}" placeholder="Dual Camera Primary 12px/24px" rows="5">{{ old('camera_info') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Connect</label>
                    <div class="input-group">
                        <textarea name="connect" class="form-control {{ $errors->has('connect') ? ' is-invalid' : '' }}" placeholder="Kết Nối 4G LTE, Wifi chuẩn abcn 161, Bluetool 5, Gpss " rows="5">{{ old('connect') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Utilities</label>
                    <div class="input-group">
                        <textarea name="utilities" class="form-control {{ $errors->has('utilities') ? ' is-invalid' : '' }}" placeholder="Mở khóa bằng vân tay, Mở khóa bằng khuôn mặt" rows="5">{{ old('utilities') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Other Information</label>
                    <div class="input-group">
                        <textarea name="other_information" class="form-control {{ $errors->has('other_information') ? ' is-invalid' : '' }}" placeholder="Ra Mắt 2/2019" rows="5">{{ old('other_information') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>GPU</label>
                    <div class="input-group">
                        <input type="text" name="gpu" class="form-control {{ $errors->has('gpu') ? ' is-invalid' : '' }}" placeholder="Adreno 506" value="{{old('gpu')}}">
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
                        <input type="text" name="screen" class="form-control {{ $errors->has('screen') ? ' is-invalid' : '' }}" placeholder="6.5 inches, 18.5/9" value="{{ old('screen') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Resolution--inches</label>
                    <div class="input-group">
                        <input type="text" name="resolution" class="form-control {{ $errors->has('resolution') ? ' is-invalid' : '' }}" placeholder="Full HD+"  value="{{ old('resolution') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Chipset</label>
                    <div class="input-group">
                        <input type="text" name="chipset" class="form-control {{ $errors->has('chipset') ? ' is-invalid' : '' }}" placeholder="A12 Bionic, Snapdragon 855"  value="{{ old('chipset') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Design</label>
                    <div class="input-group">
                        <input type="text" name="design" class="form-control {{ $errors->has('design') ? ' is-invalid' : '' }}" placeholder="Nguyên Khối, Tràn viền" value="{{ old('design') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Material</label>
                    <div class="input-group">
                        <input type="text" name="material" class="form-control {{ $errors->has('material') ? ' is-invalid' : '' }}" placeholder="Kim Loại, Kính" value="{{ old('material') }}">
                    </div>
                </div>  
                <div class="form-group">
                    <label>Size--mm</label>
                    <div class="input-group">
                        <input type="text" name="size" class="form-control {{ $errors->has('size') ? ' is-invalid' : '' }}" placeholder="155.9 - 75.4 - 8.1" value="{{ old('size') }}" >
                    </div>
                </div>  
                <div class="form-group">
                    <label>Weight--g</label>
                    <div class="input-group">
                        <input type="number" name="weight" class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}" placeholder="158" value="{{ old('weight') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Operating</label>
                    <div class="input-group">
                        <input type="text" name="operating" class="form-control {{ $errors->has('operating') ? ' is-invalid' : '' }}" placeholder="Android 9 Pie" value="{{ old('operating') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Rom--GB</label>
                    <div class="input-group">
                        <input type="number" name="rom" class="form-control {{ $errors->has('rom') ? ' is-invalid' : '' }}" placeholder="128" value="{{ old('rom') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Rom Available--GB</label>
                    <div class="input-group">
                        <input type="number" name="rom_available" class="form-control {{ $errors->has('rom_available') ? ' is-invalid' : '' }}" placeholder="90" value="{{ old('rom_available') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Number</label>
                    <div class="input-group">
                        <input type="number" name="number" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}" placeholder="10000" value="{{ old('number') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Price--VND</label>
                    <div class="input-group">
                        <input type="number" name="price" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="12800000"  value="{{ old('price') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>PriceSale--VND</label>
                    <div class="input-group">
                        <input type="number" name="pricesale" class="form-control {{ $errors->has('pricesale') ? ' is-invalid' : '' }}" placeholder="12800000" value="{{ old('pricesale') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Ram--GB</label>
                    <div class="input-group">
                        <input type="number" name="ram" class="form-control {{ $errors->has('ram') ? ' is-invalid' : '' }}" placeholder="128" value="{{ old('ram') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Battery--mAH</label>
                    <div class="input-group">
                        <input type="number" name="battery" class="form-control {{ $errors->has('battery') ? ' is-invalid' : '' }}" placeholder="4000" value="{{ old('battery') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Camera Primary--megapixel</label>
                    <div class="input-group">
                        <input type="number" name="camera_primary" class="form-control {{ $errors->has('camera_primary') ? ' is-invalid' : '' }}" placeholder="12" value="{{ old('camera_primary') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Camera --megapixel</label>
                    <div class="input-group">
                        <input type="number" name="camera" class="form-control {{ $errors->has('camera') ? ' is-invalid' : '' }}" placeholder="12" value="{{ old('camera') }}">
                    </div>
                </div>
               
                <div class="form-group list-group">
                    <label class="list-group-item list-group-item-primary">Hình Chính(Image)</label>
                    <div class="input-group list-group-item">
                        <center>
                            <img id="img" src="{{asset('img/logo.png')}}" style="height:150px; width: auto;">
                            <input name="img" id="imgipt" type="file" required  class="form-control {{ $errors->has('img') ? ' is-invalid' : '' }}" onchange="showimg(this);">
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

