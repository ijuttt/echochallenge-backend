<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyQuestController;
use App\Http\Controllers\PostController;


Route::apiResource('daily-quests', DailyQuestController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/posts/{post}/like', [PostController::class, 'like']);
    Route::post('/posts/{post}/dislike', [PostController::class, 'dislike']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});
