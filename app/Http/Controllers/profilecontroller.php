<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\cart;
use App\Models\order;
use Illuminate\support\Facades\DB;

class profilecontroller extends Controller
{
    
    function index()
    {
       
      $user=Auth::user();
      $orders=order::with('products')->where('user_id',$user->id)->get();
      return view('profile',compact('user','orders'));
    }

   
}
