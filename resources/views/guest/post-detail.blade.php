@extends('layouts.guest')
@section('title',$detail->slug)
@section('main')
@section('style')
    <style>

    </style>
@endsection
<div class="container block">
    <div class="row">
            <ol class="breadcrumb bg-white"><!--asset với url là tương đương-->
                <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="">{{$detail->title}}</a></li>
            </ol>
    </div>
    <div class="row post-detail">

        <h1>{{$detail->title}}</h1>
        <img src="{{asset('upload/post/'.$detail->img)}}" alt="" class="w-100" height="auto">
        <p>{!!$detail->detail!!}</p>
        <span class="float-right">{{$detail->created_at}}</span>
        <div class="clearfix">
        </div>
        <hr>
    </div>
</div>
@endsection
