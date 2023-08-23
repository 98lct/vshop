@php
    use App\Models\Post;
    use App\Models\Topic;
    $topic_lists=Topic::where('status','=',2)->limit(4)->get();
@endphp
<section class="block container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="row pb-3">
                        <button id="topic-icon">
                            <i class="far fa-newspaper"></i>Chủ Đề
                        </button>
                    </div>
                </div>
                @foreach($topic_lists as $topic_list)
                    @php
                        $post_lights=Post::where([['status','=',2],['topic_id',$topic_list->id]]) ->first();
                        $count=Post::where([['status','=',2],['topic_id',$topic_list->id]])->count()

                       // dd($post_lights->title);
                    @endphp
                    <div class="col-lg-6 col-md-3 post-box">
                    <div class="row">
                        <div class="col-lg-12 col-xl-6 topic-img" style="background:url('{{asset('upload/topic/'.$topic_list->img)}}') center; background-size: cover;">
                            <div class="overlay">
                               <h2>{{$topic_list->name}}</h2>
                               <a class="info" href="{{route('topic',$topic_list->slug)}}">Tất Cả</a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-xl-block p-3 bg-{{$topic_list->bg_color}}">
                            <h2><a href="{{route('PostDetail',$post_lights->slug)}}">{{str_limit($post_lights['title'],70,'...')}}</a></h2>
                            <p>{{str_limit($post_lights['describe'],200,'...')}}</p>
                            <div>
                            <i class="far fa-calendar-alt"></i><span>{{$post_lights['created_at']}}</span>
                            <i class="fas fa-grip-lines-vertical">||</i>
                            <i class="far fa-comments"></i><span>{{$count}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{--  <div class="col-lg-6 col-md-3 post-box">
                    <div class="row">
                        <div class="col-lg-12 col-xl-6 topic-img" style="background:url('upload/topic/desk.jpg') center; background-size: cover;">
                            <div class="overlay">
                               <h2>Điện Thoại</h2>
                               <a class="info" href="#">Tất Cả</a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-xl-block p-3 bg-00B2EE">
                            <h2><a href="">Nhanh tay săn khuyến mãi HOT cuối tuần, giảm sốc đến 2 triệu đồng!</a></h2>
                            <p>Nhân dịp cuối tuần (từ 11/1 đến 13/1), để tạo điều kiện cho các bạn đang có ý định mua smartphone được tiết kiệm hơn. Hôm nay mình sẽ tổng hợp một loạt điện thoại đang giảm giá mạnh tại Thế Giới Di Động.....</p>
                            <div>
                            <i class="far fa-calendar-alt"></i><span>13.1.2019</span>
                            <i class="fas fa-grip-lines-vertical">||</i>
                            <i class="far fa-comments"></i><span>95</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-3 post-box">
                    <div class="row">
                        <div class="col-lg-12 col-xl-6 topic-img" style="background:url('upload/topic/phu-kien.jpg') center; background-size: cover;">
                            <div class="overlay">
                               <h2>Điện Thoại</h2>
                               <a class="info" href="#">Tất Cả</a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-xl-block p-3 bg-00CD66">
                            <h2><a href="">Nhanh tay săn khuyến mãi HOT cuối tuần, giảm sốc đến 2 triệu đồng!</a></h2>
                            <p>Nhân dịp cuối tuần (từ 11/1 đến 13/1), để tạo điều kiện cho các bạn đang có ý định mua smartphone được tiết kiệm hơn. Hôm nay mình sẽ tổng hợp một loạt điện thoại đang giảm giá mạnh tại Thế Giới Di Động.....</p>
                            <div>
                            <i class="far fa-calendar-alt"></i><span>13.1.2019</span>
                            <i class="fas fa-grip-lines-vertical">||</i>
                            <i class="far fa-comments"></i><span>95</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-3 post-box">
                    <div class="row">
                        <div class="col-lg-12 col-xl-6 topic-img" style="background:url('upload/topic/game.jpg') center; background-size: cover;">
                            <div class="overlay">
                               <h2>Điện Thoại</h2>
                               <a class="info" href="#">Tất Cả</a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-xl-block p-3 bg-EEC900">
                            <h2><a href="">Nhanh tay săn khuyến mãi HOT cuối tuần, giảm sốc đến 2 triệu đồng!</a></h2>
                            <p>Nhân dịp cuối tuần (từ 11/1 đến 13/1), để tạo điều kiện cho các bạn đang có ý định mua smartphone được tiết kiệm hơn. Hôm nay mình sẽ tổng hợp một loạt điện thoại đang giảm giá mạnh tại Thế Giới Di Động.....</p>
                            <div>
                            <i class="far fa-calendar-alt"></i><span>13.1.2019</span>
                            <i class="fas fa-grip-lines-vertical">||</i>
                            <i class="far fa-comments"></i><span>95</span>
                            </div>
                        </div>
                    </div>
                </div>  --}}
        </div>
    </section>
