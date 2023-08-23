@extends('layouts.admin')
@section('title','Contact')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h3>Reply Contact</h3>
    </section>
    <section class="content">
        <div class="box">
            <form action="{{route('ReplyContact',$detail->id)}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Tên Người Nhân</label>
                    <input type="text" name="fullname" id="" class="form-control" value="{{$detail->fullname}}">
                </div>
                <div class="form-group">
                    <label for="">Email Người Nhận</label>
                    <input type="text" name="email" id="" class="form-control" value="{{$detail->email}}">
                </div>
                <div class="form-group">
                    <label for="">Tiêu Đề</label>
                    <input type="text" name="title" id="" class="form-control" value="Reply for '{{$detail->title}}'">
                </div>
                <div class="form-group">
                    <label for="">Tiêu Đề</label>
                    <textarea id="" name="comment" class="form-control" rows="10" placeholder="Nội Dung">
                        V-shop Xin phản hồi nội dung của bạn vào ngày {{$detail->created_at}}
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="far fa-reply"></i> Gửi</button>
                
            </form>
        </div>
    </section>
</div>
@endsection