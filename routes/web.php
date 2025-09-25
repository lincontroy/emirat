<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestmentPlanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WithdrawalController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/cron/process-locked-plans', [InvestmentPlanController::class, 'processLockedPlans']);

Route::middleware('auth')->group(function () {
    Route::post('/withdrawals/{withdrawal}', [AdminController::class, 'updateWithdrawalStatus'])->name('withdrawals.update');
    Route::post('/kyc/submit', [ProfileController::class, 'submitKYC'])->name('kyc.submit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/support', [ProfileController::class, 'support'])->name('profile.support');
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
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Users Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::post('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    
    // Deposits Management
    Route::get('/deposits', [AdminController::class, 'deposits'])->name('deposits');
    Route::patch('/deposits/{deposit}', [AdminController::class, 'updateDepositStatus'])->name('deposits.update');
    
    // Withdrawals Management
    Route::get('/withdrawals', [AdminController::class, 'withdrawals'])->name('withdrawals');
    
    
    // Investment Plans Management
    Route::get('/plans', [AdminController::class, 'investmentPlans'])->name('plans');
    Route::get('/plans/create', [AdminController::class, 'createPlan'])->name('plans.create');
    Route::post('/plans', [AdminController::class, 'storePlan'])->name('plans.store');
    Route::get('/plans/{plan}/edit', [AdminController::class, 'editPlan'])->name('plans.edit');
    Route::put('/plans/{plan}', [AdminController::class, 'updatePlan'])->name('plans.update');
    
    // Active Investments
    // User Management
Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');

// Transactions
Route::get('/admin/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');

// Admin Wallet Routes
Route::get('/settings/wallets', [AdminController::class, 'walletSettings'])->name('wallet.settings');
Route::post('/wallet', [AdminController::class, 'storeWallet'])->name('wallets.store');
// Reports
Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
// Admin Wallet Routes
Route::get('/investments', [AdminController::class, 'activeInvestments'])->name('investments');
Route::get('/users/kyc', [AdminController::class, 'index'])->name('users.kyc');
    Route::post('/kyc/{user}/approve', [AdminController::class, 'approve'])->name('kyc.approve');
    Route::post('/kyc/{user}/reject', [AdminController::class, 'reject'])->name('kyc.reject');
Route::post('/admin/wallets', [AdminController::class, 'storeWallet'])->name('admin.wallets.store');
Route::post('/wallets/{id}/toggle', [AdminController::class, 'toggleWalletStatus'])->name('wallets.toggle');

});


require __DIR__.'/auth.php';
