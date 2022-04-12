<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\user\UserProfile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });


//admin route
//Route::get('/admin', [AdminController::class, 'index']);


//public route
//Route::get('/payment', [Home::class, 'payment']);

Route::get('/', [Home::class, 'index']);
Route::get('/success', [Home::class, 'success']);

Route::post('producturl', [Home::class, 'productsearch']);
Route::post('addtocart', [Home::class, 'addtocart']);

Route::get('cart', function () {
    return view('cart');
});

Route::post('cartitemdelete', [Home::class, 'deleteitemfromcart']);
Route::post('cartquantity', [Home::class, 'cartquantity']);


Route::get('login', function () {
    return view('login');
});
Route::post('userlogin', [Home::class, 'userlogin']);

Route::get('register', function () {
    return view('register');
});
Route::post('userregistration', [Home::class, 'userregistration']);

Route::group(["middleware" => "user"], function () {
    Route::get('/user/{userid}', [UserProfile::class, 'profile']);
    Route::get('checkout', function () {
        return view('checkout');
    });
});
