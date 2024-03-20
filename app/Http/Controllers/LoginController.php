<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class LoginController extends Controller
{
    public function login_store(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('dashboard');
        }

        return back()->with('error','Invalid Credentials');
    }

    public function register_store(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = $request->only('name','email','phone');
        $data['password'] = Hash::make($request->password);
        // dd($data);
        $status = User::create($data);
        if($status){
            return redirect()->route('login')->with('success','Account Created, Please login');
        }
        return back()->with('error','Oops something went wrong,please try again.');
    }
}
