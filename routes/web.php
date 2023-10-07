<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/firstname', function () {
    return 'giorgi';
});

Route::get('/lastname', function () {
    return 'chakhidze';
});

Route::get('/age', function () {
    return '23';
});

Route::get('/hobby', function () {
    return 'gaming';
});

Route::get('/language', function () {
    return 'php';
});

Route::post('/message', function () {
    $array = [
        'message' => "updated successfully"
    ];

    return response() -> json($array);
});

