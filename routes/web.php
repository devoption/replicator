<?php

use App\Http\Controllers\Admin\ImpersonationController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Idea;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function (): void {
    Route::get('/ideas', function () {
        return view('ideas.index', [
            'ideas' => Idea::query()
                ->whereBelongsTo(auth()->user())
                ->orderByDesc('updated_at')
                ->get(),
        ]);
    })->name('ideas.index');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'can:access-admin'])->name('admin.dashboard');

Route::middleware(['auth', 'can:access-admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{user}/impersonate', [ImpersonationController::class, 'store'])->name('users.impersonate');
    Route::delete('/impersonation', [ImpersonationController::class, 'destroy'])->name('impersonation.destroy');
});
