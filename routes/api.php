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

Route::namespace('App\Http\Controllers\API')->group(function (){
// User Route
    Route::get('/user',[UserController::class , 'allUsers']);
    Route::get('user/{id}', [UserController::class , 'indexUser']);
    Route::post('/create-user',[UserController::class,'createUser']);
    Route::put('/update-user-details/{id}',[UserController::class,'updateUserDetails']);
    Route::delete('/delete-user/{id}',[UserController::class,'deleteUser']);
    Route::delete('/delete-user-with-json',[UserController::class,'deleteUserWithJson']);

//Route For Cities
    Route::get('/city',[CityController::class , 'allCity']);
    Route::get('/city/{id}', [CityController::class , 'indexCity']);
    Route::post('/create-city',[CityController::class,'createCity']);
    Route::put('/update-city-details/{id}',[CityController::class,'updateCityDetails']);
    Route::delete('/delete-city/{id}',[CityController::class,'deleteCity']);
    Route::delete('/delete-city-with-json',[CityController::class,'deleteCityWithJson']);


//Route For Categories
    Route::get('/category',[CategoryController::class , 'allCategory']);
    Route::get('/category/{id}', [CategoryController::class , 'indexCategory']);
    Route::post('/create-category',[CategoryController::class,'createCategory']);
    Route::put('/update-category-details/{id}',[CategoryController::class,'updateCategoryDetails']);
    Route::delete('/delete-category/{id}',[CategoryController::class,'deleteCategory']);
    Route::delete('/delete-category-with-json',[CategoryController::class,'deleteCategoryWithJson']);

//Role Routes
    Route::post('/create-role',[RoleController::class,'createRole']);
    Route::get('/role',[RoleController::class,'allRoles']);
    Route::get('/role/{id}',[RoleController::class,'indexRole']);
    Route::put('/update-role/{id}',[RoleController::class,'updateRole']);
    Route::delete('/delete-role/{id}',[RoleController::class,'deleteRole']);
    Route::delete('/delete-role-with-json',[RoleController::class,'deleteRoleWithJson']);

//Order Routes
    Route::post('/create-order',[OrderController::class,'createOrder']);
    Route::get('/order',[OrderController::class,'allOrders']);
    Route::get('/order/{id}',[OrderController::class,'indexOrder']);
    Route::put('/update-order/{id}',[OrderController::class,'updateOrderDetails']);
    Route::delete('/delete-order/{id}',[OrderController::class,'deleteOrder']);
    Route::delete('/delete-order-with-json',[OrderController::class,'deleteOrderWithJson']);
//Ticket Routes
    Route::post('/create-ticket',[TicketController::class,'createTicket']);
    Route::get('/ticket',[TicketController::class,'allTickets']);
    Route::get('/ticket/{id}',[TicketController::class,'indexTicket']);
    Route::get('/show',[TicketController::class,'storeTicket']);
    Route::get('/search/{name}',[TicketController::class,'searchTicket']);
    Route::put('/update-ticket-details/{id}',[TicketController::class,'updateTicketDetails']);
    Route::delete('/delete-ticket/{id}',[TicketController::class,'deleteTicket']);
    Route::delete('/delete-ticket-with-json',[TicketController::class,'deleteTicketWithJson']);
//Comment Routes
    Route::post('/create-comment',[CommentController::class,'createComment']);
});
