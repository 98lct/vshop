
@extends('layouts.guest')
@section('title',' Thanh Toán')
@section('main')
<style>
	#is-error{
		border-color: #dc3545;
		width: 100%;
		margin-top: .25rem;
		font-size: 80%;
		color: #dc3545;
	}
	.box-form {
		border: solid 1px #ccc;
		margin-bottom: 10px;
		margin-top: 15px;
	}
	.box-form {
		margin-bottom: 10px;
		margin-top: 15px;
		border-width: 1px;
		border-style: solid;
		border-color: rgb(204, 204, 204);
		border-image: initial;
		
	}
	.box-form .title-form {
		height: 40px;
		line-height: 40px;
		border-bottom: solid 1px #ccc;
		border-left: solid 5px rgb(0,155,226);
		padding-left: 10px;
		margin-bottom: 10px;
		border-top: solid 1px #ccc;
		background: #F4F4F4;
		text-transform: uppercase;
	}
	.pad-contact {
		margin-top: 2%;
		padding: 0 10px;
		
	}
	.pad-contact .form-control {
		display: block;
		width: 100%;
		height: 34px;
		padding: 6px 12px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #555;
		border-radius: 0px;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;

		}.clear.height {
			margin: 10px 0px;
		}
		.clear{
			clear: both;
		}
		.box_dh {
			/* border: solid 1px #ccc; */
			margin-bottom: 10px;
		}
		.box_dh .title-dh {
			height: 40px;
			margin-top: 15px;
			line-height: 40px;
			border: solid 1px #ccc;
			border-left: solid 5px #f37021;
			padding-left: 10px;
			margin-bottom: 10px;
			background: #F4F4F4;
			text-transform: uppercase;
		}
		.total-order {
			height: 30px;
			text-align: right;
			font-family: fontavo;
			/* border-bottom: solid 1px #ccc; */
			margin-bottom: 10px;
			line-height: 30px;
			font-size: 16px;
		}
		b {
			font-family: robotobold;
		}
		.error{
			color: red;
			margin: 5px 0;
			font-style: italic;
			font-size: 13px
		}

	</style>
	<div class="block">
		<div class="container">
			<h3 class="text-center">THANH TOÁN</h3>
			@if(Auth::check() && cart::count()>0)
			<form action="" method="POST">
				<div class="row">
					@csrf
					<div class="col-md-4">
						<div class="box-form">
							<div class="title-form">Thông tin nhận hàng</div>

							<div class="pad-contact row">
								<div class="col-md-4 col-sm-4 col-xs-12 ">Họ và tên:</div>
								<div class="col-md-8 col-sm-8 col-xs-12"><input type="text" class="form-control"  placeholder="Họ và tên" value=""  name="name" ><p class="error name"></p>
								</div>
								<div class="clear"></div>

							</div>
							<div class="pad-contact row">
								<div class="col-md-4 col-sm-4 col-xs-12 ">Địa chỉ:</div>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<div class="pad-contact">
										<select name="city" class="input form-control">
											<option value=""> --- Chọn tỉnh thành phố ---</option>
											@foreach($city as $c)
											<option value="{{$c->id}}">{{$c->name}}</option>
											@endforeach

										</select>
									</div>
									<div class="pad-contact">
										<select name="area" class="input form-control">
											<option value="0"> --- Chọn quận huyện ---</option>

										</select>
									</div>
									<div class="pad-contact">
										<textarea name="address" class="form-control"></textarea>
										<p class="error address"></p>
									</div>
								</div>
								<div class="clear"></div>

							</div>

							<div class="pad-contact row">
								<div class="col-md-4 col-sm-4 col-xs-12 ">Điện thoại:</div>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<div class="col-xs-12">
										<input type="tel" pattern="[0][0-9]{9,10}" min="10" max="13" class="form-control" name="phone" id="" placeholder="Điện thoại" value=""  ><p class="error phone"></p>
									</div>

								</div>

							</div>
							<div class="pad-contact row">
								<div class="col-md-4 col-sm-4 col-xs-12 ">Email:</div>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<div class="col-xs-12">
										<input type="email"  class="form-control" name="email" id="" placeholder="Email" value=""  ><p class="error email"></p>
									</div>

								</div>

							</div>
							<div class="clear height"></div>
						</div>
						<div class="box-form">
							<div class="title-form">Ghi chú đơn hàng</div>
							<div style="padding: 10px">
								<div class="pad-contact">
									<textarea name="note" class="form-control" rows="3" maxlength="250" id="note"></textarea>
									<p class="error note"></p>

								</div>

							</div>
						</div>
					</div>
					<div class="col-md-8 col-sm-7 col-xs-12">
						<div class="method">
							<div class="box-form">
								<div class="title-form">Hình thức thanh toán</div>
								<div class="pad-contact" style="padding: 10px;">
									<input id="thanhtoan2" value="trả sau" class="checkbox_search thanhtoan2" type="radio" name="method"><label for="thanhtoan2"> <span></span> Thu tiền khi giao hàng. </label><br>
									<input id="thanhtoan3" class="checkbox_search thanhtoan2" type="radio" checked="" name="method" value="trả trước"><label for="thanhtoan3"> <span></span> Chuyển khoản ngân hàng </label><br>
									<div class="clear"></div>
									<div class="col-sm-12"><p class="error method"></p></div>
									<div class="title-form">Bạn có mã giảm giá???</div>
									<div class="pad-contact" style="padding: 10px;">
										<input type="text" class="form-control" name="discount"  placeholder="Nhập Mã Giảm Giá"><p class="error discount">

										</div>

									</div>
								</div>
							</div>
							<div class="box_dh">
								<div class="title-dh">
								Thông tin đơn hàng                     </div>
								<div class="table-responsive hidden-sm hidden-xs">
									<table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:13px;" width="100%">
										<tbody><tr style="font-weight:bold;font-weight:bold">
											<th style="; text-align:left; padding-left: 40px; text-transform:uppercase;">Sản phẩm</th>
											<th align="center" style="text-transform:uppercase;">Số lượng</th>
											<th align="center" style="text-transform:uppercase;">Giá gốc</th>


											<th align="center" style="text-transform:uppercase;">Thành tiền </th>

										</tr>    
										@foreach($cart as $item)                                
										<tr style="background:#fff;padding:4px 0; color: #000">
											<td width="30%" style=" text-align:left">
												<img src="{{asset('upload/product/'.$item->options->img)}}" height="30px" alt="{{$item->options->img}}" style="margin-right:30px">
												{{ $item->name }} 
											</td>
											<td width="10%" align="center">{{$item->qty}}</td>                  
											<td width="10%" align="center">{{ number_format($item->price)}}&nbsp;VNĐ</td>

											<td width="10%" align="center" class="price_tt">{{ number_format($item->subtotal)}}&nbsp;VNĐ</td>

										</tr>
										@endforeach
									</tbody></table>
								</div>
								<!--mobile -->



								<!--end -->
								<div class="total-order">
									<b>Tiền hàng: <span class="last">{{number_format(str_replace(',','',Cart::total()))}}</span> VNĐ
									</b>
								</div>
								<div class="total-order">
									<b>Phí vận chuyển: <span class="last_sp"></span>VNĐ
									</b>
									<input type="hidden" value="" name ="transport_cost">
								</div>
								<div class="total-order">
									<b>Giảm Giá: <span class="giamgia"></span>VNĐ
									</b>
								</div>
								<div class="total-order">
									<b>Thanh toán: <span class="last_tt"></span>VNĐ
									</b>
								</div>
								<div class="pad-contact text-right">
									<button type="button" class="btn btn-sm btn-success btn-thanhtoan">Đặt hàng </button>
								</div>

							</div>


							<!-- Tham biến thanh toán paypal -->


						</div>
					</div>
				</div>
			</form>
			@else
			@if(!Auth::check())
			<h3>Bạn Chưa Đăng Nhập.</h3>
			<p>nhấn vào <a href="{{route('login')}}">đây</a> để đăng nhập</p>
			@else
			<h3>Giỏ Hàng Đang Trống.</h3>
			<p>nhấn vào <a href="{{route('Home')}}">đây</a> để quay lại</p>
			@endif
			@endif
		</div>
	</div>
	<script>
		$('document').ready(function(){
			var city;
			$('select[name="city"]').change(function() {
				city=$(this).val();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				});
				$.ajax({
					url:"{{route('diachi.checkout')}}",
					method:'POST',
					data: {
						city:city
					},
					success:function(data){
						if($('select[name="city"]').val()==0){
							$('span.last_sp').html("");

						}
						$('span.last').html(data.result.gia);
						$('select[name="area"]').html(data.result.area);
						$('span.last_sp').html(data.result.cost);
						$('input[name="giagoc"]').val()
						$('span.last_tt').html((data.result.gia)+(data.result.cost))
					},
				});
			});

			$('input[name="discount"]').change(function(){
				var discount=$(this).val();
				$('.discount').html('');
				$('input[name="discount"]').removeAttr('id','is-error');
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				});
				$.ajax({
					url:"{{route('laykm.checkout')}}",
					method:'POST',
					data: {
						discount:discount
					},
					success:function(data){
						if($('input[name="discount"]').val()==null){
							$('span.giamgia').html('');
						}
						if(data.makm==true){
							if(data.message.makm !=undefined){
								$('input[name="discount"]').attr('id','is-error');
								$('span.giamgia').html('');
								$('.discount').show();
								$('.discount').html(data.message.makm);
							}
						}
						else{
					// if(data.result==true){
					// 	console.log(data);
					//console.log(data.detail);
					$('span.giamgia').html(data.detail.vvv)
				}
			}
		})
			})

			$('.error').hide();
			$('.address_home').hide();
			$('.address').hide();
			$('input,textarea,select').removeAttr('id');

			$('.btn-thanhtoan').click(function(){
				$('.error').html('');
				var name=$('input[name="name"]').val();
				var phone=$('input[name="phone"]').val();
				var method=$('input[name="method"]').val();
				var discount=$('input[name="discount"]').val();
				var address=$('textarea[name="address"]').val();
				var email=$('input[name="email"]').val();
				var note=$('textarea[name="note"]').val();
				var city=$('select[name="city"]').val();
				var area=$('select[name="area"]').val();
				var transport_cost=$('input[name="transport_cost"]').val();

				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				});
				$.ajax({
					url:"{{route('checkout')}}",
					method:'POST',
					data: {
						name:name,phone:phone,address:address,email:email,discount:discount,method:method,note:note,city:city,area:area,transport_cost:transport_cost
					},
					success:function(data){  
						$('input,textarea').removeAttr('id');
						$('.error').html('');
						$('.error').show();
						if(data.errors==true || data.makm==true){
							if (data.message.name != undefined) {
								$('input[name="name"]').attr('id','is-error');
								$('.name').html(data.message.name[0]);
							}
							if (data.message.phone != undefined) {
								$('input[name="phone"]').attr('id','is-error');
								$('.phone').html(data.message.phone[0]);
							}
							if (data.message.address != undefined) {
								$('textarea[name="address"]').attr('id','is-error');
								$('.address').html(data.message.address[0]);
							}
							if (data.message.email != undefined) {
								$('input[name="email"]').attr('id','is-error');
								$('.email').html(data.message.email[0]);
							}
							if (data.message.city != undefined) {
								$('select[name="city"]').attr('id','is-error');

							}
							if (data.message.area != undefined) {
								$('select[name="area"]').attr('id','is-error');

							}
							if(data.message.makm !=undefined){
								$('input[name="discount"]').attr('id','is-error');
								$('.discount').html(data.message.makm);
							}
						}

						else{
							window.location='/';
							alert('Đặt hàng thành công');
						}

					},


				});
			});
		})
	</script>@endsection

