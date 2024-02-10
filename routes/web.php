<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Wallet routes
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets.index');
    Route::get('/wallets/create', [WalletController::class, 'create'])->name('wallets.create');
    Route::post('/wallets', [WalletController::class, 'store'])->name('wallets.store');
    Route::get('/wallets/{wallet}', [WalletController::class, 'show'])->name('wallets.show');
    Route::get('/wallets/{wallet}/edit', [WalletController::class, 'edit'])->name('wallets.edit');
    Route::put('/wallets/{wallet}', [WalletController::class, 'update'])->name('wallets.update');
    Route::delete('/wallets/{wallet}', [WalletController::class, 'destroy'])->name('wallets.destroy');

    Route::POST('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
    //Route::post('/wallets/{wallet}/transactions', [TransactionController::class, 'store'])->name('wallets.transactions.store');

    // Transaction routes (nested under Wallets)
    Route::get('/wallets/{wallet}/transactions', [TransactionController::class, 'index'])->name('wallets.transactions.index');
    Route::get('/wallets/{wallet}/transactions/create', [TransactionController::class, 'create'])->name('wallets.transactions.create');
    //Route::get('/wallets/{wallet}/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');

    Route::post('/transactions/{transaction}/mark-fraudulent', [TransactionController::class, 'markFraudulent'])
        ->name('transactions.mark-fraudulent');

    Route::post('/wallets/{wallet}/transactions', [TransactionController::class, 'store'])->name('wallets.transactions.store');
    Route::get('/wallets/{wallet}/transactions/{transaction}', [TransactionController::class, 'show'])->name('wallets.transactions.show');
    Route::get('/wallets/{wallet}/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('wallets.transactions.edit');
    Route::put('/wallets/{wallet}/transactions/{transaction}', [TransactionController::class, 'update'])->name('wallets.transactions.update');
    Route::delete('/wallets/{wallet}/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('wallets.transactions.destroy');
});

require __DIR__.'/auth.php';

