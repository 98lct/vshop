@php 
  use App\Models\Brand;
@endphp
@extends('layouts.admin')
@section('title','brand')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Danh Sách Thương Hiệu
      </h1>
    </section>
  <section class="content">
   @include('errors.message')
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"></h3>
        <a href="{{asset('admin/brand/create')}}" class="btn btn-default"><i class="fas fa-plus"></i></a>
        <a href="" class="btn btn-default" data-toggle="modal" data-target="#ModalTrash"><i class="fas fa-trash-alt"></i></a>     
          @include('admin.brand.trash')
 
      </div>
      <div class="box-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
            <th width="5px">STT</th>
            <th>Tên</th>
            <th width="50px">Hình</th>
            <th >Liên Kết</th>
            <th >Ngày Tạo</th>
            <th width="200px">Hành Động</th>
          </tr>
          </thead>
          <tbody> 
            @php $i=1 @endphp
            @foreach($brands as $brand)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$brand->name}}</td>
                <td align="center"><img src="{{ asset('upload/brand/'.$brand->img) }}" height="30px"></td>
                
                <td>{{$brand->slug}}</td>
                <td>{{$brand->created_at}}</td>
                <td align="center">
                  @if ($brand->status==2)
                    <a href="{{asset('admin/brand/status/'.$brand->id)}}" class="btn btn-warning btn-sm" id="btn-status" title="Nổi Bật"><i class="far fa-lightbulb"></i></a>
                    @else
                    <a href="{{asset('admin/brand/status/'.$brand->id)}}" class="btn btn-info btn-sm" id="btn-status" title="Mặc Định"><i class="far fa-moon"></i></a>
                  @endif
                  <a href="{{asset('admin/brand/edit/'.$brand->id)}}" class="btn btn-primary btn-sm" id="btn-edit"><i class="far fa-edit"></i></a>
                  <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalShow{{$brand->id}}" id="btn-show"><i class="far fa-eye"></i> </a>
                  <a href="{{asset('admin/brand/remove/'.$brand->id)}}" class="btn btn-danger btn-sm" id="btn-remove"><i class="far fa-trash-alt"></i> </a>
                  @include('admin.brand.show')
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

