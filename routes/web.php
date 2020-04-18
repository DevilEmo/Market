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

Route::get('/', function () {
    return view('welcome');
});
Route::get('', function () {
    return view('auth.login');
});

// Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    // 'reset' => false, // Password Reset Routes...
    // 'verify' => false, // Email Verification Routes...
  ]);
  
Route::get('/home', 'HomeController@home')->name('/home');
//setting
Route::resource('setting', 'SettingsController');

// cashier panel
Route::get('/cashier/rent_payment', 'CashierController@rent_payment')->name('/cashier/rent_payment');
Route::get('/cashier/parking_payment', 'CashierController@parking_payment')->name('/cashier/parking_payment');
// Route::get('/cashier/about_us', 'CashierController@about_us')->name('/cashier/about_us');
Route::get('/cashier/stall_owner/{id}', 'StallOwnerController@show')->name('/cashier/stall_owner/{id}');
Route::get('/cashier/stall_owner/{id}/payment', 'CashierController@create_payment')->name('/cashier/stall_owner/{id}/payment');
Route::get('/cashier/parking_payment', 'CashierController@parking_records')->name('/cashier/parking_payment');

// admin panel

Route::post('/admin/stall_owner', 'StallOwnerController@store')->name('/admin/stall_owner');
Route::put('/admin/stall_owner/{id}', 'StallOwnerController@update')->name('/admin/stall_owner');
Route::get('/admin/stall_owner/{id}', 'StallOwnerController@show')->name('/admin/stall_owner/{id}');
Route::delete('/admin/delete/{id}', 'StallOwnerController@destroy')->name('/admin/delete/{id}');

Route::post('/admin/parking_records/add', 'ParkingController@store')->name('/admin/parking_records/add');
Route::put('/cashier/parking_records/{id}', 'ParkingController@update')->name('/cashier/parking_records/{id}');
Route::get('/admin/parking_records/{id}/view', 'AdminController@admin_parking_view')->name('/admin/parking_records/{id}/view');
// Route::post('/admin/create_stall_owner_post', 'AdminController@create_stall_owner_post')->name('/admin/create_stall_owner_post');
Route::get('/admin/stall_owner_list', 'AdminController@stall_owner_list')->name('/admin/stall_owner_list');
Route::get('/admin/parking_records', 'AdminController@parking_records')->name('/admin/parking_records');
Route::get('/admin/create_stall_owner', 'AdminController@create_stall_owner')->name('/admin/create_stall_owner');
Route::get('/admin/update_stall_owner/{id}', 'AdminController@update_stall_owner')->name('/admin/update_stall_owner/{id}');
Route::get('/admin/payment/{id}', 'AdminController@create_payment')->name('/admin/payment/{id}');
Route::get('/cashier/payment/{id}', 'CashierController@create_payment')->name('/cashier/payment/{id}');
Route::get('/payment', 'PaymentController@store')->name('/payment');
Route::put('/payment/{id}', 'PaymentController@update')->name('/payment/{id}');

Route::get('/admin/parking_records/printdetail/{id}', 'AdminController@printdetail')->name('/admin/parking_records/printdetail/{id}');