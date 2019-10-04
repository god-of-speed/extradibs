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

Route::post('/register','Auth\RegisterController@register');
Route::get('/package','HomeController@packagePage');
Route::get('/profile','UserController@profilePage');
Route::get('/dashboard','DashboardController@dashboardPage');
Route::get('/account','AccountController@accountPage');
Route::get('/login','Auth\LoginController@showLoginForm');
Route::post('/login','Auth\LoginController@login');
Route::get('/admin','AdminController@adminPage');
Route::post('/admin_package','AdminController@addPackage');
Route::get('/admin_package','AdminController@package');
Route::get('/admin_panel','AdminController@adminTable');
Route::get('/merge_account','AdminController@merging');
Route::get('/final_merge','AdminController@finalMerge');
Route::get('/block_account','AdminController@blockAccount');
Route::get('/unblock_account','AdminController@unBlockAccount');
Route::get('/new-account','AccountController@storeAccount');
Route::get('/re-invest','AccountController@reInvest');
Route::get('/close','AccountController@closeAccount');
Route::get('/logout','Auth\LoginController@logout');
Route::post('/upload_proof','AccountController@uploadProofOfPayment');
Route::get('/confirm_payment','AccountController@confirmPayment');
Route::get('/terms','HomeController@termsPage');
Route::get('/edit_user','UserController@showEditPage');
Route::post('/edit_user','UserController@edit');
Route::post('/upload_user_photo','UserController@uploadProfilePhoto');
Route::get('/','HomeController@index');
Route::any('/{str}','HomeController@index')->where('str','.*');