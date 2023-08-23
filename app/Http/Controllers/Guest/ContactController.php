<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('guest.contact');
    }
    public function postindex(Request $request)
    {
        $data=$request->all();
        $data=$request->except('_token');
        $contact=DB::table('contact')->insert([$data]);
        return redirect('/');
    }
}
