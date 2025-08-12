<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/api/deposit/webhook', [DepositController::class, 'webhook'])
     ->name('deposit.webhook')
     ->withoutMiddleware(['csrf']);
