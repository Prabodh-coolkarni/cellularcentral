<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <script defer src="{{asset('js/script.js')}}"></script>
    <script defer src="{{asset('js/scripts.js')}}"></script>

</head>
<body>
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
                <li><a href="{{route('cartlist')}}"><i class=" icon fa-solid fa-cart-shopping"></i></a></li>
            </ul>
            <form action="search" method="get">
            <input type="text" id="search"  name="query" placeholder="Search...">
             <button class=" btn fa-solid fa-magnifying-glass" type="submit" ></button>
            </form>
        </nav>
    </header>

    <!-- Cart Section -->
    <h2>Your Shopping Cart</h2>
    <section class="cart-container">
        <div class="cart-items">
        @foreach($products as $item)
        <div class="cart-item">
        @if($item->first_image)
                <img src="{{ asset('storage/'.$item->first_image)}}" alt="img">  
             @else
                <p>no Available img</p>
            @endif
                <h3>{{$item->name}}</h3>
                <p>Price:{{$item->Price}}</p>
                <a href="#" class="buy-button">Buy Now</a>
                <a href="/removecart/{{$item->cart_id}}" class="rm-button">Remove</a>
                <br>     
            </div> 
            </div>
        </div>
        @endforeach
        </div>   
    </section>
    @if(!isset($products))
    <a href="checkout" class="checkbtn">checkout</a>
   @endif


    <script src="/js/cart.js"></script>
</body>
</html>