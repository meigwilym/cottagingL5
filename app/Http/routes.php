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

Route::get('/', ['as' => 'home', 'uses' => 'CottageController@index']);

Route::get('cottages', ['as' => 'home', 'uses' => 'CottageController@index']);
Route::get('cottages/{slug}', ['as' => 'show', 'uses' => 'CottageController@show']);

// bookings
// booking form
Route::get('booking/{cottagename}', ['as'=> 'booking.create', 'uses', 'BookingController@create']);
// store draft booking
Route::post('booking/{cottagename}', ['as' => 'booking.store', 'uses'=> 'BookingController@store']);
// booking make payment
Route::get('booking/{id}/payment', ['as' => 'booking.payment', 'uses'=> 'BookingController@payment']);
Route::post('booking/{id}/payment', ['as' => 'booking.payment.make', 'uses'=> 'BookingController@processPayment']);
// show confirmation
Route::get('booking/{id}/confirm', ['as' => 'booking.confirm', 'uses'=> 'BookingController@confirm']);

// ajax requests
Route::group(['prefix' => 'api', 'middleware' => 'ajax'], function()
{
  Route::post('cottage/{slug}/quote', ['uses' => 'CottageAjaxController@quote']);
});