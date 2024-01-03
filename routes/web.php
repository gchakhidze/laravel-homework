<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

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

Route::get('/testmiddleware/on', function () {
    return 'my-super-middleware is on';
})->middleware('mysupermiddleware');

Route::get('/testmiddleware/off', function () {
    return 'my-super-middleware is off';
});

Route::resource('quizzes', QuizController::class);

