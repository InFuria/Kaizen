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

/** Till manage */
Route::resource('till', 'TillController')->except(['edit', 'update', 'show', 'destroy']);
Route::get('till/{till}/extract', 'TillController@extract')->name('till.extract');
Route::get('till/charge', 'TillController@charge')->name('till.charge');
Route::post('till/{till}/status', 'TillController@status')->name('till.status');
Route::post('till/{till}/extraction', 'TillController@extraction')->name('till.extraction');
Route::post('till/{till}/deposit', 'TillController@deposit')->name('till.deposit');
