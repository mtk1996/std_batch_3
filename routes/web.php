<?php

use App\Models\Cart;
use App\Models\OrderGroup;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    // return date('Y');
    $month_name = [date('F')];
    $year_month = [
        ['year' => date('Y'), 'month' => date('m')]
    ];

    for ($i = 1; $i < 6; $i++) {
        $prev_month_name = date('F', strtotime("-$i month"));
        $month_name[] = $prev_month_name;

        $prev_year = date('Y', strtotime("-$i month"));
        $prev_month = date('m', strtotime("-$i month"));
        array_push($year_month, ['year' => $prev_year, 'month' => $prev_month]);
    }

    $data = [];
    foreach ($year_month as $v) {
        $data[] = OrderGroup::whereYear('order_date', $v['year'])
            ->whereMonth('order_date', $v['month'])
            ->count();
    }
    $user = User::all();
    return view('admin.home', compact('data', 'month_name', 'user'));
});
//Website Route
Route::get('/', 'PageController@home');
Route::get('/product/{slug}', 'PageController@productDetail');

Route::group(['middleware' => ['Auth']], function () {
    Route::get('/add-cart/{slug}', 'CartController@addToCart');
    Route::get('/remove-cart/{id}', 'CartController@removeCart');
    Route::get('/cart', 'CartController@showCart');
    Route::get('/checkout', 'CartController@checkOut');

    Route::get('/order', 'OrderController@all');
    Route::get('/order-detail/{id}', 'OrderController@orderDetail');
    Route::get('profile', 'PageController@editProfile');
    Route::post('update-password', 'AuthController@updatePassword');
});


Route::get('/login', 'AuthController@showLogin')->middleware('RedirectIfAuth');
Route::post('/login', 'AuthController@login')->middleware('RedirectIfAuth');
Route::get('/register', 'AuthController@showRegister')->middleware('RedirectIfAuth');;
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => 'RedirectIfNotAuth'], function () {
    Route::get('/logout', 'AuthController@logout');
    //make review
    Route::post('/product-review', 'PageController@makeReview');
});

// Admin Route
Route::get('/admin/login', 'Admin\AuthController@showLogin');
Route::post('/admin/login', 'Admin\AuthController@login');

Route::group(['namespace' => "Admin", 'prefix' => '/admin', 'middleware' => "IsAdmin"], function () {
    Route::get('/', 'AuthController@home');
    Route::resource('supplier', 'SupplierController'); //   admin/supplier/create

    //product route
    Route::resource('product', 'ProductController'); //   admin/supplier/create
    Route::get('/create-product-add/{id}', 'ProductController@showProductAdd');
    Route::post('/create-product-add/{id}', 'ProductController@storeProductAdd');
    Route::get('/product-transaction', 'ProductController@showProductAddTran');

    // order
    Route::get('/order', 'OrderController@order');
    Route::get('/change-order/{id}', 'OrderController@changeOrderStatus');
});
