<?php

Route::post('login', 'Auth\LoginController@login');
Route::post('add_user', 'UsersController@store');
Route::get('/verify-user/{code}', 'Auth\RegisterController@activateUser');
Route::group(['namespace' => 'Auth', 'prefix' => 'password'], function () {
    Route::post('create', 'ResetPasswordController@create');
    Route::get('find/{token}', 'ResetPasswordController@find');
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::resource('users', 'UsersController');
    Route::resource('machines', 'MachinesController');
    Route::resource('timelogs', 'TimelogsController');
    Route::get('profile', 'Api\User\ProfileController@edit');
    Route::post('profile_update', 'Api\User\ProfileController@update');
    Route::post('profile_change_password', 'Api\User\ProfileController@changePassword');
    Route::post('my-machine', 'Api\Machine\MyMachineController@store');
    Route::post('change_password', 'UsersController@changePassword');
    Route::get('machine_employee_id', 'Api\Machine\EmployeeController@employeeId');
    Route::get('machine_mac_address', 'Api\Machine\MyMachineController@macAddress');
    Route::get('user_roles', 'Api\User\RoleController@index');
    Route::get('dashboard_menus', 'Api\Dashboard\MenuController@index');
});