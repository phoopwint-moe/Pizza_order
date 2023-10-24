<?php

use App\Http\Controllers\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Get
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'caregoryList']); //Read

//Post
Route::post('create/category', [RouteController::class, 'categoryCreate']); //Create

Route::get('category/delete/{id}', [RouteController::class, 'delete']); //delete

Route::get('category/list/{id}', [RouteController::class, 'list']); //read

Route::post('category/update', [RouteController::class, 'categoryUpdate']); //Create

/**
 * read list
 * localhost:8000/api/category/list (GET)
 * 
 * create
 * localhost:8000/api/create/category  (POST )
 * key => name
 * 
 * delete
 * localhost:8000/api/category/delete{id} (GET)
 * 
 * read
 * localhost:8000/api/category/list{id} (GET)
 * 
 * update
 * localhost:8000/api/category/update (POST)
 * key => id,name
 */