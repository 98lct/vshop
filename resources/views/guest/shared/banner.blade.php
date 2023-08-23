<!--banner-->
@php
    use App\Models\Adverts;
    $adverts=Adverts::where([['status','<>',0],['possition','bottom']])->limit(4)->orderBy('created_at','desc')->get();
@endphp
<aside class="d-none d-sm-none d-md-block d-lg-block d-xl-block article-list block">
    <div class="container">
        <div class="row articles">
            @foreach($adverts as $advert)
            <div class="col-sm-6 col-md-3 item">
            	<a href="#"><img class="img-fluid" src="{{asset('upload/adverts/'.$advert->img)}}"></a>
            </div>
            @endforeach
        </div>
    </div>
</aside>
