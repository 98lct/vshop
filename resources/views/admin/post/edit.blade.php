
@extends('layouts.admin')
@section('title','Post')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Post</h1>
        @include('errors.errors')
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <form method="post" action="{{route('EditPost',$detail->id)}}" enctype="multipart/form-data">
                    @csrf  @method('PUT')
                    <label for="ipt_to_slug">Tên Bài Viêt(Title)</label>
                    <div class="input-group">
                        <input type="text" id="ipt_to_slug" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $detail->title }}" onkeyup="ChangeToSlug();">
                    </div>
                </div>
                <div class="form-group">
                    <label>Liên Kết(Slug)</label>
                    <div class="input-group">
                        <input type="text" name="slug" id="slug" class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}"  value="{{ $detail->slug }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Chủ Đề(Topic)</label>
                    <select class="form-control select2" name="topic_id" style="width: 100%">
                        <?php echo $Topic_option ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Mô Tả (Describe)</label>
                    <textarea class="form-control {{ $errors->has('describe') ? ' is-invalid' : '' }}" name="describe" id="" rows="2">{{ $detail->describe }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Chi Tiết (Detail)</label>
                    <textarea class="form-control ckeditor {{ $errors->has('detail') ? ' is-invalid' : '' }}" name="detail"  id="ckeditor" rows="4">{{ $detail->detail }}</textarea>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Phân Loại(Type):</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" @if($detail->type=='post') checked @endif type="radio" name="type" id="" value="post"> Bài Viết
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" @if($detail->type=='page') checked @endif type="radio" name="type" id="" value="page"> Trang Đơn
                        </label>
                    </div>
                </div>
                <div class="form-group list-group">
                    <label class="list-group-item list-group-item-primary">Hình Chính(Image)</label>
                    <div class="input-group list-group-item">
                        <center>
                            <img id="img" src="{{asset('upload/post/'.$detail->img)}}" style="height:150px; width: auto; margin:0 auto">
                            <input name="img" id="imgipt" type="file"  class="form-control {{ $errors->has('img') ? ' is-invalid' : '' }}" onchange="showimg(this);">
                        </center>
                    </div>                  
                </div>  
                <div class="form-group">
                    <label>Trạng Thái</label>
                    <select class="form-control" name="status">
                        <option value="1" @if($detail->status=='1') 'selected' @endif>Hiện</option>
                        <option value="0" @if($detail->status=='0') 'selected' @endif>Ẩn</option>
                        <option value="2" @if($detail->status=='2') 'selected' @endif>Nổi Bật</option>
                    </select>
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

