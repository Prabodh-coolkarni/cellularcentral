<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
      // Get the price range from the input and format it with commas
      $priceRange = number_format((int) $request->input('price-range'));
  
      // Log to check the formatted price range for debugging
      \Log::info("Formatted price range: " . $priceRange);
  
      // Modify the query to select prices as strings (matching database format)
      $query->whereRaw("REPLACE(price, ',', '') <= ?", [(int) str_replace(',', '', $priceRange)]);
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
      // Get the price range from the input and format it with commas
      $priceRange = number_format((int) $request->input('price-range'));
  
      // Log to check the formatted price range for debugging
      \Log::info("Formatted price range: " . $priceRange);
  
      // Modify the query to select prices as strings (matching database format)
      $query->whereRaw("REPLACE(price, ',', '') <= ?", [(int) str_replace(',', '', $priceRange)]);
    }
  
  
   $data=$query->get()->map(function($product){
      $Gallery=json_decode($product->Gallery);
      $product->first_image=$Gallery[0]??null;
      return $product;
    });
     return view('Tabs',['tabs'=>$data]);
  }

  //function for displaying watches
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
     // Get the price range from the input and format it with commas
     $priceRange = number_format((int) $request->input('price-range'));

     // Log to check the formatted price range for debugging
     \Log::info("Formatted price range: " . $priceRange);

     // Modify the query to select prices as strings (matching database format)
      $query->whereRaw("REPLACE(price, ',', '') <= ?", [(int) str_replace(',', '', $priceRange)]);
   }
   $data=$query->get()->map(function($product){
      $Gallery=json_decode($product->Gallery);
      $product->first_image=$Gallery[0]??null;
      return $product;
    });
     return view('watches',['watches'=>$data]);
  }

  //function for displaying accessaries
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
    // Get the price range from the input and format it with commas
    $priceRange = number_format((int) $request->input('price-range'));

    // Log to check the formatted price range for debugging
    \Log::info("Formatted price range: " . $priceRange);

    // Modify the query to select prices as strings (matching database format)
    $query->whereRaw("REPLACE(price, ',', '') <= ?", [(int) str_replace(',', '', $priceRange)]);
  }

  // Apply accessory filter if set in the request
  if ($request->filled('accessory')) {
    $query->where('description', $request->input('accessory'));
}

   $data=$query->get()->map(function($product){
    $Gallery=json_decode($product->Gallery);
    $product->first_image=$Gallery[0]??null;
    return $product;
  });
     return view('accesories',['acc'=>$data]);
  }

  //details function
    function Details($id){
      $data=products::find($id);
     $data->image=json_decode($data->Gallery);
      return view('Details',['mobile'=>$data] );
    }

    //searching function 
    function search(request $request){
      $searchTerm = $request->input('query');
     $keywords = explode(' ', $searchTerm); // Split into words for broader matching

     $query = Products::where(function ($q) use ($keywords) {
    foreach ($keywords as $keyword) {
        $q->where(function ($subQ) use ($keyword) {
            $subQ->where('name', 'like', '%' . $keyword . '%')
                 ->orWhere('description', 'like', '%' . $keyword . '%')
                 ->orWhere('category', 'like', '%' . $keyword . '%');
        });
     }
   });

        
         //Apply brand filter if set in the request
        if ($request->filled('brand')) {
        $query->where('brand', $request->input('brand'));
        }

        // Apply price filter if set in the request
        if ($request->filled('price-range')) {
        $query->where('price','<=', $request->input('price-range'));
        }
            
        $data=$query->get()
          ->map(function($product){
          $Gallery=json_decode($product->Gallery);
          $product->first_image=$Gallery[0]??null;
          return $product;
        });
       return view('search',['products'=>$data]);
    }

    // function for adding in cart
    function addtocart(Request $req)
    { 
        if (Auth::check()) {
            $user = auth()->user();
    
            // Check if the product is already in the cart
            $existingCartItem = Cart::where('user_id', $user->id)
                                    ->where('product_id', $req->product_id)
                                    ->first();
    
            if ($existingCartItem) {
                // If product is already in the cart, update the quantity
                $existingCartItem->quantity += $req->quantity;
                $existingCartItem->save();
                return redirect()->back()->with('message', 'Quantity updated in cart successfully!');
            } else {
                // If product is not in the cart, add it as a new entry
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $req->product_id;
                $cart->quantity = $req->quantity;
                $cart->save();
                return redirect()->back()->with('message', 'Added to cart successfully!');
            }
        } else {
            return redirect()->route('login');
        }
    }
    
    //function for showing cart list
    function cartlist(){
      if(Auth::check()){
        $user= auth()->user();
        $user_id=$user->id;

       $data=DB::table('cart')
        ->join('products','cart.product_id','products.id')
        ->select('products.*','cart.id as cart_id','cart.created_at','cart.quantity')
        ->where('cart.user_id',$user_id)
        ->get()->sortByDesc('created_at'); 

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
    ->sum(DB::raw('products.Price')); 
    
    return view('checkout',['carttotal'=>$total]);
}

//checkout page function
function order(Request $req){
if(Auth::check()){
  $user= auth()->user();
  $user_id=$user->id;
  $product_id=$req->product_id;
  $qu=$req->quantity;
  $data=products::find($product_id);

    foreach($data as $product){
      if(isset($product->Gallery)){
        $Gallery=json_decode($product->Gallery,true);
        $product->first_image=$Gallery[0]??null;
      }}
     return view('order',['product'=>$data],['quantity'=>$qu]);

  cart::where('product_id',$product_id)->delete();
  }
  else
  return redirect('login');
  }

  //checkout function
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
      $order->quantity=$cart['quantity'];
      $order->save();
    }
    cart::where('user_id',$user_id)->delete();
     // Redirect to the previous page
     return redirect($req->input('previous_url'))->with('message', 'order placed successfully!');
  }

  //function for placing single order
  function singleorderplace(request $req){
    $user= auth()->user();
    $user_id=$user->id;
    $product_id=$req->product_id;

    $product=products::where('id',$product_id)->first();
      $order=new order();
      $order->product_id=$product->id;
      $order->user_id=$user_id;
      $order->address=$req->address;
      $order->status="pending";
      $order->payment_method=$req->paymentmethod;
      $order->payment_status="pending";
      $order->quantity=$req->quantity;
      $order->save();
      // Redirect to the previous page
     return redirect($req->input('previous_url'))->with('message', 'order placed successfully!');
  }

//function for showing order list
  function myorder(){
    $user= auth()->user();
    $user_id=$user->id;
    $orderdata=DB::table('orders')
    ->join('products','orders.product_id','products.id')
    ->select('products.*','orders.*','orders.created_at as order_created_at')
    ->where('orders.user_id',$user_id)
    ->get()->sortByDesc('order_created_at');

    $orderdata=$orderdata->map(function($product){
        if(isset($product->Gallery)){
            $Gallery=json_decode($product->Gallery,true);
            $product->first_image=$Gallery[0]??null;
          }
          else{
            $product->first_image=null;
          }
          return $product;
    });

      return view('myorders',['orders'=>$orderdata]);
}


    //function for cart item count
    static function cartcount(){
      $user= auth()->user();
      $user_id=$user->id;

      return cart::where('user_id',$user_id)->count();
    }
}
