<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Auth;
class OrderController extends Controller
{
    public function index()
    {
        $orders=DB::table('order')->get();
        return view('admin.order.index',compact('orders'));
    }
    public function detail($id)
    {
        if($check_orderid=DB::table('order')->where('id',$id)->first())
        {
            $detail=DB::table('order')
                ->join('orderdetail','order.id','=','orderdetail.order_id')//->get();
                ->join('product','orderdetail.product_id','=','product.id')
                ->join('discount','orderdetail.discount_id','=','discount.id')
                ->where('order.id', '=', $id)
            ->get()->toArray();
            //dd($detail);
            $info=DB::table('order')
                ->join('orderdetail','order.id','=','orderdetail.order_id')
                ->join('users','order.user_id','=','users.id')
                ->where('order.id', '=', $id)
            ->first();
            return view('admin.order.detail',compact('detail','info'));
        }
        else
            return Redirect()->Route('IndexOrder')->with('message','Không Tìm Thấy Đơn Hàng Phù Hợp');
    }
    public function destroy ($id)
    {
        if($detail=DB::table('order')->where('id',$id)->delete())
        {
            $history=DB::table('history')->insert([
                'name'  => 'Đã thay đổi trang thái đơn hàng',
                'user_id'   =>  Auth::id(),
                'time'      => Carbon::now(),
                'action'    =>  'delete',
                'content'   => 'Đã xóa 1 đơn hàng',
            ]);

            return redirect()->route('IndexOrder')->with('message','Xóa Đơn Hàng Thành Công');
            }
            else
            return back()->with('message','Xóa Không Thành Công');
    }
    public function status($id,Request $request)
    {
        //$a=DB::table('order')->where('id',$id)->get(); dd($a);
        //dd($request->status);
        if($status = DB::table('order')->where('id',$id)->update(['status'=> $request->status]))
        {
            $history=DB::table('history')->insert([
                'name'  => 'Đã thay đổi trang thái loại sản phẩm',
                'user_id'   =>  Auth::id(),
                'time'      => Carbon::now(),
                'action'    =>  'status',
                'content'   => 'Đã thay đổi trang thái loại sản phẩm',
            ]);

            return redirect()->route('IndexOrder')->with('message','Thay Đổi Trạng Thái Thành Công');
            }
            else
            return back()->with('message','Thay Đổi Trạng Thái Thất Bại');
    }
}
