<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        return redirect()->route('category.index');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','You are successfully logout');
    }
}
