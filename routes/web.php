<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestmentPlanController;
use App\Http\Controllers\WithdrawalController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/plans', 'plans')->name('plans');
    // Route::get('/deposit', [DepositController::class, 'index'])->name('deposit');
    Route::get('/deposit', [DepositController::class, 'create'])->name('deposit.create');
    Route::post('/deposit', [DepositController::class, 'store'])->name('deposit.store');
    Route::get('/deposit/confirmation/{deposit}', [DepositController::class, 'confirmation'])->name('deposit.confirmation');

    Route::get('/plans', [InvestmentPlanController::class, 'index'])->name('plans.index');
    Route::post('/plans/lock', [InvestmentPlanController::class, 'lock'])->name('plans.lock');
    Route::post('/plans/{lockedPlan}/unlock', [InvestmentPlanController::class, 'unlock'])->name('plans.unlock');
    Route::get('/withdraw', [WithdrawalController::class, 'showForm'])->name('withdraw.form');
    Route::post('/withdraw', [WithdrawalController::class, 'processWithdrawal'])->name('withdraw.process');
    Route::get('/withdraw/history', [WithdrawalController::class, 'history'])->name('withdraw.history');
    Route::view('/transactions', 'transactions')->name('transactions');
    Route::view('/investments', 'portfolio')->name('investments');
    Route::view('/kyc', 'kyc')->name('kyc');
    Route::view('/settings', 'settings')->name('settings');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

});

require __DIR__.'/auth.php';
