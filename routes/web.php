<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/', 'HomeController@index');


Route::group(['middleware' => 'auth'], function(){
	Route::group(['middleware' => 'super admin'], function() {
		
		Route::resource('kategoris', 'KategoriController');
		Route::resource('kotas', 'KotaController');
		Route::resource('brands', 'BrandController');
		Route::resource('customers', 'CustomerController');
		Route::resource('sizes', 'SizesController');
		Route::resource('styles', 'StylesController');
		Route::resource('gudang','GudangController');
		Route::resource('shippings','ShippingController');
		Route::resource('payments','PaymentController');
		Route::resource('tipe','TipeController');
		Route::resource('channels','ChannelController');
		Route::resource('suppliers','SupplierController');
		Route::resource('posts','PostsController');
		Route::resource('salesOrders','SalesOrdersController');
		Route::resource('do','DeliveryOrderController');
	});

	Route::group(['middleware' => 'admin'], function() {
		Route::resource('kategoris', 'KategoriController');
		Route::resource('user', 'UserController');
		Route::resource('kotas', 'KotaController');
		Route::resource('brands', 'BrandController');
		Route::resource('customers', 'CustomerController');
		Route::resource('sizes', 'SizesController');
		Route::resource('styles', 'StylesController');
		Route::resource('gudang','GudangController');
		Route::resource('shippings','ShippingController');
		Route::resource('payments','PaymentController');
		Route::resource('tipe','TipeController');
		Route::resource('channels','ChannelController');
		Route::resource('suppliers','SupplierController');
		Route::resource('posts','PostsController');
		Route::resource('salesOrders','SalesOrdersController');
		Route::resource('do','DeliveryOrderController');
	});

	Route::group(['middleware' => 'staf sales'], function() {
		Route::resource('kategoris', 'KategoriController');
		Route::resource('kotas', 'KotaController');
		Route::resource('brands', 'BrandController');
	});

	Route::group(['middleware' => 'staf finance'], function() {
		Route::resource('payments','PaymentController');
		Route::resource('tipe','TipeController');
		Route::resource('channels','ChannelController');
		Route::resource('suppliers','SupplierController');
		Route::resource('posts','PostsController');
		Route::resource('salesOrders','SalesOrdersController');
	});

	Route::group(['middleware' => 'staf gudang'], function() {
		Route::resource('payments','PaymentController');
		Route::resource('tipe','TipeController');
		Route::resource('channels','ChannelController');
		Route::resource('suppliers','SupplierController');
		Route::resource('products','ProductController');
		Route::resource('posts','PostsController');
	});
});




