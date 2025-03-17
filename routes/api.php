<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvalistaController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::post('login_avalista', [AuthController::class, 'loginAvalista']);
    Route::middleware('auth:api_avalista')->get('verify_token_avalista', [AuthController::class, 'verifyToken']);
    Route::post('login_aluno', [AuthController::class, 'loginAluno']);
    Route::middleware('auth:api_aluno')->get('verify_token_aluno', [AuthController::class, 'verifyToken']);
});

Route::middleware('api')->resource('avalista', AvalistaController::class)->missing(function () {
        return response()->json(['message' => 'Rotas não encontradas'], 404);
})->except(['index', 'create', 'edit']);

Route::middleware('api')->resource('aluno', AlunoController::class)->missing(function () {
        return response()->json(['message' => 'Rotas não encontradas'], 404);
})->except(['index', 'create', 'edit']);
