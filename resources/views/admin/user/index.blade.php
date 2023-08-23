@extends('layouts.admin')
@section('title','User')
@section('main')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh Sách Người Dùng
        </h1>
    </section>
    <section class="content">
        @include('errors.message')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
                @if(Auth::user()->index=='3')<a href="{{asset('admin/user/create')}}" class="btn btn-default"><i
                        class="fas fa-plus"></i></a>@endif

            </div>
            <div class="box-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5px">STT</th>
                            <th>Tên</th>
                            <th width="50px">Hình</th>
                            <th>Quyền</th>
                            <th>Email</th>
                            <th>Ngày Tạo</th>
                            <th width="125px">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($user_list as $user)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->name}}</td>
                            <td align="center"><img src="{{ asset('upload/user/'.$user->img) }}" height="30px"></td>

                            <td>{{$user->roles}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td align="center">
                                @if(Auth::user()->index=='3')
                                @if ($user->roles=='admin')
                                <a href="{{url('admin/user/roles/'.$user->id)}}" class="btn btn-warning btn-sm"
                                    id="btn-status" title="Admin"><i class="far fa-lightbulb"></i></a>
                                @else
                                <a href="{{url('admin/user/roles/'.$user->id)}}" class="btn btn-info btn-sm"
                                    id="btn-status" title="Member"><i class="far fa-moon"></i></a>
                                @endif
                                @endif
                                <a href="{{url('admin/user/edit/'.$user->id)}}" class="btn btn-primary btn-sm"
                                    id="btn-edit"><i class="far fa-edit"></i></a>
                                @if(Auth::user()->index=='3')
                                <form method="POST" action="{{route('DeleteUser',$user->id)}}"> @method('delete') @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" id="btn-destroy">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif

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
