@extends('layouts.admin')
@section('title','Menu')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Danh Sách Menu
      </h1>
    </section>
    <section class="content">
        @include('errors.message')
        <div class="box">
            <div class="box-header">
            <h3 class="box-title"></h3>
            <a href="{{asset('admin/menu/create')}}" class="btn btn-default"><i class="fas fa-plus"></i></a>        
            </div>
            <div class="box-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th width="5px">STT</th>
                <th>Tên</th>
                <th>Liên Kết (Url)</th>
                <th width="100px">Hành Động</th>
                <th width="30px">Xóa</th>
                </tr>
                </thead>
                <tbody> 
                @php $i=1 @endphp
                @foreach($menus as $menu)
                    <tr>
                    <td>{{$i++}}</td>
                    <td>{{$menu->name}}</td>                    
                    <td>{{$menu->url}}</td>
                    <td align="center">
                        @if ($menu->status==1)
                        <a href="{{url('admin/menu/status/'.$menu->id)}}" class="btn btn-warning btn-sm" id="btn-status" title="Hiện"><i class="far fa-lightbulb"></i></a>
                        @else
                        <a href="{{url('admin/menu/status/'.$menu->id)}}" class="btn btn-info btn-sm" id="btn-status" title="Ẩn"><i class="far fa-moon"></i></a>
                        @endif
                        <a href="{{url('admin/menu/edit/'.$menu->id)}}" class="btn btn-primary btn-sm" id="btn-edit"><i class="far fa-edit"></i></a>
                        
                    </td>
                    <td><form method="POST" action="{{route('DeleteMenu',$menu->id)}}">  @method('delete') @csrf 
                        <button type="submit" class="btn btn-danger btn-sm" id="btn-destroy"><i class="fas fa-times" ></i></button></form></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </section>   
</div>
@endsection