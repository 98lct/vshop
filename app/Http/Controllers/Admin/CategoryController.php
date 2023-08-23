<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use DB;
use Auth;

class CategoryController extends Controller
{
    /*chức năng hiển thị, thùng rát*/
    public function index()
    {
        $categorys = Category::where('status','<>',0)->get();
        $items = Category::where('status','=',0)->get();
        return view('admin.category.index',compact('categorys','items'));
    }
    /*xử lý sửa*/
    public function update(CategoryRequest $request,$id)
    {
        $data=$request->all();
        $data = request()->except(['_method','_token','imgold','submit']);
        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $nameimg = $file->getClientOriginalExtension();
            $hinh = str_slug($data['name']).".".$nameimg;
            while(file_exists("public/upload/category/".$hinh))
            {
                $hinh = str_slug($data['name']).".".$nameimg;
            }
            $file->move("upload/category",$hinh);
            $data['img'] = $hinh;
        }
        if($category=Category::where('id', $id)->update($data))
        {
            $history=DB::table('history')->insert([
                'name'  => 'Đã cập nhật loại sản phẩm',
                'user_id'   =>  Auth::id(),
                'time'      => Carbon::now('Asia/Ho_Chi_Minh'),
                'action'    =>  'edit',
                'content'   => 'Đã cập nhật loại sản phẩm',
            ]);
            return redirect('admin/category')->with('message','Sửa Loại Sản Phẩm Thành Công');
        }
        else
            return back()->with('message','Sửa Loại Sản Phẩm Thất Bại');
    }
    /*hiển thị giao diện sửa*/
    public function edit($id)
    {
        $category = Category::find($id);
        $category_option='';
        $categorys=Category::where(['parent_id'=>0])->get();
        if($category['parent_id']==0)
            $category_option.='<option selected value='.'0'.'>'.'--- Không Có Cấp Cha ---'.'</option>';
        foreach ($categorys as $cat1) {
            if($category['parent_id']==$cat1['id'])
                $category_option.='<option selected value='.$cat1['id'].'>'.$cat1['name'].'</option>';
            else
                if($category['id']!=$cat1['id'])
                    $category_option.='<option value='.$cat1['id'].'>'.$cat1['name'].'</option>';
        }
        return view('admin.category.edit',compact('category','category_option'));
    }
    /*hiển thị giao diện thêm*/
    public function create()
    {
        $category_option='';
        $category=Category::where(['parent_id'=>0])->get();
        foreach ($category as $cat1) {
            $category_option.='<option value='.$cat1['id'].'>'.$cat1['name'].'</option>';
            //$sub_category=Category::where(['parent_id'=>$cat1['id']])->get();
        }
        return view('admin.category.create',compact('category_option'));
    }
    /*xử lý thêm*/
    public function store(CategoryRequest $request)
    {
        $data=$request->all();
        $data = request()->except(['_token']);//loại bỏ các cột dư thừa vì ta sử dung $request->all() // không đặt name cho button type = submit
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $nameimg = $file->getClientOriginalExtension();
            $hinh = str_slug($data['name']).".".$nameimg;
            while(file_exists("public/upload/category/".$hinh))
            {
                $hinh = str_slug($data['name']).".".$nameimg;
            }
            $file->move("upload/category",$hinh);
            $data['img'] = $hinh;
        }
        if($category=Category::insert($data))
        {
            $history=DB::table('history')->insert([
                'name'  => 'Đã thêm loại sản phẩm',
                'user_id'   =>  Auth::id(),
                'time'      => Carbon::now('Asia/Ho_Chi_Minh'),
                'action'    =>  'add',
                'content'   => 'Đã thêm loại sản phẩm',
            ]);
            return redirect('admin/category')->with('message','Thêm Loại Thành Công');

        }
        else
            return back()->with('message','Thêm Loại Thất Bại');
    }
    /*chức năng trạng thái*/
    public function status($id)
    {
        $categorys=Category::where(['id'=> $id])->first();
        $d=0;
        if(($categorys->status)==2)
        {
            $d=1;
            $categorys->status=$d;
        }
        else
        {

            $d=2;
            $categorys->status=$d;
        }
        $categorys->save();
        $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái loại sản phẩm',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now('Asia/Ho_Chi_Minh'),
            'action'    =>  'status',
            'content'   => 'Đã thay đổi trang thái loại sản phẩm',
        ]);
                    return redirect('admin/category')->with('message','Thêm Loại Thành Công');

        return back()->with('message','Thay Đổi Trạng Thái Thành Công');
    }
    /*xóa bỏ vào thùng rát*/
    public function remove($id)
    {
        $categorys=Category::where(['id'=> $id])->first();
             $categorys->status=0;
             $date=date("Y-m-d H:i:s");
              $categorys->updated_at=$date;
           $categorys->save();
           $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái loại sản phẩm',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now('Asia/Ho_Chi_Minh'),
            'action'    =>  'status',
            'content'   => 'Đã thêm vào thùng rát 1 loại sản phẩm',
        ]);
             return  back()->with('message','Bỏ Sọt Thành Công');
    }
    /*khôi phục*/
    public function restore($id)
    {
        $categorys=Category::where(['id'=> $id])->first();
             $categorys->status=1;
             $date=date("Y-m-d H:i:s");
              $categorys->created_at=$date;
           $categorys->save();
           $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái loại sản phẩm',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now('Asia/Ho_Chi_Minh'),
            'action'    =>  'restore',
            'content'   => 'Đã khôi phục 1 loại sản phẩm',
        ]);
        return  back()->with('message','Khôi Phục Thành Công');
    }
    /*xóa vĩnh viễn*/
    public function destroy($id)
    {
        $data = request()->except(['_method','_token','submit']);
        $row=Category::where(['id'=> $id])->first();
        $categorys=Category::where(['id'=> $id])->delete();
        // xóa category con luôn
        $category_sub=Category::where(['parent_id'=> $row['id']])->delete();
        $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái loại sản phẩm',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now('Asia/Ho_Chi_Minh'),
            'action'    =>  'delete',
            'content'   => 'Đã xóa 1 loại sản phẩm',
        ]);
            return  back()->with('message','Đã Xóa Vình Viễn');
    }
}
