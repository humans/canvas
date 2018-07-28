<?php

Route::get('dashboard', 'DashboardController')->name('dashboard');

Route::resource('users', 'UsersController');
