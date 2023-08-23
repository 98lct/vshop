<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;

Carbon::now('Asia/Ho_Chi_Minh');

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '<>', 0)->get(); //=>slider tất cả
        #---------------
        $brands = Brand::where([
            ['status', '=', 2],
            ['parent_id', 0]
        ])->limit(9)->get(); //=> menu thương hiệu nổi bật
        $brand_li = '';
        foreach ($brands as $value) {
            $brands_sub = Brand::where([
                ['status', '<>', 0],
                ['parent_id', $value['id']]
            ])->get(); //=> Lấy tất cả các brand con của nó
            if (count($brands_sub)) {
                $brand_li .= '<li><i class="fas fa-angle-right"></i><a href="#">' . $value['name'] . '</a><ul id="slidebar-sub">';
                foreach ($brands_sub as $value) {
                    $brand_li .= '<li><a href="#">' . $value['name'] . '</a></li>';
                }
                $brand_li .= '</ul></li>';
            } else
                $brand_li .= '<li><i class="fas fa-angle-right"></i><a href="#">' . $value['name'] . '</a></li>';
        }
        $smartphone_li = '';
        $product_block = Category::where([
            ['parent_id', '=', '0'],
            ['status', '=', '2']
        ])->limit(3)->get(); //=>lấy ra category chính cần truy vấn

        return view('guest.index', compact(
            'sliders',
            'brand_li',
            'product_block'
        ));
    }
}
