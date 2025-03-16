<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* ---------------------------------- Login ---------------------------------- */
Route::prefix('auth')->group(function () {
    Route::post('login_avalista', [AuthController::class, 'loginAvalista']);
    Route::middleware('auth:api_avalista')->get('verify_token_avalista', [AuthController::class, 'verifyToken']);
    Route::post('login_aluno', [AuthController::class, 'loginAluno']);
    Route::middleware('auth:api_aluno')->get('verify_token_aluno', [AuthController::class, 'verifyToken']);
});

