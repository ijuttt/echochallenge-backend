<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\PoinController;

Route::post("/users/login", [AuthController::class, "auth"]);
Route::get('/leaderboard', [PoinController::class, 'index']);

Route::middleware("auth:sanctum")->group(function (){
    Route::prefix('posts')->group(function (){
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{post}/like', [PostController::class, 'like']);
        Route::put('/{post}/dislike', [PostController::class, 'dislike']);
        Route::delete('/{post}', [PostController::class, 'destroy']);
        Route::post('/posts/{post}/report', [PostController::class, 'report']);
    });
    Route::prefix('users')->group(function (){
        Route::post("/logout", [AuthController::class, "logout"]);
        Route::post("/register", [AuthController::class, "create"]);
        Route::post("/update/{user}", [AuthController::class, "update"]);
        Route::get("/{user}", [AuthController::class, "getById"]);
    });
    Route::prefix('quests')->group(function(){
        Route::post('/complete/{quest}', [QuestController::class, 'completedQuest']);
        Route::get('/', [QuestController::class, 'index']);

    });
});
