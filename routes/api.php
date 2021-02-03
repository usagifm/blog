<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});


Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');

Route::middleware('auth:sanctum')->post('/article/create',  'ArticleController@create');
Route::middleware('auth:sanctum')->post('/article/update/{id}',  'ArticleController@update');
Route::middleware('auth:sanctum')->delete('/article/delete/{id}', 'ArticleController@delete');
Route::get('/article/articles',  'ArticleController@articles');
Route::get('/article/show/{id}',  'ArticleController@show');


