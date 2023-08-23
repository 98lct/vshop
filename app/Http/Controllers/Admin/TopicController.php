<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

use Auth;
class TopicController extends Controller
{
    public function index()
    {
        $topics=DB::table('topic')->get();
        return view('admin.topic.index',compact('topics'));
    }
    public function create()
    {
        return view('admin.topic.create');
    }
    public function store(Request $request)
    {
        $data=$request->all();
        $data=request()->except('_token');
        $data['created_at']=date('Y-m-d H:i:s');
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
        if($category=DB::table('topic')->insert($data))
            return redirect('admin/topic')->with('message','Thêm Thành Công');
        else
            return back()->with('message','Thêm Thất Bại');
    }
    public function edit($id)
    {
        $detail=DB::table('topic')->where('id',$id)->first();

        return view('admin.topic.edit',compact('detail'));
    }
    public function update(Request $request,$id)
    {
        $data=$request->all();
        $data = request()->except(['_method','_token','imgold','submit']);
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
        $data['updated_at']=date('Y-m-d H:i:s');
        if($category=DB::table('topic')->where('id', $id)->update($data))
        {
        $history=DB::table('history')->insert([
            'name'  => 'Đã cập nhật chủ đề',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'edit',
            'content'   => 'Đã cập nhật chủ đề',
        ]);
            return redirect('admin/topic')->with('message','Sửa Chủ Đề Thành Công');
    }
            else
            return back()->with('message','Sửa Chủ Đề Thất Bại');
    }
    public function status($id)
    {
        $status=DB::table('topic')->where('id',$id)->value('status');
        $status = ($status=='1') ? 2 : 1 ;
        if($slider=DB::table('topic')->where('id',$id)->update(['status'=>$status]))
        $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái chủ đề',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'status',
            'content'   => 'Đã thay đổi trang thái củ đề',
        ]);
            return redirect('admin/topic')->with('message','Thay Đổi Trạng Thái Thành Công');
    }
    public function destroy($id){
        if(DB::table('topic')->where('id',$id)->delete())
        {$history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái chủ đề',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'delete',
            'content'   => 'Đã xóa 1 chủ đề',
        ]);
            return redirect('admin/topic')->with('message','Xóa Thành Công');
        }
            else
            return back()->with('message','Xóa Thất Bại');
    }
}
