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

Route::get('/',function(){
    return redirect()->route('category');
});
Route::get('category', [\App\Http\Controllers\CategoryController::class,'categori'])->name('category');
//category_insert
Route::post('category_insert', [\App\Http\Controllers\CategoryController::class,'category_insert']);
//category_update
Route::post('category_update', [\App\Http\Controllers\CategoryController::class,'category_update']);
//Hapud Data hapus_list
Route::get('hapus_list/{id}', [\App\Http\Controllers\CategoryController::class,'hapus_list']);
//Group Form
Route::prefix('/FormController')->group(function(){
        Route::controller(\App\Http\Controllers\FormController::class)->group(function(){
            Route::post('/form_categori', 'form_categori');
            Route::get('/form_edit_categori/{id}', 'form_edit_categori');
        });
    });
