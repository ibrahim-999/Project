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
Route::get('/city',[CityController::class , 'allCity']);
Route::get('city/{id}', [CityController::class , 'indexCity']);
Route::post('create-city',[CityController::class,'createCity']);

//Route For Categories
Route::get('/category',[CategoryController::class , 'allCategory']);
Route::get('category/{id}', [CategoryController::class , 'indexCategory']);
Route::post('/create-category',[CategoryController::class,'createCategory']);

//Role Routes
Route::post('create-role',[RoleController::class,'createRole']);
Route::get('/role',[RoleController::class,'allRoles']);
Route::get('role/{id}',[RoleController::class,'indexRole']);

//Order Routes
Route::post('create-order',[OrderController::class,'createOrder']);
Route::get('/order',[OrderController::class,'allOrders']);
Route::get('order/{id}',[OrderController::class,'indexOrder']);
//Ticket Routes
Route::post('create-ticket',[TicketController::class,'createTicket']);
Route::get('/ticket',[TicketController::class,'allTickets']);
Route::get('ticket/{id}',[TicketController::class,'indexTicket']);
Route::get('show',[TicketController::class,'storeTicket']);
//Comment Routes
Route::post('create-comment',[CommentController::class,'createComment']);
