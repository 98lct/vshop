<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Excel;

class ExportExcelController extends Controller
{
	function index($id)
	{
		//dd((DB::table('order')->get()));
		$bill = DB::table('order')
		->join('orderdetail','order.id','=','orderdetail.order_id')
		->join('users','users.id','=','order.user_id')
		->join('product','product.id','=','orderdetail.product_id')
		->join('discount','discount.id','=','orderdetail.discount_id')
		->select('order.code as code','users.name as u_name','product.name as p_name','fullname','phone','discount.code as d_code','discount','quantity','orderdetail.price as price','orderdetail.amount as amount','transport_cost','order.address as u_address')
		->get();dd($bill);
		return view('export_bill',compact('bill'));
	}
	function export($id)
	{
		$bill = DB::table('order')
		->join('orderdetail','order.id','=','orderdetail.order_id')
		->join('users','users.id','=','order.user_id')
		->join('product','product.id','=','orderdetail.product_id')
		->join('discount','discount.id','=','orderdetail.discount_id')
		->where('order.id',$id)
		->select('order.code as code','users.name as u_name','product.name as p_name','fullname','phone','discount.code as d_code','discount','quantity','orderdetail.price as price','orderdetail.amount as amount','transport_cost','order.address as u_address','order.phone as sdt','order.email as email')
		->get()->toArray();
		
		$exl=[];
		$exl[]=[
			'0' => 'Tên KH',
			'1' => 'Địa Chỉ',
			'2'  => 'Email',
			'3' => 'Số ĐT',
		];
		$exl[]=[
			$bill[0]->u_name,
			$bill[0]->u_address,
			$bill[0]->email,
			$bill[0]->sdt,
		];
		$exl[]=
		[
			'0'=>'STT',
			'1'=>'Tên SP',
			'2'=>'Giá SP',
			'3'=>'SL',
			'4'=>'Tổng Cộng'
		];
		$sum=0;$tong=0;$giamgia=0;$phi=0;
		foreach ($bill as $k => $b) {

			$exl[] = array(
				'STT'   => ++$k,
				'Tên SP'  => $b->p_name,
				'Giá SP'   => $b->price,
				'SL'    => $b->quantity,
				'Tổng Cộng'  => $sum=$b->amount,

			);
			$tong+=$sum;
			$giamgia=$b->discount;
			$phi=$b->transport_cost;
		}

		$exl[]=
		[
			'Thành Tiền'=> ((float)$tong + (float)$phi-(float)$giamgia),

		];
		Excel::create('Bill', function($excel) use ($exl){
			$excel->setTitle('Bill');
			$excel->sheet('Bill', function($sheet) use ($exl){
				$sheet->fromArray($exl, null, 'A1', false, false);
			});
		})->download('xlsx');
		return back();
	}
}
