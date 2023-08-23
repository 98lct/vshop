@extends('layouts.admin')
@section('title','category')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh Sách Loại Sản Phẩm
        </h1>
    </section>
    <section class="content">
        @include('errors.message')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <a href="{{asset('admin/category/create')}}" class="btn btn-default"><i class="fas fa-plus"></i></a>
                @if(Auth::user()->index=='3')
                <a href="" class="btn btn-default" data-toggle="modal" data-target="#ModalTrash"><i
                        class="fas fa-trash-alt"></i></a>
                @include('admin.category.trash')
                @endif
            </div>
            <div class="box-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5px">STT</th>
                            <th>Tên</th>
                            <th width="50px">Hình</th>
                            <th>Liên Kết</th>
                            <th>Ngày Tạo</th>
                            <th width="125px">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($categorys as $category)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$category->name}}</td>
                            <td align="center"><img src="{{ asset('upload/category/'.$category->img) }}" height="30px">
                            </td>

                            <td>{{$category->slug}}</td>
                            <td>{{$category->created_at}}</td>
                            <td align="center">
                                @if ($category->status==2)
                                <a href="{{asset('admin/category/status/'.$category->id)}}"
                                    class="btn btn-warning btn-sm" id="btn-status" title="Nổi Bật"><i
                                        class="far fa-lightbulb"></i></a>
                                @else
                                <a href="{{asset('admin/category/status/'.$category->id)}}" class="btn btn-info btn-sm"
                                    id="btn-status" title="Mặc Định"><i class="far fa-moon"></i></a>
                                @endif
                                <a href="{{asset('admin/category/edit/'.$category->id)}}" class="btn btn-primary btn-sm"
                                    id="btn-edit"><i class="far fa-edit"></i></a>
                                <a href="" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#ModalShow{{$category->id}}" id="btn-show"><i class="far fa-eye"></i>
                                </a>
                                @if(Auth::user()->index!='3')
                                <a href="{{asset('admin/category/remove/'.$category->id)}}"
                                    class="btn btn-danger btn-sm" id="btn-remove"><i class="far fa-trash-alt"></i> </a>
                                @else
                                <form method="POST" action="{{route('DeleteCategory',$category->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" id="btn-destroy"><i
                                            class="fas fa-times"></i></button></form>
                                @endif
                                @include('admin.category.show')
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
