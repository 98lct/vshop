
@extends('layouts.admin')
@section('title','Topic')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Topic</h1>
        @include('errors.errors')
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <form method="post" action="{{route('AddTopic')}}" enctype="multipart/form-data">
                    @csrf  
                    <label for="ipt_to_slug">Tên CHủ Đề (Name)</label>
                    <div class="input-group">
                        <input type="text" id="ipt_to_slug" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Điện Thoại" value="{{ old('name') }}" onkeyup="ChangeToSlug();">
                    </div>
                </div>
                <div class="form-group">
                    <label>Liên Kết(Slug)</label>
                    <div class="input-group">
                        <input type="text" name="slug" id="slug" class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}" placeholder="dien-thoai">
                    </div>
                </div>
                <div class="form-group">
                    <label>Trạng Thái</label>
                    <select class="form-control" name="status">
                        <option value="1">Hiện</option>
                        <option value="2">Nổi Bật</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
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

