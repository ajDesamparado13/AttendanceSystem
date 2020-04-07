<?php

Route::get('/', 'HomeController@index');

Route::get('/{any}', 'HomeController@index')->where('any', '.*');

Auth::routes();