<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Cart;
use DB;
use Validator ;
use Carbon\Carbon;


class CheckOutController extends Controller
{
    public function index(Request $request)
    {
        $city=DB::table('city')->get();
        $cart=Cart::content();
        return view('guest.shopcart-thanhtoan',compact('cart','city'));

    }
    public function laykm(Request $request)
    {
        if($request->discount!=null){

            $makm=DB::table('discount')->where([
                ['code',$request->discount],
                ['limit','>',0],
                ['status','<>',0],
            ])->first();
            if($makm==null){
                return response()->json([
                    'makm'    => true,
                    'message'   =>['makm'=>'Mã giảm giá không tồn tại hoặc đã được sử dụng '],
                ]);
            }
            else{
            $ngayhomnay = date("Y-m-d"); //Lấy thời gian hiện tại 
            $ngaysosanh=$makm->expiration; // Năm/Tháng/Ngày

            if (strtotime($ngayhomnay) > strtotime($ngaysosanh)) {
                return response()->json([
                    'makm'    => true,
                    'result'   =>'Mã giảm giá đã hết hạn sử dụng ',
                ]);
            }
            else{
                return response()->json([
                    'makm'   =>false,
                    'detail'    => ['vvv'=>$makm->discount],
                ]);
            }
        }
    }
}
public function diachi(Request $request)
{
    if($request->city || $request->discount){
        $areas=DB::table('area')->where('city_id',$request->city)->get();
        $cost=DB::table('city')->where('id',$request->city)->select('cost')->first();
        $option='';
        $option.='<option value="0"> --- Chọn quận huyện ---</option>';
        foreach($areas as $area){
            $option.='<option value="'.$area->id.'">'.$area->name.'</option>';
        }
        
        
            $gia=str_replace(',','',Cart::total());
            number_format($gia=(double)$gia);
            return response()->json([
                'error' => false,
                'result'    =>['area'=>$option,'cost'=>$cost->cost,'gia'=>$gia,],
            ]);
        }
    }
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address'   => 'required',
            'method'    =>'required',
            'area'  =>'required',
            'city'  => 'required'
        ],
        [
            'required' => ':attribute Không được để trống',
            'email' => ':attribute không hợp lệ',
            'numeric' => ':attribute Không hợp lệ',
        ]);

        if ($validator->fails() ) {
            return response()->json([
                'errors'    => true,
                'message'   =>$validator->errors(),
            ]);
        }
        else{

            if($request->discount!=null){
                $makm=DB::table('discount')->where([
                    ['code',$request->discount],
                    ['limit','>',0],
                    ['status','<>',0],
                ])->first();
                if($makm==null){
                    return response()->json([
                        'makm'    => true,
                        'message'   =>['makm'=>'Mã giảm giá không tồn tại hoặc đã được sử dụng '],
                    ]);
                }
                else{
                    $ngayhomnay = date("Y-m-d"); //Lấy thời gian hiện tại 
                    $ngaysosanh=$makm->expiration; // Năm/Tháng/Ngày

                    if (strtotime($ngayhomnay) > strtotime($ngaysosanh)) {
                        return response()->json([
                            'makm'    => true,
                            'result'   =>'Mã giảm giá đã hết hạn sử dụng ',
                        ]);
                    }
                    
                }
            }
            $city=DB::table('city')->where('id',$request->city)->select('name','cost')->first();
            $area=DB::table('area')->where('id',$request->area)->select('name')->first();
            $rand=rand();
            $order=DB::table('order')
            ->join('orderdetail','orderdetail.order_id','order.id')
            ->insert([
                'status'    => 1,
                'code'      =>$rand,
                'user_id'   => Auth::id(),
                'phone'     =>$request->phone,
                'email'     => $request->email,
                'fullname'  =>$request->name,
                'address'    => $city->name.', '.$area->name.', '.$request->address,
                'method'    =>$request->method,
                'note'      =>($request->note!=null)?$request->note:'',
                'created_at'    =>Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at'    =>Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            $order_id=DB::table('order')->orderBy('id','desc')->select('id')->first();
            $c=Cart::content();
            foreach ($c as $key => $value) {
                $order_detail=DB::table('orderdetail')->insert([
                    'product_id'=>$value->id,
                    'order_id'=>$order_id->id,
                    'quantity'=>$value->qty,
                    'price' => $value->price,
                    'transport_cost' => $city->cost,
                    'discount_id'=>($request->discount!=null)?$makm->id:'1',
                    'amount'    =>($value->qty * $value->price),
                ]);
            }
            cart::destroy();
            return response()->json([
                'success'=>true,
                'url'=>'/',
            ]);  
        }
    }
}