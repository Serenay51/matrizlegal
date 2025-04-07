<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\LawController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/update-admin-status', [UserController::class, 'updateAdminStatus'])->name('update.admin.status');
    Route::get('/search-laws', [LawController::class, 'search'])->name('laws.search');
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/laws/create', [LawController::class, 'create'])->name('laws.create');
        Route::post('/laws/store', [LawController::class, 'store'])->name('laws.store');
        Route::get('/laws', [LawController::class, 'index'])->name('laws.index');
    });
});

require __DIR__.'/auth.php';
