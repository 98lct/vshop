@php
    use App\Models\Menu;
    $menus=Menu::where([
        ['status','<>',0],
        ['parent_id',0]
    ])->limit(7)->get();
@endphp
<nav class="pb-3 menu">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color: rgb(0,155,226);">
        <div class="container">
            <a class="navbar-brand" href="{{route('Home')}}">V-SHOP</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1" style="height: 40px;">
                <ul class="nav navbar-nav mr-auto" style="margin-right: auto;">
                    @foreach($menus as $menu)
                        @php $menus_sub=Menu::where([
                                ['status','<>',0],
                                ['parent_id',$menu['id']]
                            ])->get();
                        if(count($menus_sub))
                        {
                        @endphp
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#">{{$menu['name']}}</a>
                                <ul id="sub-menu">
                                    @foreach($menus_sub as $menu)
                                    <li class=""><a href="" class="sub-menu-a">{{$menu['name']}}</a></li>
                                     @endforeach
                                </ul>
                            </li>
                    @php } else { @endphp
                    <!--<li class="nav-item" role="presentation"><a class="nav-link" href="#">giới thiệu</a></li>-->
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{$menu->url}}">{{$menu['name']}}</a></li>
                   <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="#">liên hệ</a></li>-->
                    @php } @endphp
                    @endforeach
                </ul>
                <form class="form-inline text-right mr-auto" method="get" target="_self" action="{{route('Search')}}">
                    <div class="form-group">
                        <button type="submit"><label for="search-field" style="background-color: #fffafa;"><i class="fa fa-search d-none d-sm-none d-md-none d-lg-block d-xl-block" style="color: rgb(0,0,0);font-size: 16px;padding: 5.7px;padding-right: 9px;padding-left: 9px;"></i></label></button>
                        <input class="form-control form-control-lg d-none d-sm-none d-md-none d-lg-block d-xl-block search-field" type="search" name="q" required placeholder="Nhập Từ Khóa..." id="search-field" style="height: 30px;background-color: #ffffff;font-size: 14px;padding-right: 50px;padding-left: 50px;">
                    </div>
                </form>
            </div>
        </div>
    </nav>
</nav>
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
 <script>
     $(document).ready(function(){
         var engine1 = new Bloodhound({
            remote: {
                url: '/search?key=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('key'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        $("#search-field").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, [
            {
                source: engine1.ttAdapter(),
                name: 'students-name',
                display: function(data) {
                    return data.name;
                },
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown"></div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="'+data.slug+'.html" class="list-group-item"><span class="float-left"><img style="height:20px" src="upload/product/'+data.img+'"></span><span class=" ml-2 float-left">'+data.name+' </span><span class="clearfix"></span></a>';
                    }
                }
            },
        ])
     })

   </script>
@endsection
