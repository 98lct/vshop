@extends('layouts.admin')
@section('title','Create User')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
	    <h1>
	        Thêm Người Dùng
	    </h1>
    </section>
	<section class="content">
		@include('errors.errors')
	    @include('errors.message')
	</section>
	<div class="box">
		<form method="POST" action="{{route('AddUser')}}" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label>Tên Người Dùng</label>
						<input type="text" name="name" class="form-control" required placeholder="Nhập Tên Người Dùng">
					</div>	
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" required placeholder="Nhập Email Người Dùng">
					</div>
					<div class="form-group">
						<label>Mật Khẩu</label>
						<input type="password" name="password" class="form-control" required placeholder="Nhập Mật Khẩu Người Dùng">
					</div>
					<div class="form-group">
						<label>Xác Nhận Mật Khẩu</label>
						<input type="password" name="password_confirm" class="form-control" required placeholder="Nhập Mật Khẩu Người Dùng">
					</div>	
				</div>
				<div class="col-md-4">
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
	        			<label>Quyền</label>
	        			<select class="form-control" name="roles">
	        				<option value="admin">Admin</option>
	        				<option value="member">Member</option>
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
			

		</form>
	</div>
@endsection
