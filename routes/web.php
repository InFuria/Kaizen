<?php

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

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


/** Auth Routes manage */
Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/', 'DashboardController@index')->name('dashboard.index');


    /** General Manage System */
    Route::resource('users', 'UserController');
    Route::post('users/{user}/ban', 'UserController@ban')->name('users.ban');

    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('expenses', 'ExpensesController');


    /** Cashier manage */
    Route::resource('cashier', 'CashierController');


    /** StockController manage */
    Route::resource('stock', 'StockController');
    Route::get('stock/audit', ['as' => 'stock.audit', 'uses' => 'StockController@audit']); //View para gestion de auditorias de stock

    /** Delivery manage */
    Route::resource('delivery', 'DeliveryController');


    /** Reports manage */
    Route::resource('reports', 'ReportsController');

    /** Products manage */
    Route::resource('products', 'ProductController');

    /** Sales manage */
    Route::resource('sales', 'SalesController');

    /** Support */
    Route::get('support', 'SupportController@index');
});
