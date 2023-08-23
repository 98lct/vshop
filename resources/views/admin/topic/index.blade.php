@extends('layouts.admin')
@section('title','Topic')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Topic
      </h1>
    </section>
  <section class="content">
   @include('errors.message')
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"></h3>
        <a href="{{asset('admin/topic/create')}}" class="btn btn-default"><i class="fas fa-plus"></i></a>
        <a href="" class="btn btn-default" data-toggle="modal" data-target="#ModalTrash"><i class="fas fa-trash-alt"></i></a>     
 
      </div>
      <div class="box-body">
        <table id="dataTable" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th width="5px">STT</th>
            <th>Tên</th>
            <th width="50px">Hình</th>
            <th >Liên Kết</th>
            <th >Ngày Tạo</th>
            <th width="125px">Hành Động</th>
          </tr>
          </thead>
          <tbody> 
            @php $i=1 @endphp
            @foreach($topics as $topic)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$topic->name}}</td>
                <td align="center"><img src="{{ asset('upload/topic/'.$topic->img) }}" height="30px"></td>
                
                <td>{{$topic->slug}}</td>
                <td>{{$topic->created_at}}</td>
                <td align="center">
                  @if ($topic->status==2)
                    <a href="{{asset('admin/topic/status/'.$topic->id)}}" class="btn btn-warning btn-sm" id="btn-status" title="Nổi Bật"><i class="far fa-lightbulb"></i></a>
                    @else
                    <a href="{{asset('admin/topic/status/'.$topic->id)}}" class="btn btn-info btn-sm" id="btn-status" title="Mặc Định"><i class="far fa-moon"></i></a>
                  @endif
                  <a href="{{asset('admin/topic/edit/'.$topic->id)}}" class="btn btn-primary btn-sm" id="btn-edit"><i class="far fa-edit"></i></a>
                  <form method="POST" action="{{route('DeleteTopic',$topic->id)}}">  @method('delete') @csrf 
                        <button type="submit" class="btn btn-danger btn-sm" id="btn-destroy"><i class="fas fa-times" ></i></button></form>
                    </tr>
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

