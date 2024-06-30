<?php

namespace Routes;

use App\Application\Router\Route;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Controllers\PagesController;

Route::page("/", PagesController::class, 'index');
Route::page('/login', PagesController::class, 'login', AuthMiddleware::class);
Route::page('/register', PagesController::class, 'register', AuthMiddleware::class);
Route::dynamic('/profile/{username}', PagesController::class, 'profile');
Route::page('/settings', PagesController::class, 'settings', GuestMiddleware::class);
Route::page('/post', PagesController::class, 'post', GuestMiddleware::class);
Route::page('/newest', PagesController::class, 'newest', GuestMiddleware::class);
Route::page('/following', PagesController::class, 'following', GuestMiddleware::class);
Route::dynamic('/{username}/followers', PagesController::class, 'followers');
Route::dynamic('/post/{id}', PagesController::class, 'detail');
Route::dynamic('/search/{query}', PagesController::class, 'search');
Route::dynamic('/selection/{tag}', PagesController::class, 'selection');
