<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class OrganizerRegisterController extends Controller
{
    public function organizerRegister()
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'user_type' => request('user_type'),
        ]);

        Profile::create([

         'user_id'=>$user->id ,
         'gender'=>request('gender') ,
         'dob'=>request('dob') ,

        ]); 
        return redirect()->to('login');
    }
}
