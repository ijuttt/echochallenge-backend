<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\PoinController;

Route::post("/users/login", [AuthController::class, "auth"]);
Route::post("/register", [AuthController::class, "store"]);
Route::get('/leaderboard', [PoinController::class, 'index']);

Route::middleware("auth:sanctum")->group(function (){
    Route::prefix('posts')->group(function (){
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{post}/incLike', [PostController::class, 'incLike']);
        Route::put('/{post}/decLike', [PostController::class, 'decLike']);
        Route::put('/{post}/incDislike', [PostController::class, 'incDislike']);
        Route::put('/{post}/decDislike', [PostController::class, 'decDislike']);
        Route::delete('/{post}', [PostController::class, 'destroy']);
        Route::post('/report', [PostController::class, 'report']);
        Route::post('/{post}/report', [PostController::class, 'report']);
    });
    Route::prefix('users')->group(function (){
        Route::post("/logout", [AuthController::class, "logout"]);
        Route::post("/update/{user}", [AuthController::class, "update"]);
        Route::get("/", [AuthController::class, "getProfile"]);
    });
    Route::prefix('quests')->group(function(){
        Route::post('/complete/{quest}', [QuestController::class, 'completedQuest']);
        Route::get('/', [QuestController::class, 'index']);

    });
});
