<?php

use App\Http\Controllers\GuestController;

// Реализация личного кабинета отложена до лучших времён
Auth::routes([
	'verify' => false, 
	'register' => false, 
	'login' => false
]);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [GuestController::class, 'getHome']);
    Route::get('/oils', [GuestController::class, 'getHtmlOils']);
    Route::get('/oil/{name}', [GuestController::class, 'getHtmlOil']);
    Route::get('/json/oil/{name}', [GuestController::class, 'getJsonOil']);
});