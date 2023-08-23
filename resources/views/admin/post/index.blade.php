@extends('layouts.admin')
@section('title','Post')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Post</h1>
        <form action="{{route('IndexPost')}}" method="POST" name="frm1" class="col-md-3">
            @csrf
            <select name="type" onchange="frm1.submit()" class="form-control form-control-sm">
                <option disabled selected>-----Chọn Loại-----</option>
                <option value="post" @if(isset($_POST['type']) && $_POST['type']=='post') selected @endif >Bài Viêt</option>
                <option value="page" @if(isset($_POST['type']) && $_POST['type']=='page') selected @endif>Trang Đơn</option>
            </select>
           
        </form>
    </section>
    <section class="content">
        @include('errors.message')
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"></h3>
            <a href="{{asset('admin/post/create')}}" class="btn btn-default"><i class="fas fa-plus"></i></a>
     
          </div>
          <div class="box-body">
            <table id="dataTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th width="5px">STT</th>
                <th>Tên</th>
                <th>Loại</th>
                <th>Chủ Đề</th>
                <th width="50px">Hình</th>
                <th >Mô Tả</th>
                <th >Ngày Tạo</th>
                <th width="125px">Hành Động</th>
              </tr>
              </thead>
              <tbody> 
                @php $i=1 @endphp
                @foreach($posts as $post)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{str_limit($post->title,'50')}}</td>
                    <td>{{$post->topic->name}}</td>
                    <td>{{$post->type}}</td>
                    <td align="center"><img src="{{ asset('upload/post/'.$post->img) }}" height="30px"></td>
                    
                    <td>{{str_limit($post->describe)}}</td>
                    <td>{{$post->created_at}}</td>
                    <td align="center">
                      @if ($post->status==2)
                        <a href="{{url('admin/post/status/'.$post->id)}}" class="btn btn-warning btn-sm" id="btn-status" title="Nổi Bật"><i class="far fa-lightbulb"></i></a>
                        @else
                        <a href="{{url('admin/post/status/'.$post->id)}}" class="btn btn-info btn-sm" id="btn-status" title="Mặc Định"><i class="far fa-moon"></i></a>
                      @endif
                      <a href="{{url('admin/post/edit/'.$post->id)}}" class="btn btn-primary btn-sm" id="btn-edit"><i class="far fa-edit"></i></a>
                      <form method="POST" action="{{route('DeletePost',$post->id)}}">  @method('delete') @csrf 
                            <button type="submit" class="btn btn-danger btn-sm" id="btn-destroy"><i class="fas fa-times" ></i></button></form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </section>   
</div>
    
@endsection