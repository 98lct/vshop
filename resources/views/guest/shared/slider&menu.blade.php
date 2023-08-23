<section class="pb-3 container">
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-3 d-none d-sm-none d-md-none d-lg-block d-xl-block">
            <ul class="list-group" id="slidebar">
                <li style=" border-bottom: 1px solid #ccc; background:#019cdc; font-weight: 600; color:#000;"><i class="fas fa-list" style="padding:9px 6px; background: #019cdc; margin-right: 15px"></i>Thương Hiệu</li>
                <?php echo $brand_li ?>
            </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-9">
            <div class="carousel slide" data-ride="carousel" id="carousel-1">
                <div class="carousel-inner" role="listbox">
                    @php $i=1; @endphp
                    @foreach($sliders as $slider)
                    @if($i==1)
                    <div class="carousel-item active">
                        <img class="w-100" src="{{asset('upload/slider/'.$slider->img)}}" height="300px" alt="Slide Image">
                    </div>
                    @else
                    <div class="carousel-item">
                        <img class="w-100" src="{{asset('upload/slider/'.$slider->img)}}" height="300px" alt="Slide Image">
                    </div>
                    @endif
                    @php $i++; @endphp
                    @endforeach
                </div>
                <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button"
                        data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                <ol class="carousel-indicators">
                @foreach($sliders as $slider)
                 @if($i==1)
                    <li data-target="#carousel-1" data-slide-to="{{$slider->id}}" class="active"></li>
                @else
                    <li data-target="#carousel-1" data-slide-to="{{$slider->id}}"></li>
                @endif
                @php $i++; @endphp
                @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>
