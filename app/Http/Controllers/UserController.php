<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
  public function index()
  {
    return view('profile.index');
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'address' => 'required',
      'phone_number' => 'required|numeric',
      'details' => 'required',
    ]);


    $user_id = auth()->user()->id;
    Profile::where('user_id', $user_id)->update([

      'address' => request('address'),
      'details' => request('details'),
      'phone_number' => request('phone_number'),


    ]);

    return redirect()->back()->with('message', 'Profile Sucessfully Updated!');
  }

  public function avatar(Request $request)
  {
    $user_id = auth()->user()->id;
    if ($request->hasfile('avatar')) {
      $file = $request->file('avatar');
      $ext = $file->getClientOriginalExtension();
      $filename = time() . '.' . $ext;
      $file->move('uploads/avatar/', $filename);

      Profile::where('user_id', $user_id)->update([
        'avatar' => $filename
      ]);

      return redirect()->back()->with('message', 'Profile Picture Sucessfully Updated!');
    }
  }

  public function delete($event_id, $user_id)
  {
    DB::table('event_user')->where('event_id', $event_id)
      ->where('user_id', $user_id)->delete();

    return redirect()->back()->with('message', 'Participant Deleted!');
  }
  public function getuser(Request $request)
  {
    $name = $request->get('name');
    $user_type = $request->input('user_type');

          if($name || $user_type){
               $users = DB::table('users')->where('name',$name)
               ->orWhere('user_type',$user_type)
               ->paginate(5);
               return view ('admin.show')->with(compact('users'));

          }


     $users =  DB::table('users')->where('name','!=','admin')->get();
     return view('admin.show')->with(compact('users'));

  }
}
