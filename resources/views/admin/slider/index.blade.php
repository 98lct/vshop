@extends('layouts.admin')
@section('title','Slider')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Danh Sách Slider
      </h1>
    </section>
    <section class="content">
        @include('errors.message')
        <div class="box">
            <div class="box-header">
            <h3 class="box-title"></h3>
            <a href="{{asset('admin/slider/create')}}" class="btn btn-default"><i class="fas fa-plus"></i></a>        
            </div>
            <div class="box-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th width="5px">STT</th>
                <th>Tên</th>
                <th>Liên Kết (Url)</th>
                <th>Hình</th>
                <th width="100px">Hành Động</th>
                <th width="30px">Xóa</th>
                </tr>
                </thead>
                <tbody> 
                @php $i=1 @endphp
                @foreach($sliders as $slider)
                    <tr>
                    <td>{{$i++}}</td>
                    <td>{{$slider->name}}</td>                    
                    <td>{{$slider->url}}</td>
                    <td><img height="50px" src="{{asset('upload/slider/'.$slider->img)}}" alt=""></td>
                    <td align="center">
                        @if ($slider->status==1)
                        <a href="{{url('admin/slider/status/'.$slider->id)}}" class="btn btn-warning btn-sm" id="btn-status" title="Hiện"><i class="far fa-lightbulb"></i></a>
                        @else
                        <a href="{{url('admin/slider/status/'.$slider->id)}}" class="btn btn-info btn-sm" id="btn-status" title="Ẩn"><i class="far fa-moon"></i></a>
                        @endif
                        <a href="{{url('admin/slider/edit/'.$slider->id)}}" class="btn btn-primary btn-sm" id="btn-edit"><i class="far fa-edit"></i></a>
                        
                    </td>
                    <td><form method="POST" action="{{route('DeleteSlider',$slider->id)}}">  @method('delete') @csrf 
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