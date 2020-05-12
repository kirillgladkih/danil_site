<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' =>'guest:admin'],function(){
    
    Route::get('login', 'LoginController@index')
    ->name('admin.login');
 
    Route::post('login', 'LoginController@login')
    ->name('admin.submit');


});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' =>'auth:admin'],function(){
    

    Route::get('logout', 'LoginController@logout')
    ->name('admin.logout');

    Route::resource('request', 'RequestController')
    ->names('admin.request');

    Route::resource('order', 'OrderController')
    ->names('admin.order');

});

Route::group(['prefix' => '/'], function(){


    Route::resource('', 'MainController')
    ->names('main');

    Route::resource('shop', 'ShopController')
    ->names('shop');

    Route::resource('basket', 'BasketController')
    ->names('basket');


});
