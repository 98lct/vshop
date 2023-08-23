<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\MenuRequest;
use Carbon\Carbon;
use Auth;
class MenuController extends Controller
{
    public function index()
    {
        $menus=DB::table('menu')->get();
        return view('admin.menu.index',compact('menus'));
    }
    public function create()
    {
        $menu_option="";
        $menu=DB::table('menu')->where('parent_id',0)->get();
        foreach ($menu as $key => $value) {
            $menu_option.="<option value='".$value->id."'>".$value->name."</option>";
        }
        return view('admin.menu.create',compact('menu_option'));
    }
    public function store(MenuRequest $request) {
        $data=$request->all();
        $data=Request()->except('_token');
        if($request->hasFile('img'))
        {
            $file=$request->img;
            $nameimg = $file->getClientOriginalExtension();
            $hinh=str_slug($request->name).'.'.$nameimg;
            $file->move("upload/menu",$hinh);
            $data['img']=$hinh;
        }
        if(DB::table('menu')->insert($data))
            return redirect('admin/menu')->with('message','Thêm Thành Công');
        else
            return back()->with('message','Thêm Thất Bại');
    }
    public function edit($id)
    {
        $detail=DB::table('menu')->where('id',$id)->first();
        $menus=DB::table('menu')->where('parent_id',0)->get();
        $menu_option="";
        if($detail->parent_id =='0')
            $menu_option.="<option selected value='0'>------Không Có Cấp Cha-----</option>";
        foreach ($menus as $menu) {
            if($menu->parent_id==$detail->id)
                $menu_option.="<option selected value='".$menu->id."'>".$menu->name."</option>";
            else
            {

                if($detail->id != $menu->id )
                    $menu_option.="<option value='".$menu->id."'>".$menu->name."</option>";
            }
        };

        return view('admin.menu.edit',compact('detail','menu_option'));
    }
    function update(MenuRequest $request,$id) {
        $data=$request->all();
        $data=request()->except(['_token','_method']);
        if($request->hasFile('img'))
        {
            $file=$request->img;
            $nameimg = $file->getClientOriginalExtension();
            $hinh=str_slug($request->name).'.'.$nameimg;
            $file->move("upload/menu",$hinh);
            $data['img']=$hinh;
        }
        else
            $data['img']='no-img.jpg';
        if($menu=DB::table('menu')->where('id',$id)->update($data))
        {
            $history=DB::table('history')->insert([
                'name'  => 'Đã cập nhật menu',
                'user_id'   =>  Auth::id(),
                'time'      => Carbon::now(),
                'action'    =>  'edit',
                'content'   => 'Đã cập nhật menu',
            ]);

            return redirect()->route('IndexMenu')->with('message','Sửa Thành Công');
        }
        else
            return back()->with('message','Sửa Thất Bại');
    }
    public function destroy($id){
        if(DB::table('menu')->where('id',$id)->delete())
        {
        $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái menu',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'delete',
            'content'   => 'Đã xóa 1 menu',
        ]);
            return redirect()->route('IndexMenu')->with('message','Xóa Thành Công');
        }
        else

            return back()->with('message','Xóa Thất Bại');
    }
    public function status($id) {

        $status=DB::table('menu')->where('id',$id)->value('status');
        $status = ($status=='1') ? 0 : 1 ;
        if($menu=DB::table('menu')->where('id',$id)->update(['status'=>$status]))
        {
        $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái loại sản phẩm',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'status',
            'content'   => 'Đã thay đổi trang thái loại sản phẩm',
        ]);
            return redirect()->route('IndexMenu')->with('message','Thay Đổi Trạng Thái Thành Công');
        }
        else
            return back()->with('message','Thay Đổi Trạng Thái Thất Bại');
    }
}
