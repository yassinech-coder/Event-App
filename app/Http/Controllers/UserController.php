<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
       return view('profile.index');
    }
    public function store(Request $request) {
      $this->validate($request,[
        'address'=>'required',
        'phone_number'=>'required|numeric',
        'details'=>'required',
      ]);
    
    
      $user_id = auth()->user()->id;
      Profile::where('user_id',$user_id)->update([
      
        'address'=>request('address'),
        'details'=>request('details'),
        'phone_number'=>request('phone_number'),

        
        ]);
        
        return redirect()->back()->with('message','Profile Sucessfully Updated!');

        
    }

    public function avatar(Request $request) 
    {
      $user_id = auth()->user()->id;
      if($request->hasfile('avatar')){
         $file = $request->file('avatar');
         $ext = $file->getClientOriginalExtension();
         $filename = time().'.'.$ext;
         $file->move('uploads/avatar/',$filename);
   
         Profile::where('user_id',$user_id)->update([
         'avatar'=>$filename
          ]);
        
        return redirect()->back()->with('message','Profile Picture Sucessfully Updated!');

       }
    }
}
