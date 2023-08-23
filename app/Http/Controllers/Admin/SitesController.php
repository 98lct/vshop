<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SitesController extends Controller
{
    public function edit(){
        $sites=DB::table('sites')->first();
        return view('admin.sites.index',compact('sites'));
    }
    public function update(Request $request,$id){
        $data=$request->all();
        $data=request()->except('_method','_token');
        if($update=DB::table('sites')->where('id',$id)->update($data));
            return redirect()->route('IndexSites')->with('message','Sủa Thành Công');
        return back()->with('message','Sủa Thành Công');
    }
}
