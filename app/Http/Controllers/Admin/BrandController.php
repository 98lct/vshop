<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Carbon\Carbon;
use DB;
use Auth;


class BrandController extends Controller
{
    /*xử lý sửa*/
    public function update(BrandRequest $request,$id)
    {
        $data=$request->all();
        $data = request()->except(['_method','_token','imgold','submit']);
        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $nameimg = $file->getClientOriginalExtension();
            $hinh = str_slug($data['name']).".".$nameimg;
            while(file_exists("public/upload/brand/".$hinh))
            {
                $hinh = str_slug($data['name']).".".$nameimg;
            }
            $file->move("upload/brand",$hinh);
            $data['img'] = $hinh;
        }
        if($brand=Brand::where('id', $id)->update($data))
        {
        $history=DB::table('history')->insert([
            'name'  => 'Đã cập nhật thương hiệu',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'edit',
            'content'   => 'Đã cập nhật thương hiệu',
        ]);
            return redirect('admin/brand')->with('message','Sửa Loại Sản Phẩm Thành Công');
        }
            else
            return back()->with('message','Sửa Thương Hiệu Thất Bại');
    }
     /*hiển thị giao diện sửa*/
    public function edit($id)
    {
        $brand = Brand::find($id);
        $brand_option='';
        $brands=Brand::where(['parent_id'=>0])->get();
        if($brand['parent_id']==0)
            $brand_option.='<option selected value='.'0'.'>'.'--- Không Có Cấp Cha ---'.'</option>';
            foreach ($brands as $cat1) {
                if($brand['parent_id']==$cat1['id'])
                    $brand_option.='<option selected value='.$cat1['id'].'>'.$cat1['name'].'</option>';
                else
                    if($brand['id']!=$cat1['id'])
                        $brand_option.='<option value='.$cat1['id'].'>'.$cat1['name'].'</option>';
            }
        return view('admin.brand.edit',compact('brand','brand_option'));
    }
    /*hiển thị giao diện thêm*/
    public function create()
    {

        $brand_option='';
        $brand=Brand::where(['parent_id'=>0])->get();
        foreach ($brand as $cat1) {
            $brand_option.='<option value='.$cat1['id'].'>'.$cat1['name'].'</option>';
            //$sub_category=Category::where(['parent_id'=>$cat1['id']])->get();
        }

        return view('admin.brand.create',compact('brand_option'));
    }
    /*xử lý thêm*/
    public function store(BrandRequest $request)
    {
        $data=$request->all();

        $data = request()->except(['_token']);//loại bỏ các cột dư thừa vì ta sử dung $request->all() // không đặt name cho button type = submit
       if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $nameimg = $file->getClientOriginalExtension();
            $hinh = str_slug($data['name']).".".$nameimg;
            while(file_exists("public/upload/brand/".$hinh))
            {
                $hinh = str_slug($data['name']).".".$nameimg;
            }
            $file->move("upload/brand",$hinh);
            $data['img'] = $hinh;
        }
        if($brand=Brand::insert($data))
        {
            $history=DB::table('history')->insert([
                'name'  => 'Đã thêm thương hiệu sản phẩm',
                'user_id'   =>  Auth::id(),
                'time'      => Carbon::now(),
                'action'    =>  'add',
                'content'   => 'Đã thêm thương hiệu sản phẩm',
            ]);
            return redirect('admin/brand')->with('message','Thêm Loại Thành Công');

        }
        else
            return back()->with('message','Thêm Thương Hiệu Thất Bại');
    }
    /*chức năng hiển thị*/
    public function index()
    {
        $brands = Brand::where('status','<>',0)->get();
        $items = Brand::where('status','=',0)->get();
        return view('admin.brand.index',compact('brands','items'));
    }
    /*Thùng Rát*/
    public function trash()
    {
        //$items =Category::where('status','=',0)->get();
       // $categorys=json_decode(json_encode($categorys));
       // luwu ý trash và index đều trả về 1 trang thì đữ liệu trả về sau return là phải giống nhau y xì 100%
        return view('admin.brand.index',compact('brands'));
    }
    /*chức năng trạng thái*/
    public function status($id)
    {
        $brands=Brand::where(['id'=> $id])->first();
        if(($brands->status)==2)
            $brands->status=1;
        else
            $brands->status=2;
                $brands->save();
        return back()->with('message','Thay Đổi Trạng Thái Thành Công');
    }
    /*xóa bỏ vào thùng rát*/
    public function remove($id)
    {
        $brands=Brand::where(['id'=> $id])->first();
             $brands->status=0;
             $date=date("Y-m-d H:i:s");
              $brands->updated_at=$date;
           $brands->save();
           $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái thương hiệu',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'status',
            'content'   => 'Đã thêm vào thùng rát 1 thương hiệu',
        ]);
             return  back()->with('message','Bỏ Sọt Thành Công');
    }
    /*khôi phục*/
    public function restore($id)
    {
        $brands=Brand::where(['id'=> $id])->first();
             $brands->status=1;
             $date=date("Y-m-d H:i:s");
              $brands->created_at=$date;
           $brands->save();
           $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái thương hiệu',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'restore',
            'content'   => 'Đã khôi phục 1 thương hiệu',
        ]);
        return  back()->with('message','Khôi Phục Thành Công');
    }
    /*xóa vĩnh viễn*/
    public function destroy($id)
    {
        $data = request()->except(['_method','_token','submit']);
        $row=Brand::where(['id'=> $id])->first();
        $brands=Brand::where(['id'=> $id])->delete();
        // xóa category con luôn
        $brand_sub=Brand::where(['parent_id'=> $row['id']])->delete();
        $history=DB::table('history')->insert([
            'name'  => 'Đã thay đổi trang thái thương hiệu',
            'user_id'   =>  Auth::id(),
            'time'      => Carbon::now(),
            'action'    =>  'delete',
            'content'   => 'Đã xóa 1 thương hiệu',
        ]);
            return  back()->with('message','Đã Xóa Vình Viễn');
    }
}

