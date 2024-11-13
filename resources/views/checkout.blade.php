<?php

use App\Http\Controllers\ProductController as ControllersProductController;
if(!Auth::check())
$total=0;
else
$total=ControllersProductController::cartcount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savita Mobiles</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
    <link rel="stylesheet" href="{{asset('css/cartcount.css')}}">
    <link rel="stylesheet" href="{{asset('css/popup.css')}}">
    <script defer src="{{asset('js/script.js')}}"></script>
    <script defer src="{{asset('js/scripts.js')}}"></script>

</head>
<body>
@if(session('message'))
<div class="popup-message">
    {{ session('message') }}
</div>
@endif
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="logo">SM Cellular Central</div>
            <ul class="nav-links">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><a href="{{route('help')}}">Help Desk</a></li>
                @if(!Auth::check())
                <li><a href="{{route('login')}}">Login</a></li>
                <li><a href="{{route('register')}}">Sign Up</a></li>
                @endif
                <li><a href="{{route('profile')}}"><i class="icon fa-solid fa-user-large"></i></a></li>
                <li><a href="{{route('cartlist')}}"><i class=" icon fa-solid fa-cart-shopping"></i>@if(Auth::check())<span class="cart-count">{{ $total }}</span>@endif</a></li>
            </ul>
            <div class="search-container">
            <form action="search" method="get">
            <input type="text" id="search"  name="query" placeholder="Search...">
             <button class="search-btn fa-solid fa-magnifying-glass" type="submit" ></button>
            </form>
            </div>
        </nav>
    </header>
    
    <!--Order Summury-->
    
    <section class="checkout-container">
        <div class="right-block">
            <h2>order summary</h2>
            <p>price:{{$total}}</p>
        </div>
    </section>
   
    <!-- Checkout Section -->
    <section class="checkout-container">
        <div class="left-block">
        <h2>Checkout</h2>
        <form id="checkout-form"  action="orderplace"  method="post">
            @csrf
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Shipping Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="payment-method">Payment Method:</label>
                <select id="payment-method" name="paymentmethod" required>
                    <option value="cash-on-delivery" name="paymentmethod">Cash on Delivery</option>
                </select>
            </div>
            
            <!-- Capture the previous URL -->
            <input type="hidden" name="previous_url" value="{{ url()->previous() }}">


            <div>
            <button type="submit" class="place-order-button">Place Order</button>
            </div>
        </form>
        </div>
    </section>

    <script>
    setTimeout(function() {
        var popup = document.querySelector('.popup-message');
        if (popup) {
            popup.style.display = 'none';
        }
    }, 3000); // 3000ms = 3 seconds
</script>
</body>
</html>

