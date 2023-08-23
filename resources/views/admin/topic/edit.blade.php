@extends('layouts.admin')
@section('title','Topic')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Topic
      </h1>
     @include('errors.errors')
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">  
                <div class="form-group">
                    <form method="POST" action="{{route('EditTopic',$detail->id)}}" enctype="multipart/form-data">
                        @method('PUT') @csrf
                    <label>Tên Chủ Đề</label>
                    <div class="input-group">
                        <input type="text" id="ipt_to_slug" required name="name" class="form-control" value="{{$detail->name}}" onkeyup="ChangeToSlug();">
                    </div>
                </div> 
                <div class="form-group">
                    <label>Liên Kết (Slug)</label>
                    <div class="input-group">
                        <input type="text" id="slug" required name="slug" class="form-control" value="{{$detail->slug}}">
                    </div>
                </div>               
                <div class="form-group">
                        <label>Trạng Thái</label>
                        <select class="form-control" name="status">
                            <option @php if($detail->status=1) echo "selected" @endphp value="1">Hiện</option>
                            <option @php if($detail->status=2) echo "selected" @endphp  value="2">Nổi Bật</option>
                        </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group list-group">
                    <label class="list-group-item list-group-item-primary">Hình Chính</label>
                    <div class="input-group list-group-item">
                        <center>
                        <img id="img" src="{{asset('upload/topic/'.$detail->img)}}" style="height:150px; width: auto; margin:0 auto">
                        <input name="img" id="imgipt" type="file"  class="form-control" onchange="showimg(this);"></center>
                        <input type="hidden" name="imgold" id="imgold" value="{{$detail->img}}">
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



