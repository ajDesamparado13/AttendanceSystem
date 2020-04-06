<?php

Route::post('login', 'Auth\LoginController@login');
Route::post('users', 'UsersController@store');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'Api\Role\RoleController');
    Route::resource('companies', 'Api\Company\CompanyController');
    Route::resource('employees', 'Api\Employee\EmployeeController');
    Route::resource('employees_companies', 'Api\Employee\CompanyController');
    Route::resource('employees_roles', 'Api\Employee\RoleController');
});