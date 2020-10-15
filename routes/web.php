<?php

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('users')->group(function () {
    Route::match(['GET', 'POST'], '/', 'UserController@List')->name('users-list');
    Route::match(['GET', 'POST'], '/form', 'UserController@Insert')->name('users-insert');
    Route::match(['GET', 'POST'], '/form/{id?}', 'UserController@Update')->name('users-update');
    Route::match(['GET', 'POST'], '/find/{id?}', 'UserController@Find')->name('users-find');
    Route::delete('/delete/{id?}', 'UserController@delete')->name('users-delete');
});

Route::prefix('invoices')->group(function () {
    Route::post('/ajax-tmp-invoice', 'InvoiceController@AjaxTmpInvoice')->name('ajax-tmp-invoice');
    Route::match(['GET', 'POST'], '/', 'InvoiceController@List')->name('invoices-list');
    Route::match(['GET', 'POST'], '/form', 'InvoiceController@Insert')->name('invoices-insert');
    Route::match(['GET', 'POST'], '/form/{id?}', 'InvoiceController@Update')->name('invoices-update');
    Route::match(['GET', 'POST'], '/find/{id?}', 'InvoiceController@Find')->name('invoices-find');
    Route::delete('/delete/{id?}', 'InvoiceController@delete')->name('invoices-delete');
});

Route::prefix('clients')->group(function () {
    Route::match(['GET', 'POST'], '/', 'ClientController@List')->name('clients-list');
    Route::match(['GET', 'POST'], '/form', 'ClientController@Insert')->name('clients-insert');
    Route::match(['GET', 'POST'], '/form/{id?}', 'ClientController@Update')->name('clients-update');
    Route::match(['GET', 'POST'], '/find/{id?}', 'ClientController@Find')->name('clients-find');
    Route::delete('/delete/{id?}', 'ClientController@Delete')->name('clients-delete');
});

Route::prefix('products')->group(function () {
    Route::match(['GET', 'POST'], '/', 'ProductController@List')->name('products-list');
    Route::match(['GET', 'POST'], '/form', 'ProductController@Insert')->name('products-insert');
    Route::match(['GET', 'POST'], '/form/{id?}', 'ProductController@Update')->name('products-update');
    //Route::match(['GET', 'POST'], '/find/{id?}', 'ProductController@Find')->name('products-find');
    Route::delete('/delete/{id?}', 'ProductController@delete')->name('products-delete');
});

Route::prefix('customers')->group(function () {
    Route::match(['GET', 'POST'], '/', 'CustomerController@List')->name('customers-list');
    Route::match(['GET', 'POST'], '/form', 'CustomerController@Insert')->name('customers-insert');
    Route::match(['GET', 'POST'], '/form/{id?}', 'CustomerController@Update')->name('customers-update');
    Route::match(['GET', 'POST'], '/find/{id?}', 'CustomerController@Find')->name('customers-find');
    Route::delete('/delete/{id?}', 'CustomerController@delete')->name('customers-delete');
});

Route::prefix('stores')->group(function () {
    Route::match(['GET', 'POST'], '/', 'StoreController@List')->name('stores-list');
    Route::match(['GET', 'POST'], '/form', 'StoreController@Insert')->name('stores-insert');
    Route::match(['GET', 'POST'], '/form/{id?}', 'StoreController@Update')->name('stores-update');
    Route::match(['GET', 'POST'], '/find/{id?}', 'StoreController@Find')->name('stores-find');
    Route::delete('/delete/{id?}', 'StoreController@delete')->name('stores-delete');
});

Route::prefix('branches')->group(function () {
    Route::match(['GET', 'POST'], '/', 'BranchController@List')->name('branches-list');
    Route::match(['GET', 'POST'], '/form', 'BranchController@Insert')->name('branches-insert');
    Route::match(['GET', 'POST'], '/form/{id?}', 'BranchController@Update')->name('branches-update');
    Route::match(['GET', 'POST'], '/find/{id?}', 'BranchController@Find')->name('branches-find');
    Route::delete('/delete/{id?}', 'BranchController@delete')->name('branches-delete');
});





