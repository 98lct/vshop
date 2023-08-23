@extends('layouts.guest')
@section('title','Post')
@section('main')
<div class="container block">
    <div class="row">
            <ol class="breadcrumb bg-white"><!--asset với url là tương đương-->
                <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="">Bài Viết</a></li>
            </ol>
    </div>
    <div class="row"  id="post_data">



    </div>
    <div class="row">
        <button id="load_more_button" class="btn-link btn">Xem Thêm</button>
    </div>
</div>
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
            $(document).ready(function(){

             var _token = $('input[name="_token"]').val();

             load_data('', _token);

             function load_data(id="", _token)
             {
              $.ajax({
               url:"{{route('loadmore_topic',$topics[0]->topid)}}",
               method:"POST",
               data:{id:id, _token:_token},
               success:function(data)
               {
                $('#load_more_button').remove();
                $('#post_data').append(data);
               }
              })
             }

             $(document).on('click', '#load_more_button', function(){
              var id = $(this).data('id');
              $('#load_more_button').html('<b>Loading...</b>');
              load_data(id, _token);
             });

            });
            </script>







@endsection
@endsection
