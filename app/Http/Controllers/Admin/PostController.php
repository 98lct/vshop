<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Topic;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Carbon\Carbon;

use Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {   if($request->Ismethod('post'))
        {
             if($request->type)
            {
                $type=$request->type;
                $posts=Post::with('topic')->where('type',$type)->get();
                return view('admin.post.index',compact('posts'));
            }
        }
        //dd($request->all());

        else
        {
            $posts=Post::with('topic')->get(); return view('admin.post.index',compact('posts'));
        }

    }
    public function create()
    {
        $Topic_option="";
        $topics=DB::table('topic')->where('status','<>',0)->get();
        foreach ($topics as $topic) {
            $Topic_option.="<option value='".$topic->id."'>".$topic->name."</option>";
        }
        return view('admin.post.create',compact('Topic_option'));
    }
    public function store(PostRequest $request)
    {
        $data=$request->all();
        $data=request()->except('_token');
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $nameimg = $file->getClientOriginalExtension();
            $hinh = str_slug($data['title']).".".$nameimg;
            while(file_exists("public/upload/post/".$hinh))
            {
                $hinh = str_slug($data['title']).".".$nameimg;
            }
            $file->move("upload/post",$hinh);
            $data['img'] = $hinh;
        }
        else
        {
            $data['img'] = 'no-img.png';
        }
        if($post=DB::table('post')->insert($data))
            return redirect('admin/post')->with('message','Thêm Thành Công');
        else
            return back()->with('message','Thêm Thất Bại');
    }
    public function edit($id)
    {
        $detail=DB::table('post')->where('id',$id)->first();
        $Topic_option="";
        $topics=DB::table('topic')->where('status','<>',0)->get();

        foreach ($topics as $topic) {
            if($detail->topic_id == $topic->id)
                $Topic_option.="<option selected value='".$topic->id."'>".$topic->name."</option>";
            $Topic_option.="<option value='".$topic->id."'>".$topic->name."</option>";
        }
        return view('admin.post.edit',compact('detail','Topic_option'));
    }
    public function update(PostRequest $request,$id)
    {
        $data=$request->all();
        $data = request()->except(['_method','_token','imgold','submit']);
        $data['updated_at']=date('Y-m-d H:i:s');
        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $nameimg = $file->getClientOriginalExtension();
            $hinh = str_slug($data['name']).".".$nameimg;
            while(file_exists("public/upload/topic/".$hinh))
            {
                $hinh = str_slug($data['name']).".".$nameimg;
            }
            $file->move("upload/topic",$hinh);
            $data['img'] = $hinh;
        }
        if($topic=DB::table('post')->where('id', $id)->update($data))
        {
        $history=DB::table('history')->insert([
            'name'  => 'Đã cập nhật loại sản phẩm',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'edit',
            'content'   => 'Đã cập nhật loại sản phẩm',
        ]);
            return redirect('admin/post')->with('message','Sửa Thành Công');
        }
        else
            return back()->with('message','Sửa Thất Bại');
    }
    public function status($id)
    {
        $status=DB::table('post')->where('id',$id)->value('status');
        $status = ($status=='1') ? 2 : 1 ;
        if($slider=DB::table('post')->where('id',$id)->update(['status'=>$status]))
        $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái bài viết',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'status',
            'content'   => 'Đã thay đổi trang thái bài viết',
        ]);
            return redirect('admin/post')->with('message','Thay Đổi Trạng Thái Thành Công');
    }
    public function destroy($id){
        if(DB::table('post')->where('id',$id)->delete())
        {
        $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái bài viết',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'delete',
            'content'   => 'Đã xóa 1 bài viết',
        ]);
            return redirect('admin/post')->with('message','Xóa Thành Công');
        }
        else
            return back()->with('message','Xóa Thất Bại');
    }
}
