@extends('layouts.admin')
@section('title','Edit User')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Sửa Người Dùng
        </h1>
    </section>
    <section class="content">
        @include('errors.errors')
        @include('errors.message')
    </section>
    <div class="box">
        <form method="POST" action="{{route('EditUser',$user->id)}}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Tên Người Dùng</label>
                        <input type="text" name="name" class="form-control" @if(Auth::id()!=$user->id &&
                        Auth::user()->index!='3') readonly @endif
                        value="{{$user->name}}" >
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" @if(Auth::id()!=$user->id && Auth::user()->index!='3') readonly @endif
                        name="email" class="form-control"
                        value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label>Mật Khẩu Mới</label>
                        <input type="password" @if(Auth::id()!=$user->id && Auth::user()->index!='3') readonly @endif
                        name="password"
                        class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Xác Nhận Mật Khẩu</label>
                        <input type="password" @if(Auth::id()!=$user->id && Auth::user()->index!='3') readonly @endif
                        name="password_confirm"
                        class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group list-group">
                        <label class="list-group-item list-group-item-primary">Hình Chính(Image)</label>
                        <div class="input-group list-group-item">
                            <center>
                                <img id="img" src="{{asset('img/logo.png')}}" style="height:150px; width: auto;">
                                <input name="img" id="imgipt" type="file"
                                    class="form-control {{ $errors->has('img') ? ' is-invalid' : '' }}"
                                    onchange="showimg(this);">
                            </center>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Quyền</label>
                        <select @if(Auth::id()!=$user->id && Auth::user()->index!='3') readonly @endif
                            class="form-control" name="roles">
                            <option value="admin" @if($user->roles=='admin') selected @endif>Admin</option>
                            <option value="member" @if($user->roles=='member') selected @endif>Member</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chức Năng</label> <br>
                        <button style="@if(Auth::id()!=$user->id && Auth::user()->index!='3' ) display:none @endif" type="submit"
                            class="btn btn-outline-primary"><i class="fa fa-save"></i></button>
                        <button style="@if(Auth::id()!=$user->id && Auth::user()->index!='3' ) display:none @endif" type="reset"
                            class="btn btn-outline-dark"><i class="fa fa-eraser"></i></button>
        </form>
    </div>
</div>
</div>


</form>
</div>
@endsection
