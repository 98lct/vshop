@extends('layouts.admin')
@section('title','Contact')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h3>Contact</h3>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <a href="{{asset('admin/product/create')}}" class="btn btn-default"><i class="fas fa-plus"></i></a>
                <a href="" class="btn btn-default" data-toggle="modal" data-target="#ModalTrash"><i class="fas fa-trash-alt"></i></a>     
        
            </div>
            <div class="box-body">
                <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5px">STT</th>
                    <th>Tên</th>
                    <th>Nội Dung</th>
                    <th>Ngày Nhận</th>
                    <th >Trạng Thái</th>
                    <th width="125px">Hành Động</th>
                </tr>
                </thead>
                <tbody> 
                    @php $i=1 @endphp
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$contact->fullname}}</td>                        
                        <td>{{str_limit($contact->detail)}}</td>
                        <td>{{$contact->created_at}}</td>
                        <td> @if ($contact->status==2)
                                <a href="{{url('admin/contact/status/'.$contact->id)}}" class="btn btn-warning btn-sm" id="btn-status" title="Nổi Bật"><i class="far fa-lightbulb"></i></a>
                                @else
                                <a href="{{url('admin/contact/status/'.$contact->id)}}" class="btn btn-info btn-sm" id="btn-status" title="Mặc Định"><i class="far fa-moon"></i></a>
                            @endif</td>
                        <td align="center">
                       
                        <a href="{{url('admin/contact/reply/'.$contact->id)}}" class="btn btn-primary btn-sm" id="btn-edit"><i class="fas fa-reply"></i></a>
                        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalShow{{$contact->id}}" id="btn-show"><i class="far fa-eye"></i> </a>
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