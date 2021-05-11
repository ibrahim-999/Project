<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// User Route
Route::post('adduser',[UserController::class,'addUser']);

//Route For Cities
Route::get('/city',[CityController::class , 'allcity']);
Route::get('city/{id}', [CityController::class , 'indexcity']);

//Route For Categories
Route::get('/category',[CategoryController::class , 'allcategory']);
Route::get('category/{id}', [CategoryController::class , 'indexcat']);


//Role Routes
Route::post('addrole',[RoleController::class,'addRole']);
//Order Routes
Route::post('createorder',[OrderController::class,'createOrder']);
//Ticket Routes
Route::post('createticket',[TicketController::class,'createTicket']);
//Comment Routes
Route::post('addcomment',[CommentController::class,'addComment']);
