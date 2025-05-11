<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ReplyController;
use App\Http\Controllers\API\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);


Route::middleware('auth:sanctum')->group(function(){
Route::post("/logout", [AuthController::class, "logout"]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/posts', PostController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("/comments", CommentController::class);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("/replies", ReplyController::class);
});
