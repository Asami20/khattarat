<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GallerieController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\KhettaratController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\MessageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'addUser']);
Route::post('/login', [AuthController::class, 'Login']);

// Gallerie routes
Route::post('/AddImg', [GallerieController::class, 'addImage']);
Route::post('/updateImg/{id_gallerie}', [GallerieController::class, 'UpdateImg']);
Route::post('/deleteImg/{id_gallerie}', [GallerieController::class, 'delete']);
Route::get('/galleris', [GallerieController::class, 'show']);

// Livre routes
Route::post('/Livre', [LivreController::class, 'addLivre']);
Route::post('/update/{id}', [LivreController::class, 'updateLivre']);
Route::delete('/delete/{id}', [LivreController::class, 'deleteLivre']);
Route::get('/allLivre', [LivreController::class, 'show']);

// Khettarat routes
Route::post('/addKhetrrat', [KhettaratController::class, 'addKhetrrat']);
Route::post('/updateKhetrrat/{id_khettarat}', [KhettaratController::class, 'updateKhettarat']);
Route::delete('/deleteKhetrrat/{id_khettarat}', [KhettaratController::class, 'deleteKhettarat']);
Route::get('/allKhetrrat', [KhettaratController::class, 'show']);

// Publication routes
Route::post('/addPub', [PublicationController::class, 'addPub']);
Route::post('/updatePub/{id}', [PublicationController::class, 'updatePub']);
Route::delete('/deletePub/{id}', [PublicationController::class, 'deletePub']);
Route::get('/allPub', [PublicationController::class, 'show']);

// Verification routes
Route::post('/send', [VerificationController::class, 'sendVerificationEmail'])->middleware('auth');
Route::post('/verify-email', [VerificationController::class, 'verifyEmail']);

// Admin routes
Route::post('/admin/login', [LoginAdminController::class, 'login']);
Route::put('/admin/update/{id}', [LoginAdminController::class, 'update']);

// Message routes
Route::post('/messages', [MessageController::class, 'store']);
