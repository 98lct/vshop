
@extends('layouts.admin')
@section('title','Menu')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Thêm Menu</h1>
        @include('errors.errors')
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <form method="post" action="{{route('AddMenu')}}" enctype="multipart/form-data">
                    @csrf  
                    <label for="ipt_to_slug">Tên Menu(Name)</label>
                    <div class="input-group">
                        <input type="text" id="ipt_to_slug" required name="name" class="form-control " placeholder="home" value="{{ old('name') }}" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Liên Kết(url)</label>
                    <div class="input-group">
                        <input type="text" name="url" class="form-control" placeholder="admin/menu/create">
                    </div>
                </div>
                <div class="form-group">
                    <label>Cấp Cha(Parent)</label>
                    <select class="form-control select2" name="parent_id" style="width: 100%">
                        <option value="0" selected>----Không Có Menu Cha----</option>
                        @php echo $menu_option @endphp
                    </select>
                </div>
                <div class="form-group">
                    <label>Trạng Thái</label>
                    <select class="form-control" name="status">
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
               
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                        <label for="">Vị Trí(possition)</label>
                </div>
                <div class="form-check form-check-inline form-group">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="possition" id="" checked value="main"> Main
                    </label>
                </div>
                <div class="form-check form-check-inline form-group">
                    <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="possition" id="" value="bottom"> Bottom
                    </label>
                </div>
                <div class="form-group list-group">
                    <label class="list-group-item list-group-item-primary">Hình Chính(Image)</label>
                    <div class="input-group list-group-item">
                        <center>
                            <img id="img" src="{{asset('img/logo.png')}}" style="height:150px; width: auto;">
                            <input name="img" id="imgipt" type="file"  class="form-control" onchange="showimg(this);">
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

