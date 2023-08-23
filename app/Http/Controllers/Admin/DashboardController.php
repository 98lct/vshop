<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $products = DB::table('product')->where('status', '<>', 0)->count();
        $orders = DB::table('order')->where('status', '<>', 0)->count();
        $users = DB::table('users')->count();
        $posts = DB::table('post')->where('status', '<>', 0)->count();
        $historys = DB::table('history')->join('users', 'history.user_id', '=', 'users.id')
            ->select('time', 'action', 'content', 'users.name as name','img')->get();
        return view('admin.index', compact('products', 'orders', 'users', 'posts', 'historys'));
    }
}
