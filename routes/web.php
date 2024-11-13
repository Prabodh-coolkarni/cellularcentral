<?php

use Filament\Http\Middleware\Authenticate;
use App\Filament\Resources\ProductsResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\profilecontroller;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\reviewController;
use Illuminate\Support\Facades\Auth;
use Filament\http\Livewire\Auth\Login;
use Filament\Pages\Auth\Login as AuthLogin;
use Filament\Http\Controllers\Auth\LogoutController;

//route for home page
Route::get('/', function () {
    return view('index');
})->name('index');

//route for aboutus page
Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

//route for privacy policy page
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

// route for term of service page 
Route::get('/terms-of-service', function () {
    return view('terms-of-service');
})->name('terms-of-service');

//route for help page
Route::get('/help', function () {
    return view('help');
})->name('help');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//routes for register
Route::get('custom-register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('custom-register', [RegisterController::class, 'register']);

//routes for login
Route::get('custom-login', [loginController::class, 'showLoginForm'])->middleware('guest')->name('custom.login');
Route::post('custom-login', [loginController::class, 'login']);

//routes of productcontroller 
Route::get('Mobiles',[ProductController::class,'index'])->name('Mobiles');
Route::get('Tabs',[ProductController::class,'index_tabs'])->name('Tabs');
Route::get('smart watches',[ProductController::class,'index_watch'])->name('smart watches');
Route::get('accesories',[ProductController::class,'index_acc'])->name('accesories');
Route::get('Details/{id}',[ProductController::class,'Details'])->name('Details');
Route::get('search',[ProductController::class,'search'])->name('search');
Route::post('add_to_cart',[ProductController::class,'addtocart'])->name('/add_to_cart');
Route::post('order',[ProductController::class,'order'])->name('order');
Route::get('cartlist',[ProductController::class,'cartlist'])->name('cartlist');
Route::get('/removecart/{id}',[ProductController::class,'removecart'])->name('removecart');
Route::get('/checkout',[ProductController::class,'checkout'])->name('checkout');
Route::post('orderplace',[ProductController::class,'orderplace'])->name('orderplace');
Route::post('singleorderplace',[ProductController::class,'singleorderplace'])->name('singleorderplace');
Route::get('myorders',[ProductController::class,'myorder'])->name('myorder');

//admin login route
Route::middleware(['guest'])->group(function(){
   Route::get('/admin/login',AuthLogin::class)->name('filament.auth.login');
});

Route::middleware(['auth'])->post('/admin/logout',function(){
    Auth::guard('admin')->logout();
    return redirect('/');
})->name('filament.admin.auth.logout');


//route for profile
Route::get('/profile',[profilecontroller::class,'index'])->name('profile')->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//helpdesk
Route::post('/help',[reviewController::class,'store'])->name('/help');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
  return view('index');
})->name('dashboard');
});


