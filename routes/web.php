<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

    Route::get('/tickets', [TicketController::class, 'index'])
        ->middleware(['verified', 'permission:ver tickets'])
        ->name('tickets.index');

    Route::get('/tickets/create', [TicketController::class, 'create'])
        ->middleware(['verified', 'permission:crear tickets'])
        ->name('tickets.create');

    Route::post('/tickets', [TicketController::class, 'store'])
        ->middleware(['verified', 'permission:crear tickets'])
        ->name('tickets.store');

    Route::get('/tickets/manage', [TicketController::class, 'manage'])
        ->middleware(['verified', 'permission:gestionar tickets'])
        ->name('tickets.manage');
});

Route::middleware(['auth', 'verified', 'role:administrador'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])
        ->middleware('permission:ver usuarios')
        ->name('users.index');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->middleware('permission:gestionar usuarios')
        ->name('users.edit');
});

require __DIR__.'/auth.php';
