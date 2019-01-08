<?php

Route::get('/', 'ShopController@getAllProducts');

Route::middleware(['auth'])->group(function () {

    Route::get('/shopping-cart', 'ShopController@getShoppingCart');

    Route::get('/add-product/{id}', 'ShopController@addOneProduct');

    Route::get('/increase-quantity/{id}', 'ShopController@addOneProduct');

    Route::get('/decrease-quantity/{id}', 'ShopController@removeOneProduct');

    Route::get('/remove-all', 'ShopController@removeAllProducts');

    Route::post('/re-calculate', 'ShopController@reCalculate');

    Route::post('/pay', 'ShopController@pay');

    Route::view('/success', 'shop.success');

    Route::get('/display-orders', 'ShopController@displayOrders')->name('display-orders');

    Route::get('/order/{id?}', 'ShopController@showOrder');

    Route::post('/delete/{id?}', 'ShopController@deleteOrder');

});

Auth::routes();


