<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ReisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UpdateUser;

Route::get('/welcome', function () {
    return view('dashboard.welcome');
});


//fallback route if non of the route exists
Route::fallback(function () {
    return view('error.pageNotFound');
});

Route::get('400Error', function () {
    return view('error.pageNotFound');
})->name('pageNotFound');



//register
// Route::get('user/login' ,[RegisterController::class , 'create'])->name('user_register');
Route::post('user/register', [RegisterController::class, 'store'])->name('user_register.store');

//login
Route::post('user/login', [LoginController::class, 'store'])->name('user_login.store');
Route::get('user/login', [LoginController::class, 'create'])->name('user_login');

//logout
// Route::get('user/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');



Route::middleware('auth')->group(function () {
    Route::get('user/account', [UpdateUser::class, 'show'])->name('user_account');

    // Route for updating personal details
    Route::patch('user/account/details', [UpdateUser::class, 'updateDetails'])->name('user_account.update_details');

    // Route for updating the password
    Route::patch('user/account/password', [UpdateUser::class, 'updatePassword'])->name('user_account.update_password');


    //dashboard
    Route::get('/', function () {
        return view('dashboard.home');
    })->name('home');

    Route::get('/home2', function () {
        return view('dashboard.home2');
    })->name('home2');

    Route::get('/home3', function () {
        return view('dashboard/home3');
    })->name('home3');



    //user profile info
    Route::get('user/account', function () {
        return view('user.user_account');
    })->name('user_account');

    Route::get('user/address', function () {
        return view('user.user_address');
    })->name('user_address');

    //blog
    Route::get('/blog', function () {
        return view('cart.blog');
    })->name('blog');


    Route::get('/category_left', [ProductController::class, 'index'])
        ->name('category_left');

    Route::get('/category_right', [ProductController::class, 'index'])
        ->name('category_right');

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    //logout
    Route::get('user/logout', [LoginController::class, 'destroy'])->name('logout');


    //protected routes for checkouts
    Route::get('checkout/address',[CheckoutController::class, 'index_checkout1'])->name('checkout_address');

    Route::get('checkout/delivery',[CheckoutController::class, 'index_checkout2'])->name('checkout_delivery');

    Route::get('checkout/payment',[CheckoutController::class, 'index_checkout3'])->name("checkout_payment");

    Route::get('checkout/order-review',[CheckoutController::class, 'index_checkout4'])->name("checkout_order_review");

    Route::get('checkout/order-confirmed',function(){
        return view("checkout.checkout5");
    })->name("checkout_order_confirm");


    


    
});


//all these routes can be accessed with being loggedin but apart from this all the routes are protected
Route::get('coming-soon', function () {
    return view('error.coming_soon');
})->name('coming_soon');

//shop page
Route::get('/category', [ProductController::class, 'index'])->name('category');

Route::get('/contact', function () {
    return view('dashboard.contact');
})->name('contact');

Route::get('about_us', function () {
    return view('dashboard.about_us');
})->name('about_us');

Route::get('/', function () {
        return view('dashboard.home');
    })->name('home');


Route::get('/product/{product}',[ProductController::class , 'show'])->name('products.show');


 


 

// Route::middleware(['auth'])->group(function () {
//     Route::get('/cart', [CartController::class, 'index'])->name('cart');
//     Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
//     // Route::post('/cart/update',[CartController::class,'update_cart'])->name('cartUpdate');
//      Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
//     // Route::post('/cart', [CartController::class, 'update'])->name('cart.update');
//     Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy'); 
//     // Route::post('/cart/update/{id}', [CartController::class, 'update_cart'])->name('cart.update');
   

// });

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    // Define the static route BEFORE the dynamic one to avoid collisions
    Route::post('/cart/manage', [CartController::class, 'manageCart'])->name('cart.manage');
    // Constrain {product} to numeric to ensure "/cart/manage" doesn't match this route
    Route::post('/cart/{product}', [CartController::class, 'store'])->whereNumber('product')->name('cart.store');
    // DELETE THE OLD, UNUSED ROUTES
    // Route::put('/cart/{id}', ...);
    // Route::delete('/cart/{item}', ...);
});