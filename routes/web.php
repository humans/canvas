<?php

if (app()->environment('local')) {
    Route::view('doodles', 'doodles');
}

Route::get('/', 'HomeController')->name('home');

/*
|----------------------------------------------------------
| Registration
|----------------------------------------------------------
|
| This includes the email confirmation shebang.
|
*/

Route::get('register', 'RegisterController@create')->name('register');
Route::post('register', 'RegisterController@store')->name('register.store');

Route::get('get-started', 'ConfirmationCodesController@create')->name('confirmation-codes.create');
Route::resource('confirmation-codes', 'ConfirmationCodesController', [
    'only' => ['store'],
]);

/*
|----------------------------------------------------------
| Authentication
|----------------------------------------------------------
|
| I really don't like Laravel's defaults since it's not RESTful. It just
| really makes my OCPD act up. (╯°□°）╯︵ ┻━┻
|
| Well, since we're using a custom login, we kinda have an out, although,
| no one will really call us out or anything.
|
*/

Route::resource('login', 'LoginController', ['only' => ['store']]);
Route::get('login', 'LoginController@create')->name('login');
Route::get('logout', 'LoginController@destroy')->name('logout');

Route::impersonate();