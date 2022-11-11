<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ScoreController;
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

Route::get('/scores', [ScoreController::class, 'index']);
Route::get('/scores/{league}', [ScoreController::class, 'index']);

Route::get('/data', [DataController::class, 'index']);