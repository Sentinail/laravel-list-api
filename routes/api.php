<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\AuthController;

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

Route::post("/login_user", [AuthController::class, "login_user"]);
Route::post("/register_user", [AuthController::class, "register_user"]);

Route::get("/get_lists", [ListController::class, "get_lists"])->middleware('auth:sanctum');
Route::get("/get_user_lists", [ListController::class, "get_user_lists"])->middleware('auth:sanctum');

Route::post("/create_list", [ListController::class, "create_list"])->middleware('auth:sanctum');
Route::post("/delete_list", [ListController::class, "delete_list"])->middleware('auth:sanctum');
Route::post("/update_list_title", [ListController::class, "update_list_title"])->middleware('auth:sanctum');
Route::post("/update_list_content", [ListController::class, "update_list_content"])->middleware('auth:sanctum');
