<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;


class ContactController extends Controller
{
    public function index()
    {
        $contacts=DB::table('contact')->get();
        return view('admin.contact.index',compact('contacts'));
    }
    public function detail($id)
    {
        $detail=DB::table('contact')->where('id',$id)->first();
        return view('admin.contact.reply',compact('detail'));
    }
    public function reply(Request $request)
    {
        $input = $request->all();
        if(Mail::send('mailfb', array('name'=>$input["fullname"],'email'=>$input["email"], 'content'=>$input['comment']), function($message){
           $message->to('lechithanh998@gmail.com', 'Visitor')->subject('Phản Hồi');
       }))
            return redirect('admin/contact')->with('message','Gửi Thành Công');
            else
                return 'chưa';
        }
    }
