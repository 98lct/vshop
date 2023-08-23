<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
		->select('order.code as code','users.name as u_name','product.name as p_name','fullname','phone','discount.code as d_code','discount','quantity','orderdetail.price as price','orderdetail.amount as amount','transport_cost','order.address as u_address')
		->get();dd($bill);

	}
}
