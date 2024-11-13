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
        <title>Login - E-Commerce</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('css/login.css')}}">
        <link rel="stylesheet" href="{{asset('css/cartcount.css')}}">
        <link rel="stylesheet" href="{{asset('css/popup.css')}}">
        <script defer src="/js/login.js"></script>
    
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
                <li><a href="{{route('cartlist')}}"><i class=" icon fa-solid fa-cart-shopping"></i>@if(Auth::check())<span class="cart-count">{{ $total }}</span>@endif</a></li>
                <li><a href="{{route('filament.auth.login')}}">Admin login</a></li>
            </ul>
            <div class="search-container">
            <form action="search" method="get">
            <input type="text" id="search"  name="query" placeholder="Search...">
            <button class="search-btn fa-solid fa-magnifying-glass" type="submit"></button>
            </form>
            </div>
            
        </nav>
        </header>
       
    <x-authentication-card>
        <x-slot name="logo">
            
        </x-slot>
       
        <x-validation-errors class="popup-message"/>
        @session('status')
            <div class="">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <main>
    <div class="container">
        <h1>Login</h1>
        <form  action="{{route('login')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="email" value="{{ __('Email') }}">Email:</label>
                <input type="email" id="email" name="email" required :value="old('email')" required autofocus autocomplete="username">
            </div>
            <div class="form-group">
                <label for="password" value="{{ __('Password') }}">Password:</label>
                <input type="password" id="password" name="password" required  autocomplete="current-password">
            </div>
            <button class="login" type="submit" name="submit">Login</button>
            <p class="message">Don't have an account? <a href="{{route('register')}}">Sign up</a></p>

            
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif  
            </div>
        </form>
    </div>
    </main>
    </x-authentication-card>
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

