<?php

Route::post('login', 'Auth\LoginController@login');
Route::post('add_user', 'UsersController@store');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::resource('users', 'UsersController');
    Route::get('user_roles', 'Api\User\RoleController@index');
    Route::get('dashboard_menus', 'Api\Dashboard\MenuController@index');
});