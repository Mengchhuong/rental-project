<?php

use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\RoomController;

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
//application/json
//create model php artisan make:model NameModel --migration
//create Controller php artisan make:controller NameController
// php artisan route:list

//Public route
Route::middleware('cors')->post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);



Route::post('/createroom',[RoomController::class,'createRoom']);
Route::get('/listroom',[RoomController::class,'listRoom']);
Route::delete('/deleteroom/{id}',[RoomController::class,'deleteRoom']);
Route::put('/updateroom/{id}',[RoomController::class,'updateRoom']);
// Route::get('/products/search/{name}',[ProductController::class,'search']);
// Route::get('/products/{id}',[ProductController::class,'show']);
// Route::get('/products',[ProductController::class,'index']);

Route::resource('rent', RentController::class)->except('store');
Route::post('rent/{id}',[RentController::class,'store']);
//Protected Route
Route::group(['middleware'=>['auth:sanctum', 'cors']],function(){
    // Route::post('/products',[ProductController::class,'store']);
    // Route::put('/products/{id}',[ProductController::class,'update']);
    // Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::post('/logout',[AuthController::class,'logout']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

