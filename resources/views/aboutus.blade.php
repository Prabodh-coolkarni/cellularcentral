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
    <title>About Us</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/aboutus.css')}}">
    <link rel="stylesheet" href="{{asset('css/cartcount.css')}}">
    <link rel="stylesheet" href="{{asset('css/popup.css')}}">
</head>
<body>
@if(session('message'))
<div class="popup-message">
    {{ session('message') }}
</div>
@endif
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
                <li><a href="{{route('cartlist')}}"><i class=" icon fa-solid fa-cart-shopping"></i> @if(Auth::check())<span class="cart-count">{{ $total }}</span>@endif</a></li>
            </ul>
            <div class="search-container">
            <form action="search" method="get">
            <input type="text" id="search"  name="query" placeholder="Search...">
             <button class="search-btn fa-solid fa-magnifying-glass" type="submit" ></button>
            </form>
            </div>
        </nav>
    </header>
   
    <div class="container">
        <h2>Welcome to Our Store!</h2>
              <h2>Our Story</h2>
                <p>
                    Welcome to Savita Mobiles! We started with a simple idea: to provide high-quality mobile phones at affordable prices. 
                    Founded in [Year], our mission has always been to bring the latest technology to your fingertips. Our dedicated team works tirelessly 
                    to ensure that every product we offer meets our high standards.
                </p>
                <img src="/images/our-story.jpg" alt="Our Story Image" class="company-image">
                <h2>Our Mission</h2>
                <p>
                    At Savita, our mission is to enhance the lives of our customers through innovative technology and excellent service. 
                    We strive to offer a seamless shopping experience, from browsing our user-friendly website to receiving your order on time. 
                    Customer satisfaction is at the core of everything we do.
                </p>
        <p>Thank you for choosing us!</p>   
    </div>

<footer>
        <div class="container">
            <p>&copy; 2024 Savita Mobiles. All rights reserved.</p>
            <p><a href="{{route('privacy-policy')}}">Privacy Policy</a> | <a href="{{route('terms-of-service')}}">Terms of Service</a></p>
        </div>
    </footer>

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
