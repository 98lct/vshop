<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\SliderRequest;
use Carbon\Carbon;
use Auth;

class SliderController extends Controller
{
    public function index()
    {
        $sliders=DB::table('slider')->get();
        return view('admin.slider.index',compact('sliders'));
    }
    public function create()
    {
        return view('admin.slider.create');
    }
    public function store(SliderRequest $request) {
        $data=$request->all();
        $data=Request()->except('_token');
        if($request->hasFile('img'))
        {
            $file=$request->img;
            $nameimg = $file->getClientOriginalExtension();
            $hinh=str_slug($request->name).'.'.$nameimg;
            $file->move("upload/slider",$hinh);
            $data['img']=$hinh;
        }
        else
            $data['img']='no-img.jpg';
        if(DB::table('slider')->insert($data))
            return redirect()->route('IndexSlider')->with('message','Thêm Thành Công');
        else
            return back()->with('message','Thêm Thất Bại');
    }
    public function edit($id)
    {
        $detail=DB::table('slider')->where('id',$id)->first();
        return view('admin.slider.edit',compact('detail'));
    }
    function update(SliderRequest $request,$id) {
        $data=$request->all();

        $data=request()->except(['_token','_method']);
        if($request->hasFile('img'))
        {
            $file=$request->img;
            $nameimg = $file->getClientOriginalExtension();
            $hinh=str_slug($request->name).'.'.$nameimg;
            $file->move("upload/slider",$hinh);
            $data['img']=$hinh;
        }
        if($update=DB::table('slider')->where('id',$id)->update($data))
        {
            $history=DB::table('history')->insert([
            'name'  => 'Đã cập nhật slider',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'edit',
            'content'   => 'Đã cập nhật slider',
        ]);
            return redirect()->route('IndexSlider')->with('message','Sửa Thành Công');
            }
            else
            return back()->with('message','Sửa Thất Bại');
    }
    public function destroy($id){
        if(DB::table('slider')->where('id',$id)->delete())
        {
            $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái slider',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'delete',
            'content'   => 'Đã xóa 1 slider',
        ]);
            return redirect()->route('IndexSlider')->with('message','Xóa Thành Công');
            }
            else
            return back()->with('message','Xóa Thất Bại');
    }
    public function status($id) {
        $status=DB::table('slider')->where('id',$id)->value('status');
        $status = ($status=='1') ? 0 : 1 ;
        if($slider=DB::table('slider')->where('id',$id)->update(['status'=>$status]))
        {
        $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái slider',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'status',
            'content'   => 'Đã thay đổi trang thái slider',
        ]);
            return redirect()->route('IndexSlider')->with('message','Thay Đổi Trạng Thái Thành Công');
        }
            else
            return back()->with('message','Thay Đổi Trạng Thái Thất Bại');
    }
}
