<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;
class PDFController extends Controller
{
	function pdf($id)
	{
		$pdf = \App::make('dompdf.wrapper');
		//dd($this->render($id));
		//die;
		$pdf->loadHTML($this->render($id));
		return $pdf->stream();

	}


	public function render($id)
	{
		
		$detail=DB::table('order')
			->join('orderdetail','order.id','=','orderdetail.order_id')//->get();
			->join('product','orderdetail.product_id','=','product.id')
			->join('discount','orderdetail.discount_id','=','discount.id')
			->where('order.id', '=', $id)
			->get()->toArray();

			$info=DB::table('order')
			->join('orderdetail','order.id','=','orderdetail.order_id')
			->join('users','order.user_id','=','users.id')
			->where('order.id', '=', $id)
			->first();
			
			$output='';
			$output.='<h2 class="text-center">V-shop Company--- Your Order</h2>
			';
			$output .= '<h4>Code: <strong><i>'.$info->code.'</i></strong></h4>';
			$output .= '<h4>Fullname: <strong><i>'.$info->fullname.'</i></strong></h4>';
			$output .= '<h4>Email: <strong><i>'.$info->email.'</i></strong></h4>';
			$output .= '<h4>Phone: <strong><i>'.$info->phone.'</i></strong></h4>';
			$output .= '<h4>Method: <strong><i>'.$info->method.'</i></strong></h4>';
			$output .= '<h4>Address: <strong><i>'.$info->address.'</i></strong></h4>';
			$output .= '<h4>Note: <strong><i>'.$info->note.'</i></strong></h4>';
			$output .= '<h4>Date: <strong><i>'.$info->created_at.'</i></strong></h4>';
			$output .= '<div>';
			$output .= '<p>Detail:</p>';
			$output .= '<table class="table table-bordered table-stripe">';
			$output .= '<thead class="table-dark">';
			$output .= ' <th>#STT</th>';
			$output .= '  <th>Name</th>';
			$output .= '   <th>Price</th>';
			$output .= '   <th>Qty</th>';
			$output .= '   <th>Amout</th>';
			$output .= '    </thead>';
			$output .= '    <tbody>';
			$i=1; $sum=0;$tong=0;
			foreach($detail as $value){
				$output .= '<tr>';
				$output .= '<td>'.$i++.'</td>';
				$output .= '<td>'.$value->name.'</td>';
				$output .= '<td>'.number_format($value->price).'</td>';
				$output .= '<td>'.$value->quantity.'</td>';
				$output .= '<td>'.$sum =$value->price * $value->quantity; $tong+=$sum; number_format($sum).'</td>';
				$giamgia =$value->discount;
				$phivanchuyen =$value->transport_cost;
				$output .= '</tr>';

			}

			$output .= '<tr>';
			$output .= '<td>Sum</td>';
			$output .= '	<td colspan="4" align="right" class="text-danger"><strong>'.number_format($tong) . ' VND</strong>';
			$output .= '</td>';
			$output .= '</tr>';
			$output .= '<tr>';
			$output .= '	<td>Ship Cost</td>';
			$output .= '	<td colspan="4" align="right" class="text-danger"><strong>'.number_format($phivanchuyen) . ' VND</strong></td>';
			$output .= '	</tr>';
			$output .= '<tr>';
			$output .= '	<td>Price Sub</td>';
			$output .= '	<td colspan="4" align="right" class="text-danger"><strong>'.number_format($giamgia) .' VND</strong></td>';
			$output .= '</tr>';
			$output .= '<tr>';
			$output .= '	<td>Total</td>';
			$output .= '	<td colspan="4" align="right" class="text-danger"><strong>'.number_format($tong-$giamgia+$phivanchuyen) . ' VN</strong></td>';
			$output .= '</tr>';
			$output .= '</tbody>';
			$output .= '</table>';
			return $output;

		}

	}
