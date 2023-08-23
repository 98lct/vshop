<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>V-shop.vn | @yield('title')</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/product_slider.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.12.1/jquery-ui.css')}}">
    <link href="{{asset('img/favicon.ico')}}" rel="shortcut icon" type="image/x-icon">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    @yield('style')
</head>

<body>
    @include('guest.shared.header')
    @include('guest.shared.nav')
    <!------------main-------------->
    @yield('main')
    <!--------!main--------------->
    @include('guest.shared.topic')
    @include('guest.shared.banner')
    @include('guest.shared.footer')
    <div class="back-to-top">
        <i class="fas fa-home"></i>
    </div>
    <script src="{{asset('vendor/jquery-ui-1.12.1/external/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/jquery-ui-1.12.1/jquery-ui.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
        $(window).scroll(function(event) {
           var pos_body = $('html,body').scrollTop();
           // console.log(pos_body);
           if(pos_body>20){
              $('.menu').addClass('fixed-top');
           }
           else {
              $('.menu').removeClass('fixed-top');
           }
           if(pos_body != 0){
              $('.back-to-top').fadeIn();
           }
           else{
              $('.back-to-top').fadeOut();
           }
        });
        $('.back-to-top').click(function(event) {
           $('html,body').animate({scrollTop: 0},1400);
        });
        $('.back-to-top').click(function() {
            $('html, body').animate({scrollTop:0},800);
         });
        $('.back-to-top').hover(function(){
                $('.back-to-top i').css('color','white')
        });
        $('.back-to-top').mouseout(function(){
                $('.back-to-top i').css('color','black')
        });
        $( "#slider" ).slider({
            range: true,
            values: [ 0, 100 ]
        });
     });
    </script>
    @yield('script')
</body>

</html>
