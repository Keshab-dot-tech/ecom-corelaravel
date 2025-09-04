<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckingoutController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ReisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UpdateUser;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Session;

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


     
    // Route::get('checkout/address', [CheckoutController::class, 'index_checkout1'])->name('checkout_address');

    // Route::get('checkout/delivery', [CheckoutController::class, 'index_checkout2'])->name('checkout_delivery');

    // Route::get('checkout/payment', [CheckoutController::class, 'index_checkout3'])->name("checkout_payment");

    // Route::get('checkout/order-review', [CheckoutController::class, 'index_checkout4'])->name("checkout_order_review");

    // Route::get('checkout/order-confirmed', function () {
    //     return view("checkout.checkout5");
    // })->name("checkout_order_confirm");

    

    // Route::delete('checkout/order-review/{id}', [CheckoutController::class, 'destroy'])
    //     ->name('checkout_item_destroy');

    // Route::post('/save-address', [CheckoutController::class, 'save_address'])->name('save_address');

    // Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])
    //     ->name('checkout_place_order');


    Route::get('customer-order', [OrderController::class, 'order_detail'])->name('order_detail');

    Route::get('customer/all-orders' , [OrderController::class , 'all_orders']) ->name('all_orders');


    


     
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


// Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart routes - accessible to both guests and authenticated users
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/{product}', [CartController::class, 'store'])->whereNumber('product')->name('cart.store');

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/manage', [CartController::class, 'manageCart'])->name('cart.manage');
});





 
Route::prefix('checkout')->group(function () {
     
    Route::get('/address-invoice', [CheckingoutController::class, 'index_checkout1'])->name('checkout_address');
    Route::post('/address/save', [CheckingoutController::class, 'save_address'])->name('save_address');

     
    Route::get('/shipping-address', [CheckingoutController::class, 'index_checkout2'])->name('checkout_shipping_address');
    Route::post('/shipping-address/save', [CheckingoutController::class, 'save_shipping_address'])->name('save_shipping_address');

     
    Route::get('/delivery', [CheckingoutController::class, 'index_checkout_delivery'])->name('checkout_delivery');
    Route::post('/delivery/save', [CheckingoutController::class, 'save_delivery_method'])->name('save_delivery_method');

     
    Route::get('/payment', [CheckingoutController::class, 'index_checkout_payment'])->name('checkout_payment');
    Route::post('/payment/save', [CheckingoutController::class, 'save_payment_method'])->name('save_payment_method');

     
    Route::get('/review', [CheckingoutController::class, 'index_checkout3'])->name('checkout_order_review');
    Route::delete('/review/item/{id}', [CheckingoutController::class, 'destroy'])->name('checkout_item_destroy');

     
    Route::post('/place-order', [CheckingoutController::class, 'placeOrder'])->name('checkout_place_order');

    
    Route::get('/confirmation', [CheckingoutController::class, 'orderConfirmation'])->name('checkout_order_confirm');
});
 
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

 