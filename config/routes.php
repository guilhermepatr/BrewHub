<?php

use App\Controllers\AuthenticationsController;
use App\Controllers\RevenuesController;
use Core\Router\Route;
use Core\Router\Router;

//Retrive
Route::get('/receitas', [RevenuesController::class, 'index'])->name('receitas.phtml');


// Authentication
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');
Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');
