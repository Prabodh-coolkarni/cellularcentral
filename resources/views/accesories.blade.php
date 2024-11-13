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
    <title>SM Cellular Central - Products</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/shopping.css')}}">
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
             <button class="btn fa-solid fa-magnifying-glass" type="submit" ></button>
            </form>
            </div>
        </nav>
    </header>
    
    <section class="filters">
    <h3>Filter Accessories</h3>
    <form action="{{ route('accesories') }}" method="GET">
        <div class="filter-group">
            <label for="brand">Brand:</label>
            <select id="brand" name="brand">
                <option value="">All Brands</option>
                <option value="apple" {{ request('brand') == 'apple' ? 'selected' : '' }}>Apple</option>
                <option value="samsung" {{ request('brand') == 'samsung' ? 'selected' : '' }}>Samsung</option>
                <option value="vivo" {{ request('brand') == 'vivo' ? 'selected' : '' }}>Vivo</option>
                <option value="oneplus" {{ request('brand') == 'oneplus' ? 'selected' : '' }}>OnePlus</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="price-range">Price Range:</label>
            <input type="range" id="price-range" name="price-range" min="999" max="150000" step="50" 
                   value="{{ request('price-range', 1000) }}" 
                   oninput="document.getElementById('price-value').textContent = this.value;">
            <span id="price-value">{{ request('price-range', 10000) }}</span>
        </div>

        <button type="submit" class="filter-button">Apply Filters</button>
    </form>
</section>


    <section class="product-list">
        <h2>Available Products</h2>
        <div class="products-grid">
            <!-- Product 1 -->
            @foreach($acc as $item)
            <div class="product-item" data-brand="samsung" data-price="999">
                <a href="Details/{{$item->id}}">
                    @if($item->first_image)
                <img src="{{asset('storage/'.$item->first_image)}}" alt="iPhone 14">  
                    @endif
                <h3>{{$item->Brand}}</h3>
                <p>Price:{{$item->Price}}</p>
                <form action="{{route('/add_to_cart')}}" method="post">
                             @csrf
                                <input type="hidden" name="product_id" value="{{$item->id}}">
                               <button type="submit" class="buy-button"><div class="button"><i class='bx bxs-cart' ></i> Add to Cart</div></button>  <a href="Details/{{$item->id}}" class="buy-button">Buy Now</a> 
                </form>
                </a>
            </div> 
            @endforeach
           
    </section>
    <footer>
        <li><a href="{{route('aboutus')}}">About Us</a></li>
        <p>&copy; 2024 SM Cellular Central. All rights reserved.</p>
    </footer>

   <script  src="{{ asset('js/filters.js')}}"></script>
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
