@extends('layouts.admin')
@section('title','Brand')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Thương Hiệu
      </h1>
      @include('errors.errors')
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">  
                <div class="form-group">
                    <form method="POST" action="{{route('EditBrand',$brand->id)}}" enctype="multipart/form-data">
                        @method('PUT') @csrf
                    <label>Tên Thương Hiệu</label>
                    <div class="input-group">
                        <input type="text" id="ipt_to_slug" required name="name" class="form-control" value="{{$brand->name}}" onkeyup="ChangeToSlug();">
                    </div>
                </div> 
                <div class="form-group">
                    <label>Liên Kết (Slug)</label>
                    <div class="input-group">
                        <input type="text" id="slug" required name="slug" class="form-control" value="{{$brand->slug}}">
                    </div>
                </div>               
                <div class="form-group">
                    <label>Cấp Cha</label>
                    <select class="form-control select2" name="parent_id" style="width: 100%">
                        <option value="0">-----Không Có Cấp Cha-----</option>
                        <?php echo $brand_option ?>
                    </select>
                </div>
                <div class="form-group">
                        <label>Trạng Thái</label>
                        <select class="form-control" name="status">
                            <option @php if($brand['status']=1) echo "selected" @endphp value="1">Hiện</option>
                            <option @php if($brand['status']=0) echo "selected" @endphp  value="0">Ẩn</option>
                            <option @php if($brand['status']=2) echo "selected" @endphp  value="2">Nổi Bật</option>
                        </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group list-group">
                    <label class="list-group-item list-group-item-primary">Hình Chính</label>
                    <div class="input-group list-group-item">
                        <center>
                        <img id="img" src="{{asset('upload/brand/'.$brand->img)}}" style="height:150px; width: auto; margin:0 auto">
                        <input name="img" id="imgipt" type="file"  class="form-control" onchange="showimg(this);"></center>
                        <input type="hidden" name="imgold" id="imgold" value="{{$brand->img}}">
                    </div>
                </div>  
                <div class="form-group"> 
                    <label>Chức Năng</label> <br>
                      <button type="submit" name="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i></button>
                      <button type="reset" class="btn btn-outline-dark"><i class="fa fa-eraser"></i></button>
                    </form> 
                </div>
            </div> 
        </div>
    </section>
</div>
@endsection



