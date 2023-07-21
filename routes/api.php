<?php

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/penumpang/profile','Api\PenumpangController@profile');
Route::get('/penumpang/historytukarsampah','Api\PenumpangController@historytukarsampah');
Route::get('/penumpang/historynaikbus','Api\PenumpangController@historynaikbus');

Route::post('/banksampah','Api\BankSampahController@getbanksampah'); 
Route::post('/banksampah/tukarsampah','Api\BankSampahController@tukarsampah'); 
Route::get('/banksampah/historytukarsampah','Api\BankSampahController@historytukarsampah');
Route::post('/banksampah/topup','Api\BankSampahController@topup');
Route::get('/banksampah/historytopup','Api\BankSampahController@historytopup');
Route::get('/banksampah/profile','Api\BankSampahController@profile');

Route::post('/helper/naikbus','Api\HelperController@naikbus');
Route::get('/helper/historynaikbus','Api\HelperController@historynaikbus');
Route::get('/helper/profile','Api\HelperController@profile');

Route::post('/user/register','Api\UserController@register');
Route::post('/user/login','Api\UserController@login');




