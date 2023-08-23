<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;
use Hash;
use Carbon\Carbon;
use DB;
use Auth;
class UserController extends Controller
{
   public function index()
   {
   		$user_list=User::all();
    	return view('admin.user.index',compact('user_list'));
   }
   public function create()
   {
   		return view('admin.user.create');
   }
   public function store(UserRequest $request)
   {
   		$data=$request->all();
   		$data = request()->except(['_token','password_confirm']);
   		if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $nameimg = $file->getClientOriginalExtension();
            $hinh = str_slug($data['name']).".".$nameimg;
            while(file_exists("public/upload/user/".$hinh))
            {
                $hinh = str_slug($data['name']).".".$nameimg;
            }
            $file->move("upload/user",$hinh);
            $data['img'] = $hinh;
        }
        else
        {
        	$data['img']="no-image.jpg";
        }
        if($request->password == $request->password_confirm)
    	{
    		$data['password']=Hash::make($request['password']);
            //dd($data['password']);
    		User::Insert($data);
			return redirect('admin/user')->with('message','Thêm Người Dùng Thành Công');
    	}
        else
        	return back()->with('message','Mật Khẩu Nhập Chưa Đúng');
   }
   public function roles($id)
   {
       $user=User::find($id);
       if ($user->roles=='admin')
            $user->roles='member' ;
        else
            $user->roles='admin';
        $user->save();
            return redirect()->back()->with('message','Thay Đổi Quyền Thành Công');
   }
   public function edit($id)
   {
        $user=User::find($id);
       return view('admin.user.edit',compact('user'));
   }
   public function update(UserRequest $request, $id)
   {
        $data=$request->all();
        $data = request()->except(['_method','_token','imgold','submit','password_confirm']);
        if($request->password == $request->password_confirm)
        {
            $data['password']=Hash::make($request['password']);
            if($request->hasFile('img'))
            {
                $file = $request->file('img');
                $nameimg = $file->getClientOriginalExtension();
                $hinh = str_slug($data['name']).".".$nameimg;
                while(file_exists("public/upload/user/".$hinh))
                {
                    $hinh = str_slug($data['name']).".".$nameimg;
                }
                $file->move("upload/user",$hinh);
                $data['img'] = $hinh;
            }
            if($user=User::where('id', $id)->update($data))
            {$history=DB::table('history')->insert([
                'name'  => 'Đã cập nhật người dùng',
                'user_id'   =>  Auth::id(),
                'time'      => Carbon::now(),
                'action'    =>  'edit',
                'content'   => 'Đã cập nhật người dùng',
            ]);
                return redirect('admin/user')->with('message','Sửa Người Dùng Thành Công');
            }
                else
                return back()->with('message','Sửa Người Dùng Thất Bại');
        }
        else
            return back()->with('message','Mật Khẩu Nhập Chưa Đúng');
   }
   public function destroy($id)
   {
       if($user=User::where(['id'=> $id])->delete())
       $history=DB::table('history')->insert([
        'name'  => 'Đã thay đổi trang thái loại sản phẩm',
        'user_id'   =>  Auth::id(),
        'time'      => Carbon::now(),
        'action'    =>  'delete',
        'content'   => 'Đã xóa 1 loại sản phẩm',
    ]);
            return redirect('admin/user')->with('message','Xóa Người Dùng Thành Công');
   }
}
