<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\temp;

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
/*Route::get('/', function () {
    return view('brand-analytics');
});*/


Route::get('/brand-analytics/',[BrandController::class,'analyticsOld']);
Route::get('/add/', [ProjectsController::class,'projectListing']);
Route::get('/update/{projectId}', [ProjectsController::class,'updatepage']);
Route::post('/update/{projectId}', [ProjectsController::class,'update']);
Route::get('/',[BrandController::class,'analytics']);

//Temporary routes for Data visualization with Filters
Route::get('/temp',[ProjectsController::class,'analytics']);

//Final routes to edit project listings
Route::get('/show/{projectId}', [ProjectsController::class,'projectview']);
Route::get('/delete-record', [ProjectsController::class,'deleterecord']);
Route::get('/edit-record', [ProjectsController::class,'editrecord']);
Route::get('/add-record', [ProjectsController::class,'addrecord']);
Route::get('/remove-brand', [ProjectsController::class,'removebrand']);
Route::get('/add-brand', [ProjectsController::class,'addbrand']);

//For Pagination
Route::View('/tempajax','tempAjaxBasic');
Route::post('/ajax',[temp::class,'ajax']);