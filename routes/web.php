<?php
use App\Entities\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', function(){
    return Auth::check();
});
// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');

// Auth::routes();