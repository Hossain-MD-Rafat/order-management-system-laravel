<?php

use App\Http\Controllers\admin\AdminController;
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

Route::get('cartview', [UserProfile::class, 'cart']);

Route::group(["middleware" => "user"], function () {
    Route::get('/user', [UserProfile::class, 'profile']);
    Route::get('user/account', function () {
        return view('user.account');
    });
    Route::post('user/changeaccountinfo', [UserProfile::class, 'changeaccountinfo']);

    Route::get('user/shipping', [UserProfile::class, 'shipping']);
    Route::post('user/addshipping', [UserProfile::class, 'addshipping']);

    Route::get('user/address', [UserProfile::class, 'address']);
    Route::get('user/addressform/{id?}', [UserProfile::class, 'addressform']);
    Route::post('user/addaddress', [UserProfile::class, 'addaddress']);
    Route::post('user/addressdelete', [UserProfile::class, 'addressdelete']);
    Route::get('checkout', function () {
        return view('user.checkout');
    });
    Route::get('order/{id}', [UserProfile::class, 'order']);
    Route::get('user/signout', [UserProfile::class, 'signout']);
});

Route::group(["middleware" => "admin"], function () {
    Route::get('admin', [AdminController::class, 'adminDashboard']);
    Route::get('admin/orderedit/{id}', [AdminController::class, 'orderedit']);
    Route::get('admin/changeadminpass', function () {
        return view('admin.changepass');
    });
    Route::post('admin/changeadminpass', [AdminController::class, 'changeadminpass']);
    Route::post('admin/saveorderedit/{oid}/{pid}', [AdminController::class, 'saveitem']);
    Route::post('admin/saveorderedit/{oid}', [AdminController::class, 'ordersave']);
    Route::post('admin/updatestatus', [AdminController::class, 'updatestatus']);
    Route::get('adminsignout', [AdminController::class, 'signout']);
});

Route::get('site-admin/login', function () {
    return view('admin.login');
});
Route::post('adminlogin', [Home::class, 'adminlogin']);

Route::post('sendcustomerquery', [Home::class, 'sendcustomerquery']);
