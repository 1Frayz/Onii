<?php

namespace Routes;

use App\Application\Router\Route;
use App\Controllers\LikeController;
use App\Controllers\UserController;
use App\Middleware\GuestMiddleware;
use App\Controllers\PostsController;
use App\Controllers\ProfileController;
use App\Controllers\CommentsController;
use App\Controllers\FollowersController;
use App\Controllers\SearchController;

Route::post('/register', UserController::class, 'register');
Route::post('/login', UserController::class, 'login');
Route::post('/logout', UserController::class, 'logout');
Route::post('/post/publish', PostsController::class, 'publish');
Route::post('/post/delete', PostsController::class, 'publish');
Route::post('/settings', ProfileController::class, 'update', GuestMiddleware::class);
Route::post('/follow', FollowersController::class, 'follow', GuestMiddleware::class);
Route::post('/following', FollowersController::class, 'following', GuestMiddleware::class);
Route::post('/like', LikeController::class, 'like', GuestMiddleware::class);
Route::post('/unlike', LikeController::class, 'unlike', GuestMiddleware::class);
Route::post('/add/comment', CommentsController::class, 'addComment', GuestMiddleware::class);
Route::post('/delete/comment', CommentsController::class, 'deleteComment', GuestMiddleware::class);
Route::post('/search', SearchController::class, 'search');
