<?php

Route::get('/homelogin', 'LoginController@index');
Route::get('/login', 'LoginController@login');
Route::post('/loginPost', 'LoginController@loginPost');
Route::get('/logout', 'LoginController@logout');

Route::get('/homeweb', 'WebController@index');

Route::get('/homeuser', 'UserController@index');
Route::get('/create', 'UserController@create');
Route::post('/createPost', 'UserController@createPost');
Route::get('/show/{id}', 'UserController@show');
Route::get('/edit/{id}', 'UserController@edit');
Route::put('/update/{id}', 'UserController@update');
Route::get('/delete/{id}', 'UserController@delete');

Route::get('/homesampah', 'BankSampahController@index');
Route::get('/createsampah', 'BankSampahController@create');
Route::post('/createPostsampah', 'BankSampahController@createPost');
Route::get('/showsampah', 'BankSampahController@show');
Route::get('/editsampah/{id}', 'BankSampahController@edit');
Route::put('/updatesampah/{id}', 'BankSampahController@update');
Route::get('/deletesampah/{id}', 'BankSampahController@delete');

Route::get('/homebus', 'BusController@index');
Route::get('/createbus', 'BusController@create');
Route::post('/createPostbus', 'BusController@createPost');
Route::get('/showbus/{id}', 'BusController@show');
Route::get('/editbus/{id}', 'BusController@edit');
Route::put('/updatebus/{id}', 'BusController@update');
Route::get('/deletebus/{id}', 'BusController@delete');

Route::get('/homehelper', 'HelperController@index');
Route::get('/createhelper', 'HelperController@create');
Route::post('/createPosthelper', 'HelperController@createPost');
Route::get('/showhelper', 'HelperController@show');
Route::get('/edithelper/{id}', 'HelperController@edit');
Route::put('/updatehelper/{id}', 'HelperController@update');
Route::get('/deletehelper/{id}', 'HelperController@delete');

Route::get('/homepenumpang', 'PenumpangController@index');
Route::get('/showpenumpang/{id}', 'PenumpangController@show');





