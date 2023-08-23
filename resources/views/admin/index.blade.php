@extends('layouts.admin')
@section('title','Dashboard')
@section('main')
@section('style')
<style>
    .cd-timeline__img--picture {
        background: #888
    }

    @media (min-width: 64rem) .cd-timeline__date {
        position: absolute;
        width: 100%;
        left: 130%;
        top: 20px;
    }


    .cd-timeline__date {
        margin: 0 15px
    }
</style>
@endsection



































<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sản Phẩm</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$products}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đơn Hàng</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$orders}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Thành Viên</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$users}}</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Bài Viết</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$posts}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <section class=" col-md-6" style="height:350px; overflow:auto">
    <div class="container">
        @foreach($historys as $history)
        <div class="media">
            <img class="mr-3 mb-3" height="50px" src="{{asset('upload/user/'.$history->img)}}" alt="Generic placeholder image">
            <div class="media-body">
              <strong class="mt-0"> <i>{{$history->time}}</i></strong>
              <p> {{$history->name}} {{$history->content}}</p>
            </div>
          </div>

        @endforeach
    </div>
</section>
<!-- cd-timeline -->
@endsection

@section('script')
<script src="{{asset('backend/js/timeline.js')}}"></script>
@endsection
