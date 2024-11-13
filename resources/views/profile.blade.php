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
    <title>profile</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/profile.css')}}"></link>
    <link rel="stylesheet" href="{{asset('css/cartcount.css')}}"></link>
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
<div class="profile-container">
    <!-- Profile Sidebar -->
    <div class="profile-sidebar">
        <h2 class="profile-name">{{ $user->name }}</h2>
        <p class="profile-email">{{ $user->email }}</p>
        <a href="{{ route('myorder') }}"> <button class=" btn-or">your  orders</button></a>
        <a href="{{ route('logout') }}" class="logout-btn"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a> 
       
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Profile Details Section -->
    <div class="profile-details">
        <h3>Profile Details</h3>
        <div class="detail-item">
            <label>Full Name:</label>
            <span>{{ $user->name }}</span>
        </div>
        <div class="detail-item">
            <label>Email:</label>
            <span>{{ $user->email }}</span>
        </div>
       
    </div>
</div>


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