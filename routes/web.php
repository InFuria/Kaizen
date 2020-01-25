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


Route::get('ticket', function (){
    return view('ticket.invoice');
});

Route::get('orden', function (){
    return view('ticket.order');
});


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
    /*Route::resource('stock', 'StockController');*/
    Route::get('stock', 'StockController@index')->name('stock.index');
    Route::get('stock/adjustment', 'StockController@adjustment')->name('stock.adjustment');
    Route::get('stock/charge', 'StockController@charge')->name('stock.charge');
    Route::post('stock/discount', 'StockController@discount')->name('stock.discount');
    Route::post('stock/store', 'StockController@store')->name('stock.store');
    Route::get('stock/audit', ['as' => 'stock.audit', 'uses' => 'StockController@audit']); //View para gestion de auditorias de stock

    /** Delivery manage */
    Route::resource('delivery', 'DeliveryController');

    /** Products manage */
    Route::resource('products', 'ProductController');

    /** Sales manage */
    Route::get('sales', 'SalesController@index')->name('sales.index');
    Route::get('sales/getProducts', 'SalesController@getProducts')->name('sales.getProducts');
    Route::get('sales/removeProduct', 'SalesController@removeProduct')->name('sales.removeProduct');
    Route::post('sales/addProduct', 'SalesController@addProduct')->name('sales.addProduct');
    Route::post('sales/store', 'SalesController@store')->name('sales.store');
    Route::get('sales/salesEnd', 'SalesController@salesEnd')->name('sales.salesEnd');
    //Route::get('sales/order', 'SalesController@order')->name('sales.order');

    /** Support */
    Route::get('support', 'SupportController@index');

    /** Till manage */
    Route::resource('till', 'TillController')->except(['edit', 'update', 'show', 'destroy']);
    Route::get('till/{till}/extract', 'TillController@extract')->name('till.extract');
    Route::get('till/{till}/charge', 'TillController@charge')->name('till.charge');
    Route::get('till/{till}/cashCount', 'TillController@cashCount')->name('till.cashCount');
    Route::post('till/{till}/status', 'TillController@status')->name('till.status');
    Route::post('till/{till}/extraction', 'TillController@extraction')->name('till.extraction');
    Route::post('till/{till}/deposit', 'TillController@deposit')->name('till.deposit');
    Route::post('till/{till}/audit', 'TillController@audit')->name('till.audit');

    /** Expenses */
    Route::resource('expenses', 'ExpensesController');


    /** Reports */
    Route::get('reports', 'ReportsController@index')->name('reports.index');
    Route::get('reports/daily', 'ReportsController@daily')->name('reports.daily');
    Route::get('reports/daily_products', 'ReportsController@dailyProducts')->name('reports.daily_products');
    Route::get('reports/tillHistory', 'ReportsController@tillHistory')->name('reports.tillHistory');
});

Route::get('/pdf','PrinterController@printPDF');
