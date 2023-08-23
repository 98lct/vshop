<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\AdvertsRequest;

class AdvertsController extends Controller
{
    public function index()
    {
        $adverts=DB::table('adverts')->get();
        return view('admin.adverts.index',compact('adverts'));
    }
    public function create()
    {
        return view('admin.adverts.create');
    }
    public function store(AdvertsRequest $request) {
        $data=$request->all();
        $data=Request()->except('_token');
        if($request->hasFile('img'))
        {
            $file=$request->img;
            $nameimg = $file->getClientOriginalExtension();
            $hinh=str_slug($request->name).'.'.$nameimg;
            $file->move("upload/adverts",$hinh);
            $data['img']=$hinh;
        }
        else
            $data['img']='no-img.jpg';
        if(DB::table('adverts')->insert($data))
            return redirect()->route('IndexAdverts')->with('message','Thêm Thành Công');
        else
            return back()->with('message','Thêm Thất Bại');
    }
    public function edit($id)
    {
        $detail=DB::table('adverts')->where('id',$id)->first();
        return view('admin.adverts.edit',compact('detail'));
    }
    function update(AdvertsRequest $request,$id) {
        $data=$request->all();
       
        $data=request()->except(['_token','_method']);
        if($request->hasFile('img'))
        {
            $file=$request->img;
            $nameimg = $file->getClientOriginalExtension();
            $hinh=str_slug($request->name).'.'.$nameimg;
            $file->move("upload/adverts",$hinh);
            $data['img']=$hinh;
        }
        if($update=DB::table('adverts')->where('id',$id)->update($data))
            return redirect()->route('IndexAdverts')->with('message','Sửa Thành Công');
        else
            return back()->with('message','Sửa Thất Bại');
    }
    public function destroy($id){
        if(DB::table('adverts')->where('id',$id)->delete())
            return redirect()->route('IndexAdverts')->with('message','Xóa Thành Công');
        else
            return back()->with('message','Xóa Thất Bại');
    }
    public function status($id) {
        $status=DB::table('adverts')->where('id',$id)->value('status');
        $status = (1) ? 0 : 1 ;
        if($adverts=DB::table('adverts')->where('id',$id)->update(['status'=>$status]))
            return redirect()->route('IndexAdverts')->with('message','Thay Đổi Trạng Thái Thành Công');
        else
            return back()->with('message','Thay Đổi Trạng Thái Thất Bại');
    }
}
