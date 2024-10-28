<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;


class ProductController extends Controller
{

  //function for displaying mobiles
  function index(Request $request)
  {
    // Initialize query for accessories
    $query = products::where('category', 'mobile');

     //Apply brand filter if set in the request
    if ($request->filled('brand')) {
      $query->where('brand', $request->input('brand'));
  }

    // Apply price filter if set in the request
    if ($request->filled('price-range')) {
     $query->where('price', '<=', $request->input('price-range'));
    }
   $data=$query->get()->map(function($product){
      $Gallery=json_decode($product->Gallery);
      $product->first_image=$Gallery[0]??null;
      return $product;
    });
     return view('Mobiles',['mobiles'=>$data]);
  }


  //function for displaying tabs

  function index_tabs(Request $request)
  {
    // Initialize query for accessories
    $query = products::where('category', 'tab');

     //Apply brand filter if set in the request
    if ($request->filled('brand')) {
      $query->where('brand', $request->input('brand'));
  }

    // Apply price filter if set in the request
    if ($request->filled('price-range')) {
     $query->where('price', '<=', $request->input('price-range'));
    }
   $data=$query->get()->map(function($product){
      $Gallery=json_decode($product->Gallery);
      $product->first_image=$Gallery[0]??null;
      return $product;
    });
     return view('Tabs',['tabs'=>$data]);
  }

  
  function index_watch(request $request)
  {
   // Initialize query for accessories
    $query = products::where('category', 'smart watch');

     //Apply brand filter if set in the request
    if ($request->filled('brand')) {
      $query->where('brand', $request->input('brand'));
  }

    // Apply price filter if set in the request
    if ($request->filled('price-range')) {
     $query->where('price', '<=', $request->input('price-range'));
    }
   $data=$query->get()->map(function($product){
      $Gallery=json_decode($product->Gallery);
      $product->first_image=$Gallery[0]??null;
      return $product;
    });
     return view('watches',['watches'=>$data]);
  }

  function index_acc(Request $request)
  {
   // Initialize query for accessories
   $query = products::where('category', 'accessories');

   //Apply brand filter if set in the request
  if ($request->filled('brand')) {
    $query->where('brand', $request->input('brand'));
}

  // Apply price filter if set in the request
  if ($request->filled('price-range')) {
   $query->where('price', '<=', $request->input('price-range'));
  }
   $data=$query->get()->map(function($product){
    $Gallery=json_decode($product->Gallery);
    $product->first_image=$Gallery[0]??null;
    return $product;
  });
     return view('accesories',['acc'=>$data]);
  }


    function Details($id){
        $data=products::find($id);
     $data->image=json_decode($data->Gallery);
        return view('Details',['mobile'=>$data] );
    }

    function search(request $request){
        $query=products::where('name','like','%'.$request->input('query').'%');
        
         //Apply brand filter if set in the request
        if ($request->filled('brand')) {
        $query->where('brand', $request->input('brand'));
        }

        // Apply price filter if set in the request
        if ($request->filled('price-range')) {
        $query->where('price', '<=', $request->input('price-range'));
        }
            
        $data=$query->get()
          ->map(function($product){
          $Gallery=json_decode($product->Gallery);
          $product->first_image=$Gallery[0]??null;
          return $product;
        });
       return view('search',['products'=>$data]);
    }

    function addtocart(request $req){ 
      if(Auth::check())
        {
            $cart= new cart();
           $user= auth()->user();
            $cart->user_id=$user->id;
            $cart->product_id=$req->product_id;
            $cart->save();
           return redirect('/Mobiles');
        }
        else
        {
          return redirect()->route('login');
        }
    }

    function cartlist(){
      if(Auth::check()){
        $user= auth()->user();
        $user_id=$user->id;

       $data=DB::table('cart')
        ->join('products','cart.product_id','products.id')
        ->select('products.*','cart.id as cart_id')
        ->where('cart.user_id',$user_id)
        ->get(); 

        foreach($data as $product){
          if(isset($product->Gallery)){
            $Gallery=json_decode($product->Gallery);
            $product->first_image=$Gallery[0]??null;
          }
        }
        return view('cart',['products'=>$data]);
      }
      else
      {
        return redirect()->route('login');
      }
    }
  
  function removecart($id){
    cart::destroy($id);
    return redirect('cartlist');
  }

  function checkout(){
    $user= auth()->user();
    $user_id=$user->id;
    $total= DB::table('cart')
    ->join('products','cart.product_id','products.id')
    ->select('products.*','cart.id as cart_id')
    ->where('cart.user_id',$user_id)
    ->sum('products.price'); 
    
    return view('checkout',['total'=>$total]);
}

function order(Request $req){
if(Auth::check()){
  $user= auth()->user();
  $user_id=$user->id;
  $product_id=$req->product_id;
    $data=products::find( $product_id);
    foreach($data as $product){
      if(isset($product->Gallery)){
        $Gallery=json_decode($product->Gallery);
        $product->first_image=$Gallery[0]??null;
      }
  return view('order',['product'=>$data]);
  cart::where('product_id',$product_id)->delete();
    }
  }
  else
  return redirect('login');
  
}

  function orderplace(request $req){
    $user= auth()->user();
    $user_id=$user->id;
    $allcart=cart::where('user_id',$user_id)->get();
    foreach($allcart as $cart){
      $order=new order();
      $order->product_id=$cart['product_id'];
      $order->user_id=$cart['user_id'];
      $order->address=$req->address;
      $order->status="pending";
      $order->payment_method=$req->paymentmethod;
      $order->payment_status="pending";
      $order->save();
    }
    cart::where('user_id',$user_id)->delete();
    return redirect('/');
  }

  function myorder(){
    $user= auth()->user();
    $user_id=$user->id;
    $orderdata=DB::table('orders')
    ->join('products','orders.product_id','products.id')
    ->select('products.*','orders.*')
    ->where('orders.user_id',$user_id)
    ->get(); 
    foreach( $orderdata as $product){
      if(isset($product->Gallery)){
        $Gallery=json_decode($product->Gallery);
        $product->first_image=$Gallery[0]??null;
      }
     
    return view('myorders',['orders'=>$orderdata]);
    
  }
}
}
