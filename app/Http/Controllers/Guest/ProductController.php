<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\Product;
Use App\Models\Brand;
Use App\Models\Category;
Use DB;
Use Illuminate\Support\MessageBag;
use Illuminate\Pagination\Paginator;
use Validator ;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Auth;

class ProductController extends Controller
{
    public function show($slug)
    {
    	//chi tiết sản phẩm
    	$product=Product::where('slug',$slug)->first();
    	//sản phẩm tương tự
        //dd($product->price+500);
        if(($product))
        {
            // dd($product);die;
           // var_dump($product);die;
            $product_same=Product::where([
                ['status','<>',0],
                ['category_id','=',$product->category_id],
                ['id','<>',$product->id]
            ])->take(4)->get();
            $lists_news=DB::table('post')->where('status','<>',0)->limit(8)->orderby('created_at','desc')->get();
            $conments=DB::table('conment')
            ->join('users','users.id','=','conment.user_id')
            ->where('product_id',$product->id)->orderby('conment.created_at','desc')->select('conment.created_at as created_at','img','content','name')->limit(10)->get();
            //dd($conments);
            $product_same_price=DB::table('product')->whereBetween(
                'price' ,[$product->price - 1500000,$product->price + 1500000]
                
            )->where('id','<>',$product->id)->limit(4)->get();
            $voted=DB::table('voted')->where([
                'user_id'   => Auth::id(),
                'product_id'    => $product->id
            ])->first();
            //thống kê binh chọn
            $tongsao=DB::table('voted')->where([
                'product_id'    => $product->id,
            ])->count();
            $sao1=DB::table('voted')->where([
                'product_id'    => $product->id,
                'voted'     =>'1'
            ])->count();
            $sao2=DB::table('voted')->where([
                'product_id'    => $product->id,
                'voted'     =>'2'
            ])->count();
            $sao3=DB::table('voted')->where([
                'product_id'    => $product->id,
                'voted'     =>'3'
            ])->count();

            $sao4=DB::table('voted')->where([
                'product_id'    => $product->id,
                'voted'     =>'4'
            ])->count();  
            $sao5=DB::table('voted')->where([
                'product_id'    => $product->id,
                'voted'     =>'5'
            ])->count();
            $sao=[$sao1,$sao2,$sao3,$sao4,$sao5];

           // dd($product_same_price);
            return view('guest.detail',compact('product','slug','product_same','lists_news','conments','product_same_price','voted','sao','tongsao'));
        }
        else
            return view('errors.404');

    }
    public function all_category() {
        // $brands=Brand::where([
        //     ['status','<>',0],
        //     ['parent_id','=',0]
        // ])->get();
        $category_input='';
        $categorys=Category::where([
            ['status','<>',0],
            ['parent_id','=',0]
        ])->get();
        foreach($categorys as $category){
            $categorys_sub=Category::where([
                ['status','<>',0],
                ['parent_id','=',$category->id]
            ])->get();
            if(count($categorys_sub))
            {
                $category_input.='<label class="list-group-item list-group-item-info" for="">'.$category->name.'</label>';

                foreach($categorys_sub as $category_sub){
                    $product_count=Product::where('category_id',$category_sub->id)->count();
                    if($product_count > 0){
                        $category_input.='<div class="list-group-item px-4">
                        <input class="form-check-input common_selector category" name="category" type="checkbox" value="'.$category_sub->id.'">
                        <label class="form-check-label">
                        '.$category_sub->name . ' ('.$product_count.')'.'
                        </label>
                        </div>';
                    }
                }
                $category_input.='<br/>';
            }
        }
        return view('guest.category',compact('category_input'));
    }
    public function category(Request $request)
    {
        $sql="select * from product where status != 0 ";
        if($request->max_price && $request->min_price && $request->min_price !=null && $request->max_price !=null)
        {
            $sql .= "
            AND price BETWEEN '".$request->min_price."' AND '".$request->max_price."'
            ";
        }
        // if($request->brand)
        // {
        //     $brand_filter = implode("','", $request->brand);
        //     $sql .= " AND brand_id IN('".$brand_filter."')";
        // }
        if($request->category)
        {
            $category_filter = implode("','", $request->category);
            $sql .= " AND category_id IN('".$category_filter."')";
        }
        if($request->key){
            $key=str_slug($request->key);
            $sql.=" AND slug like '%".$key."%'  ";
        }
        if($request->orderby && $request->orderby !=null)
        {
            $sql.='  order by '.$request->orderby ;
        }
        if($request->limit || $request->limit != null)
        {
            $sql .=' limit 0,'.$request->limit;
        }
        if($result=DB::select($sql))
        {
            $output = '';
            if(count($result)>0)
            {
                if($request->view == "gird")
                {
                    foreach($result as $row)
                    {
                        $hinh="upload/product/$row->img";
                        $output .= '<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3"><div class="col-item"><div class="photo">';
                        $output.= '<img src="'.$hinh.'" class="img-fluid" title="'.$row->slug.'"/>';
                        $output.='<div class="info"><div class="row"><div class="price col-lg-12">';
                        $ten= str_limit($row->name,21,'...');
                        $output.='<h6 class="text-left ml-2"><a href="'.$row->slug.'.html" title="'.$row->name.'">'.$ten.'</a></h6>';

                        $output.='<div class="price col-lg-12">
                        <h6 class="price-text-color text-left ml-2">'.number_format($row->price) .'VND</h6>
                        </div>';
                        $output.='     <div class="rating d-none d-md-block col-md-12 text-left">
                        <i class="rating-text fa fa-star"></i><i class="rating-text fa fa-star">
                        </i><i class="rating-text fa fa-star"></i><i class="rating-text fa fa-star">
                        </i><i class="fa fa-star"></i>
                        </div>';
                        $link=route("AddCart",$row->id);
                        $output.= '<div class="separator clear-left">
                        <a href="'.$link.'" class="btn btn-block btn-add-cart">
                        <span class="d-none d-md-block ">Thêm </span>
                        <i class="fas fa-shopping-cart text-center"></i>
                        <div class="clearfix"></div>
                        </a></div>';

                        $output.='     <div class="clearfix">
                        </div>';

                        $output.='</div></div></div></div></div></div>';
                    }
                    $success=new MessageBag(['SuccessMessage'=>$output]);
                }
                else
                {
                    foreach($result as $row)
                    {
                        $hinh="upload/product/$row->img";
                        $output .= '<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3"><div class="col-item row p-2">';
                        $output.= '<div class="col-md-3"><center><img height="150px" src="'.$hinh.'" title="'.$row->slug.'"/></center></div>';
                        $output.='<div class="info col-md-9">';
                        $ten= str_limit($row->name,21,'...');
                        $output.='<h6 class="col-lg-12 "><a href="'.$row->slug.'.html" title="'.$row->name.'">'.$ten.'</a></h6>';
                        $output.='<div class="price col-lg-12">
                        <h6 class="price-text-color text-left mt-2">'.number_format($row->price) .'VND</h6>
                        </div>';

                        $output.='<div class="price col-lg-12 mt-2">
                        <h6 class="">'.$row->describe .'VND</h6>
                        </div>';
                        $link=route("AddCart",$row->id);
                        $output.= '<div class="col-lg-12 my-3">
                        <a href="'.$link.'" class="btn btn-sm btn-add-cart">
                        <span class="d-none d-md-block ">Thêm </span>
                        <i class="fas fa-shopping-cart text-center"></i>
                        <div class="clearfix"></div>
                        </a></div>';

                        $output.='     <div class="clearfix">
                        </div>';
                        $output.='</div></div></div>';

                    }
                    $success=new MessageBag(['SuccessMessage'=>$output]);
                }
                return response()->json([
                    'error' =>false,
                    'message'   =>$success
                ]);
            }
        }
        else
        {
            return response()->json([
                'error' =>true,
                'message'   => '<h3 class="text-center">Không Có Kết Quả Tìm Kiếm</h3>'
            ]);
        }

    }
    public function all_brand() {
        $brands=Brand::where([
            ['status','<>',0],
            ['parent_id','=',0]
        ])->get();
        $brand_input='';
        foreach($brands as $brand){
            $brand_product=Product::where('brand_id',$brand->id)->count();
            if($brand_product > 0){
                $brand_input.='<div class="list-group-item px-4">
                <input class="form-check-input common_selector brand" name="brand" type="checkbox" value="'.$brand->id.'">
                <label class="form-check-label">
                '.$brand->name . ' ('.$brand_product.')'.'
                </label>
                </div>';
            }
        }
        return view('guest.brand',compact('brand_input'));
    }
    public function brand(Request $request)
    {
        $sql="select * from product where status != 0 ";
        if($request->max_price && $request->min_price && $request->min_price !=null && $request->max_price !=null)
        {
            $sql .= "
            AND price BETWEEN '".$request->min_price."' AND '".$request->max_price."'
            ";
        }
        if($request->brand)
        {
            $brand_filter = implode("','", $request->brand);
            $sql .= " AND brand_id IN('".$brand_filter."')";
        }
        if($request->key){
            $key=str_slug($request->key);
            $sql.=" AND slug like '%".$key."%'  ";
        }
        if($request->orderby && $request->orderby !=null)
        {
            $sql.='  order by '.$request->orderby ;
        }
        if($request->limit || $request->limit != null)
        {
            $sql .=' limit 0,'.$request->limit;
        }
        if($result=DB::select($sql))
        {
            $output = '';
            if(count($result)>0)
            {
                if($request->view == "gird")
                {
                    foreach($result as $row)
                    {
                        $hinh="upload/product/$row->img";
                        $output .= '<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3"><div class="col-item"><div class="photo">';
                        $output.= '<img src="'.$hinh.'" class="img-fluid" title="'.$row->slug.'"/>';
                        $output.='<div class="info"><div class="row"><div class="price col-lg-12">';
                        $ten= str_limit($row->name,21,'...');
                        $output.='<h6 class="text-left ml-2"><a href="'.$row->slug.'.html" title="'.$row->name.'">'.$ten.'</a></h6>';

                        $output.='<div class="price col-lg-12">
                        <h6 class="price-text-color text-left ml-2">'.number_format($row->price) .'VND</h6>
                        </div>';
                        $output.='     <div class="rating d-none d-md-block col-md-12 text-left">
                        <i class="rating-text fa fa-star"></i><i class="rating-text fa fa-star">
                        </i><i class="rating-text fa fa-star"></i><i class="rating-text fa fa-star">
                        </i><i class="fa fa-star"></i>
                        </div>';
                        $link=route("AddCart",$row->id);
                        $output.= '<div class="separator clear-left">
                        <a href="'.$link.'" class="btn btn-block btn-add-cart">
                        <span class="d-none d-md-block ">Thêm </span>
                        <i class="fas fa-shopping-cart text-center"></i>
                        <div class="clearfix"></div>
                        </a></div>';

                        $output.='     <div class="clearfix">
                        </div>';

                        $output.='</div></div></div></div></div></div>';
                    }
                    $success=new MessageBag(['SuccessMessage'=>$output]);
                }
                else
                {
                    foreach($result as $row)
                    {
                        $hinh="upload/product/$row->img";
                        $output .= '<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3"><div class="col-item row p-2">';
                        $output.= '<div class="col-md-3"><center><img height="150px" src="'.$hinh.'" title="'.$row->slug.'"/></center></div>';
                        $output.='<div class="info col-md-9">';
                        $ten= str_limit($row->name,21,'...');
                        $output.='<h6 class="col-lg-12 "><a href="'.$row->slug.'.html" title="'.$row->name.'">'.$ten.'</a></h6>';
                        $output.='<div class="price col-lg-12">
                        <h6 class="price-text-color text-left mt-2">'.number_format($row->price) .'VND</h6>
                        </div>';

                        $output.='<div class="price col-lg-12 mt-2">
                        <h6 class="">'.$row->describe .'VND</h6>
                        </div>';
                        $link=route("AddCart",$row->id);
                        $output.= '<div class="col-lg-12 my-3">
                        <a href="'.$link.'" class="btn btn-sm btn-add-cart">
                        <span class="d-none d-md-block ">Thêm </span>
                        <i class="fas fa-shopping-cart text-center"></i>
                        <div class="clearfix"></div>
                        </a></div>';

                        $output.='     <div class="clearfix">
                        </div>';
                        $output.='</div></div></div>';

                    }
                    $success=new MessageBag(['SuccessMessage'=>$output]);
                }
                return response()->json([
                    'error' =>false,
                    'message'   =>$success
                ]);
            }
        }
        else
        {
             //dd('none');
            // $output.= '<h3>Khong Co ket Qua Tim Kiem</h3>';
            // //$success = new MessageBag(['SuccessMessage'=>$output]);
            return response()->json([
                'error' =>true,
                'message'   => '<h3 class="text-center" >Không Có Kết Quả Tìm Kiếm</h3>'
            ]);
        }

    }
    public function search(Request $request)
    {
        //dd($request->key);
        //dd($request->all());
        $key=$request->key;
        $searchs = DB::table('product')->where('name', 'like', '%' . $key . '%')->get();
        if($request->q)
        {
            $searchs = DB::table('product')->where('name', 'like', '%' . $key . '%')->paginate(12);
            return view('guest.search',compact('searchs','key'));

        }
        else
         return response()->json($searchs);
 }
 public function conments(Request $request)
 {
    $validator = Validator::make($request->all(), [
        'content' => 'required|max:500|min:30',
    ],
    [
        'required' => ':attribute Không được để trống',
        'max' => ':attribute không được vượt quá 500',
        'min'   => ':attribute tối thiểu 30 ký tự'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'errors'    => true,
            'message'   =>$validator->errors(),
        ]);
    }
    else{
        if($request->user_id !=0){
            $conment=DB::table('conment')->insert([
                'product_id'    => $request->id,
                'content'   => $request->content,
                'user_id'   => Auth::id(),
                'created_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at'    => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            $news=DB::table('conment')
            ->join('users','users.id','=','conment.user_id')
            ->where('product_id',$request->id)->orderBy('conment.created_at','desc')->first();
            return response()->json([
                'errors'    => false,
                'message'   =>['result'=>'Thêm bình luận thành công','news'=>
                $news
            ],
        ]);
        }
        else{
            return response()->json([
                'authcheck'    => true,
                'auth'   =>'Vui lòng đăng nhập để thực hiện chức năng này',
            ]);
        }
    }
}
public function sosanh($slug1,$slug2)
{
    $product1=DB::table('product')->where('slug',$slug1)->first();
    $product2=DB::table('product')->where('slug',$slug2)->first();
    return view('guest.sosanh',compact('product1','product2'));
}
public function voted(Request $request)
{
        //dd($request->all());
    if($request->user_id==0){
        return response()->json([
            'auth'  => 'fail',
            'message'  => 'Vui lòng đăng nhập để thực hiện chức năng này'
        ]);
    }
    if($request->voted ==null){
        return response()->json([
            'voted' => false,
            'message'   =>'Bạn chưa chọn đánh giá sản phẩm'
        ]);
    }
    if($request->user_id !=0 && $request->voted !=null){
            // $check=DB::table('voted')->where([
            //     ['product_id',$request->product_id],
            //     ['user_id',$request->user_id],
            //     ['voted',$request->voted]
            // ])->first();
            // dd($check);
        $update=DB::table('voted')->where([
            ['product_id',$request->product_id],
            ['user_id',$request->user_id],
        ])->delete();
            //dd($update);
        $voted=DB::table('voted')->insert([
            'product_id'    => $request->product_id,
            'user_id'   => $request->user_id,
            'voted'     => $request->voted,
            'created_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'    => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        return response()->json([
            'voted' => true,
            'message'   =>'Đánh giá thành công'
        ]);
    }
}
}
