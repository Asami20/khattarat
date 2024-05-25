<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\MessageController;



Route::post('/admin/login', [LoginAdminController::class, 'login']);
Route::put('/admin/update/{id}', [LoginAdminController::class, 'update']);
Route::post('/messages', [MessageController::class, 'store']);
