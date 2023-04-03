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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::prefix('/cat')->group(function(){
    Route::controller(\App\Http\Controllers\CategoryApiController::class)->group(function(){
        Route::get('/listCategory/', 'show');
        Route::post('/store', 'category_insert');
        Route::put('/store/{id}', 'category_update');
        Route::delete('/delete/{id}', 'hapus_list');
  });
});
