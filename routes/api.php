<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\Api\CommentController;


// Auth actions
Route::prefix('auth')->middleware('jwt.auth1')->group(function () {
    Route::get('refresh', [AuthController::class, 'refresh']);
    Route::get('logout',  [AuthController::class, 'logout']);
});


// Admin Routes

Route::middleware('admin.auth')->group(function () {

Route::delete('/delete_post', [MyController::class, 'deletePost'])->name('delete_post');

Route::post('/blog/store', [MyController::class, 'store'])
    ->name('blog.store');

Route::post('/blog/edit', [MyController::class, 'edit'])
    ->name('blog.edit');

Route::put('comments/{comment}',       [CommentController::class, 'update'])->name('update_comment');
Route::delete('comments/{comment}',    [CommentController::class, 'destroy'])->name('delete_comment');
});

// Public comment
Route::post('posts/{post}/comments',   [CommentController::class, 'store'])->name('comment.store')->middleware('jwt.auth1');
Route::get('posts/{post}/comments', [CommentController::class, 'index']);
Route::get('comments/{comment}',    [CommentController::class, 'show']);