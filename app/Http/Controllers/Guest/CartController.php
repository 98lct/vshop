<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use Cart;
Use App\Models\Product;


class CartController extends Controller
{
    public function create($id)
    {
        $product=Product::find($id);

        Cart::Add([
            'id' => $id,
            'name' => $product->name,
            'qty' => '1',
            'price' => $product->price,
            'options' =>[
                            'img'=> $product->img,
                            'slug' =>$product->slug
                        ],
           ]);

        
        return back()->with('message','Thêm Vào Giỏ Hàng Thành Công'); //redirect()->Route('IndexCart');
       
    }
    public function index()
    {
        $cart=Cart::content();
        return view('guest.shopcart',compact('cart'));
    }
    public function remove($id)
    {
        $rowId = Cart::search(function ($cartItem, $rowId) {
            return $cartItem->id ;
        });
        Cart::remove($id);
        return redirect()->Route('IndexCart');
    }
    public function destroy()
    {
        Cart::destroy();
        return redirect()->Route('IndexCart');
    }
    public function update(Request $request)
    {
        Cart::update($request->rowId,$request->qty);
    }
    
}
