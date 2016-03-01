<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

// Route::get('/','MainController@index');
// Route::post('/store','MainController@store');



// Paypal
Route::post('/addToMyCart','ItemController@addToCartCon');
Route::get('/', 'ItemController@home');
Route::post('/pay', ['as' => 'pay', 'uses' => 'PaypalController@pay']);
Route::get('/payment_status',['as'=>'paymentStatus',
                    'uses'=>'PaypalController@paymentStatus'
    ]);
Route::get('/mycart','ItemController@mycart');

