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

    <section class="hero">
        <h1>Welcome</h1>
        <p>Find the best products here!</p>
        
    </section>

    <main>
        
    <section class="slider">
        <div class="slides">
            <img src="{{asset('images/ip.jpg')}}" alt="Slide 1">
            <img src="images/sg.jpg" alt="Slide 2">
            <img src="images/vivoy.jpg" alt="Slide 3">
            <img src="images/iphone161.jpg" alt="Slide 4">
                </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </section>

    <section class="categories">
        <h2>Explore Our Categories</h2>
        <div class="category-grid">
            <div class="category-item">
                <a href="{{route('Mobiles')}}">
                <img src="images/mobilep.jpg" alt="Category 1">
                <h3><a href="{{route('Mobiles')}}">Mobile Phones</a></h3>
                </a>
            </div>
            <div class="category-item">
            <a href="{{route('Tabs')}}">
                <img src=" images/t.jpg" alt="Category 2">
                <h3><a href="{{route('Tabs')}}">Tabs</a></h3>
            </a>
            </div>
            <div class="category-item">
            <a href="{{route('acc')}}">
                <img src="images/accessories.webp" alt="Category 3">
                <h3><a href="{{route('acc')}}">Accessaries</a></h3>
            </a>
            </div>
            <div class="category-item">
            <a href="{{route('smart watches')}}">
                <img src="images/smartwatch.jpg" alt="Category 4">
                <h3><a href="{{route('smart watches')}}">Smart Watches</a></h3>
            </a>
            </div>
           </div>
    </section>   
<!-- Categories, products, etc. -->
    </main>

    <footer>
        <li><a href="{{route('aboutus')}}">About Us</a></li>
        <p>&copy; 2024 MyShop. All rights reserved.</p>
    </footer>
</body>
</html>

