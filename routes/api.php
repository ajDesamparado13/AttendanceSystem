<?php

Route::post('login', 'Auth\LoginController@login');
Route::post('add_user', 'UsersController@store');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::resource('users', 'UsersController');
    Route::resource('machines', 'MachinesController');
    Route::resource('timelogs', 'TimelogsController');
    Route::get('profile', 'Api\User\ProfileController@edit');
    Route::post('profile_update', 'Api\User\ProfileController@update');
    Route::get('machine_employee_id', 'Api\Machine\EmployeeController@employeeId');
    Route::get('machine_mac_address', 'Api\Machine\MyMachineController@macAddress');
    Route::post('my-machine', 'Api\Machine\MyMachineController@store');
    Route::get('user_roles', 'Api\User\RoleController@index');
    Route::get('dashboard_menus', 'Api\Dashboard\MenuController@index');
});