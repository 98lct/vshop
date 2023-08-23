@extends('layouts.guest')
@section('title','Post')
@section('main')
<div class="container block">
    <div class="row">
        <ol class="breadcrumb bg-white">
            <!--asset với url là tương đương-->
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="">Bài Viết</a></li>
        </ol>
    </div>
    <div class="row" id="post_data">



    </div>
    <div class="row">
        <button id="load_more_button" class="btn-sm btn btn-success">Xem Thêm</button>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
             load_data('');
             function load_data(id="")
             {
                $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
              $.ajax({
               url:"{{ route('loadmore') }}",
               method:"POST",
               data:{id:id},
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
              load_data(id);
             });

            });
</script>
@endsection
