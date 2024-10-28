<!DOCTYPE html>
<html lang="en">
<head>
    <title>Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></link>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/singleproduct.css')}}"></link>
    
    <script defer src="{{asset('js/script.js')}}"></script>
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
    <div class="container">
        <div class="single-product">
            <div class="row">
                <div class="col-6">
                    <div class="product-image">
                        <div class="product-image-main">
                            @if(!empty($mobile->image) && is_array($mobile->image))
                           <img src="{{asset('storage/'.$mobile->image[0])}}" alt="img" id="product-main-image">
                           @endif
                        </div>
                        <div class="product-image-slider">
                        @foreach ($mobile->image as $images)
                           <a href="{{asset('storage/'.$images)}}"> <img src="{{asset('storage/'.$images)}}" alt="img"  class="image-list"></a>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="breadcrumb">
                        <span><a href="{{route('index')}}">Home</a></span>
                        <span><a href="{{route('Mobiles')}}">Product</a></span>
                        <span class="active">mobiles</span>
                    </div>

                    <div class="product">
                        <div class="product-title">
                            <h2>{{$mobile->name}}</h2>
                        </div>
                        
                        <div class="product-title">
                            <h3>price:{{$mobile->Price}}</h3>
                        </div>

                        <div class="product-details">
                            <h3>Specefications</h3>
                            <h4>name:{{$mobile->name}}</h4>  <p>version:{{$mobile->Version}}</p>
                            <p>name:{{$mobile->name}}</p>      <p>camera:{{$mobile->Camera_f}}</p>
                            <p>camera:{{$mobile->Camera_b}}<p>  <p>Processor:{{$mobile->Processor}}</p>
                            <p>Display size:{{$mobile->Display_Size}}</p>      <p>camera:{{$mobile->Camera_f}}</p>
                        </div>
                        <span class="divider"></span>

                        <div class="product-btn-group">
                        <form action="{{route('order')}}" method="post">
                             @csrf
                                <input type="hidden" name="product_id" value="{{$mobile->id}}">
                               <button type="submit"><a href="{{route('order')}}"> <div class="button buy-now"><i class='bx bxs-zap' ></i> Buy Now</div></a></button>
                            </form>
                           
                            <form action="{{route('/add_to_cart')}}" method="post">
                             @csrf
                                <input type="hidden" name="product_id" value="{{$mobile->id}}">
                               <button type="submit"><div class="button add-cart"><i class='bx bxs-cart' ></i> Add to Cart</div></button>
                            </form>
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>