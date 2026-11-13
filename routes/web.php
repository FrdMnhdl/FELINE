<?php

use App\Http\Controllers\Admin\CatController as AdminCatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CatController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request): RedirectResponse {
    $user = $request->user();

    if (! $user) {
        return redirect()->route('login');
    }

    return $user->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('cats.index');
})->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])
        ->middleware('throttle:20,1')
        ->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    Route::middleware('role:admin,user')->group(function (): void {
        Route::get('/cats', [CatController::class, 'index'])->name('cats.index');
        Route::get('/cats/{cat}', [CatController::class, 'show'])->name('cats.show');
    });

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function (): void {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/cats/create', [AdminCatController::class, 'create'])->name('cats.create');
            Route::post('/cats', [AdminCatController::class, 'store'])->name('cats.store');
            Route::get('/cats/{cat}/edit', [AdminCatController::class, 'edit'])->name('cats.edit');
            Route::match(['put', 'patch'], '/cats/{cat}', [AdminCatController::class, 'update'])->name('cats.update');
            Route::delete('/cats/{cat}', [AdminCatController::class, 'destroy'])->name('cats.destroy');
        });
});
