<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function index()
    {
       // $lists_news=DB::table('post')->where('status','<>',0)->paginate(2);
        return view('guest.post');
    }
    //index loadmore btn
    public function loadmore(Request $request){
        {
            if($request->ajax())
            {
             if($request->id > 0)
             {
              $data = DB::table('post')
                 ->where('id', '<', $request->id)
                 ->orderBy('id', 'DESC')
                 ->limit(5)
                 ->get();
             }
             else
             {
              $data = DB::table('post')
                 ->orderBy('id', 'DESC')
                 ->limit(5)
                 ->get();
             }
             $output = '';
             $last_id = '';

             if(!$data->isEmpty())
             {
              foreach($data as $row)
              {
               $output .= '
               <div class="col-md-12 my-3">
                <div class="row">
                    <img src="'.asset('upload/post/'.$row->img).'" class=" col-sm-4" alt="" height="200px">
                    <div class="col-sm-8">
                    <h4><a href="'.url('bai-viet/'.$row->slug.'.html').'" title="'.$row->title.'">'.$row->title.'</a></h4>
                    <p>'.$row->describe.'</p>
                    <span class="float-right"><i class="far fa-clock"></i>'.$row->created_at.'</span>
                    <div class="clearfix">

                    </div>
                    </div>
                </div>

            </div>
               ';
               $last_id = $row->id;
              }
              $output .= '
              <div id="load_more">
               <button type="button" name="load_more_button" class="btn btn-success btn-sm" data-id="'.$last_id.'" id="load_more_button">Xem Thêm</button>
              </div>
              ';
             }
             else
             {
              $output .= '
              <div id="load_more">
               <button type="button" name="load_more_button" class="btn btn-info btn-sm" style="display:none">No Data Found</button>
              </div>
              ';
             }
              echo $output;
            }
           }
    }
    public function show($slug)
    {
        $detail=DB::table('post')->where('slug',$slug)->first();
        return view('guest.post-detail',compact('detail'));
    }
    public function topic($slug)
    {
        $topics=DB::table('topic')
        ->join('post','post.topic_id','=','topic.id')
        ->where('topic.slug',$slug)->select('topic.slug as topicslug','title','detail','topic.id as topid')->get();
        return view('guest.post-topic',compact('topics'));
    }
    public function loadmore_topic(Request $request,$slug){
        {
            if($request->ajax())
            {
             if($request->id > 0)
             {


              $data = DB::table('post')
                ->join('topic','topic.id','=','post.topic_id')
                 ->where([['post.id', '<', $request->id],['topic.slug',$slug]])
                 ->orderBy('post.id', 'DESC')
                 ->limit(5)
                 ->get();
             }
             else
             {
              $data = DB::table('post')
              ->join('topic','topic.id','=','post.topic_id')
              ->where('topic.slug',$slug)
                 ->orderBy('post.id', 'DESC')
                 ->limit(5)
                 ->get();
             }
             $output = '';
             $last_id = '';

             if(!$data->isEmpty())
             {
              foreach($data as $row)
              {
               $output .= '
               <div class="col-md-12 my-3">
                <div class="row">
                    <img src="'.asset('upload/post/'.$row->img).'" class=" col-sm-4" alt="" height="200px">
                    <div class="col-sm-8">
                    <h4><a href="'.url('bai-viet/'.$row->slug.'.html').'" title="'.$row->title.'">'.$row->title.'</a></h4>
                    <p>'.$row->describe.'</p>
                    <span class="float-right"><i class="far fa-clock"></i>'.$row->created_at.'</span>
                    <div class="clearfix">

                    </div>
                    </div>
                </div>

            </div>
               ';
               $last_id = $row->id;
              }
              $output .= '
              <div id="load_more">
               <button type="button" name="load_more_button" class="btn btn-success btn-sm" data-id="'.$last_id.'" id="load_more_button">Load More</button>
              </div>
              ';
             }
             else
             {
              $output .= '
              <div id="load_more">
               <button type="button" name="load_more_button" class="btn btn-info btn-sm" style="display:none">No Data Found</button>
              </div>
              ';
             }
             echo $output;
            }
           }
    }
}
