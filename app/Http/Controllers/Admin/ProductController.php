<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use DB;
use Yajra\Datatables\Datatables;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $category_name = Product::with('category')->get();
        $brand_name = Product::with('brand')->get();
        $products = Product::where('status', '<>', 0)->get();
        $items = Product::where('status', 0)->get();
        return view('admin.product.index', compact('items'));
    }
    public function datatable(Request $request)
    {
        $category_name = Product::with('category')->get();
        $brand_name = Product::with('brand')->get();
        $products = DB::table('product')->where('product.status', '<>', 0)
            ->join('category', 'product.category_id', '=', 'category.id')->join('brand', 'product.brand_id', '=', 'brand.id')
            ->select('product.id', 'product.img', 'product.status', 'product.name', 'category.name as category_name', 'brand.name as brand_name', 'product.created_at')
            ->get()->toArray();
        // dd($products);
        //$hinh="upload/product/".$products->img;

        return Datatables::of($products)
            ->editColumn('img', function ($products) {
                return '<img src="' . url("upload/product/{$products->img}") . '" height="30px">';
            })
            ->editColumn('name', function ($products) {
                return '<td>' . str_limit($products->name, 25) . '</td>';
            })
            ->addColumn('action', function ($products) {
                return $products->status == 2 ?
                    '<a href="' . url("admin/product/status/{$products->id}") . '" class="btn btn-info btn-sm" id="btn-status" title="Mặc Định"><i class="far fa-moon"></i></a><a href="' . url("admin/product/edit/{$products->id}") . '" class="btn btn-primary btn-sm" id="btn-edit"><i class="far fa-edit"></i></a>
                <a href="' . url("admin/product/remove/{$products->id}") . '" class="btn btn-danger btn-sm" id="btn-remove"><i class="far fa-trash-alt"></i> </a>
                '
                    : '<a href="' . url("admin/product/status/{$products->id}") . '" class="btn btn-warning btn-sm" id="btn-status" title="Nổi Bật"><i class="far fa-lightbulb"></i></a><a href="' . url("admin/product/edit/{$products->id}") . '" class="btn btn-primary btn-sm" id="btn-edit"><i class="far fa-edit"></i></a>
                <a href="' . url("admin/product/remove/{$products->id}") . '" class="btn btn-danger btn-sm" id="btn-remove"><i class="far fa-trash-alt"></i> </a>';
            })
            ->addColumn('checkone', function ($products) {
                return '<input type="checkbox" value="' . $products->id . '" name="checkone[]" class="checkone"/>';
            })
            ->rawColumns(['img', 'action', 'show', 'include', 'checkone', 'name'])
            ->make();
    }
    public function create()
    {
        $category_option = '';
        $category = Category::where(['parent_id' => 0])->get();
        foreach ($category as $cat1) {
            $category_option .= '<optgroup label="' . $cat1['name'] . '">';
            $sub_category = Category::where(['parent_id' => $cat1['id']])->get();
            foreach ($sub_category as $cat2) {
                $category_option .= '<option value=' . $cat2['id'] . '>&emsp;' . $cat2['name'] . '</option>';
            }
            $category_option .= '</optgroup>';
        }
        $brand_option = '';
        $brand = Brand::where(['parent_id' => 0])->get();
        foreach ($brand as $br1) {
            $brand_option .= '<option value=' . $br1['id'] . '>' . $br1['name'] . '</option>';
            $sub_brand = brand::where(['parent_id' => $br1['id']])->get();
            foreach ($sub_brand as $br2) {
                $brand_option .= '<option value=' . $br2['id'] . '>&emsp;' . $br2['name'] . '</option>';
            }
        }
        return view('admin.product.create', compact('category_option', 'brand_option'));
    }
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data = request()->except(['_token']); //loại bỏ các cột dư thừa vì ta sử dung $request->all() // không đặt name cho button type = submit
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $nameimg = $file->getClientOriginalExtension();
            $hinh = str_slug($data['name']) . "." . $nameimg;
            while (file_exists("public/upload/product/" . $hinh)) {
                $hinh = str_slug($data['name']) . "." . $nameimg;
            }
            $file->move("upload/product", $hinh);
            $data['img'] = $hinh;
        }
        if ($product = Product::insert($data)) {
            $action = DB::table('history')->insert([
                'name'      => 'Đã Thêm 1 Sản Phẩm',
                'content'   => 'Đã Thêm 1 Sản Phẩm',
                'user_id'   => Auth::id(),
                'action'    => 'Add',
                'time'  => date('Y-m-d H:i:s'),
            ]);
            return redirect('admin/product')->with('message', 'Thêm SP Thành Công');
        } else
            return back()->with('message', 'Thêm SP Thất Bại');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $category_option = '';
        $category = Category::where(['parent_id' => 0])->get();
        foreach ($category as $cat1) {
            $category_option .= '<optgroup label="' . $cat1['name'] . '">';
            $sub_category = Category::where(['parent_id' => $cat1['id']])->get();
            foreach ($sub_category as $cat2) {
                if ($product['category_id'] == $cat2['id'])
                    $category_option .= '<option selected value=' . $cat2['id'] . '>&emsp;' . $cat2['name'] . '</option>';
                $category_option .= '<option value=' . $cat2['id'] . '>&emsp;' . $cat2['name'] . '</option>';
            }
            $category_option .= '</optgroup>';
        }
        $brand_option = '';
        $brand = Brand::where(['parent_id' => 0])->get();
        foreach ($brand as $br1) {
            $brand_option .= '<option value=' . $br1['id'] . '>' . $br1['name'] . '</option>';
            $sub_brand = brand::where(['parent_id' => $br1['id']])->get();
            foreach ($sub_brand as $br2) {
                if ($product['brand_id'] == $br2['id'])
                    $brand_option .= '<option value=' . $br2['id'] . '>&emsp;' . $br2['name'] . '</option>';
                $brand_option .= '<option value=' . $br2['id'] . '>&emsp;' . $br2['name'] . '</option>';
            }
        }
        return view('admin.product.edit', compact('product', 'category_option', 'brand_option'));
    }
    public function update(ProductRequest $request, $id)
    {
        if ($request->checkall) { }
        $data = $request->all();
        $data = request()->except(['_method', '_token', 'imgold', 'submit']);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $nameimg = $file->getClientOriginalExtension();
            $hinh = str_slug($data['name']) . "." . $nameimg;
            while (file_exists("public/upload/product/" . $hinh)) {
                $hinh = str_slug($data['name']) . "." . $nameimg;
            }
            $file->move("upload/product", $hinh);
            $data['img'] = $hinh;
        }

        if ($product = Product::where('id', $id)->update($data)) {
            $action = DB::table('history')->insert([
                'name'  =>'Đã sửa 1 sản phẩm',
                'content'   => 'Đã Sửa 1 Sản Phẩm',
                'user_id'   => Auth::id(),
                'action'    => 'Edit',
                'time'  => date('Y-m-d H:i:s'),
            ]);
            return redirect('admin/product')->with('message', 'Sửa Sản Phẩm Thành Công');
        } else
            return back()->with('message', 'Sửa  Sản Phẩm Thất Bại');
    }
    public function status($id)
    {
        $products = Product::where(['id' => $id])->first();
        if (($products->status) == 2)
            $products->status = 1;
        else
            $products->status = 2;
        $products->save();
        return back()->with('message', 'Thay Đổi Trạng Thái Thành Công');
    }
    /*xóa bỏ vào thùng rát*/
    public function remove($id)
    {
        $products = Product::where(['id' => $id])->first();
        $products->status = 0;
        $date = date("Y-m-d H:i:s");
        $products->updated_at = $date;
        $products->save();
        return  back()->with('message', 'Bỏ Sọt Thành Công');
    }
    function remove_all(Request $request)
    {
        //dd($request->all());
        $student_id_array = $request->id;
        // dd($student_id_array);
        if ($student_id_array) {
            $data = ['status' => 0];
            if ($student = Product::whereIn('id', $student_id_array)->update($data))

                echo 'Bỏ Sọt Thành Công';
            else
                echo "none";
        }
    }
    /*khôi phục*/
    public function restore($id)
    {
        $products = Product::where(['id' => $id])->first();
        $products->status = 1;
        $date = date("Y-m-d H:i:s");
        $products->created_at = $date;
        $products->save();
        return  back()->with('message', 'Khôi Phục Thành Công');
    }
    /*xóa vĩnh viễn*/
    public function destroy($id)
    {
        $data = request()->except(['_method', '_token', 'submit']);
        $row = Product::where(['id' => $id])->first();
        // xóa category con luôn
        return  back()->with('message', 'Đã Xóa Vình Viễn');
    }
}
