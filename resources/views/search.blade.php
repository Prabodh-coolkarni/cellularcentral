<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savita Mobiles</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/styless.css')}}">
    <link rel="stylesheet" href="{{asset('css/dc.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/shopping.css')}}">
    <script defer src="{{asset('js/script.js')}}"></script>
    <script defer src="{{asset('js/scripts.js')}}"></script>

</head>
<body>
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
                <li><a href="{{route('cartlist')}}"><i class=" icon fa-solid fa-cart-shopping"></i></a></li>
            </ul>
            <form action="search" method="get">
            <input type="text" id="search"  name="query" placeholder="Search...">
             <button class=" btn fa-solid fa-magnifying-glass" type="submit" ></button>
            </form>
        </nav>
    </header>
    <section class="filters">
        <h3>Filter Products</h3>
        <form id="filter-form">
            <div class="filter-group">
                <label for="brand">Brand:</label>
                <select id="brand" name="brand">
                    <option value="">All Brands</option>
                    <option value="apple">Apple</option>
                    <option value="samsung">Samsung</option>
                    <option value="vivo">Vivo</option>
                    <option value="oneplus">OnePlus</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="price-range">Price Range:</label>
                <input type="range" id="price-range" name="price-range" min="100" max="1500" step="50" value="1000" oninput="document.getElementById('price-value').textContent = '$' + this.value;">
                <span id="price-value">$1000</span>
            </div>

            <button type="submit" class="filter-button">Apply Filters</button>
        </form>
    </section>
    <section class="product-list">
        <h2>Available Products</h2>
        <div class="products-grid">
            <!-- Product 1 -->
            @foreach($products as $item)
            <div class="product-item" data-brand="{{$item->Brand}}" data-price="999">
                <a href="Details/{{$item->id}}">
                @if($item->first_image)
                <img src="{{asset('storage/'.$item->first_image)}}" alt="iPhone 14">  
                @endif
                <h3>{{$item->name}}</h3>
                <p>Price:{{$item->Price}}</p>
                <a href="{{route('order')}}" class="buy-button">add to cart</a> <a href="{{route('order')}}" class="buy-button">Buy Now</a>
                </a>
            </div> 
            @endforeach
    
    </section>

    <footer>
        <li><a href="{{route('aboutus')}}">About Us</a></li>
        <p>&copy; 2024 SM Cellular Central. All rights reserved.</p>
    </footer>
</body>
</html>