<?php

use App\Http\Controllers\Admin\ImpersonationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function (): void {
    Route::resource('ideas', IdeaController::class)->except(['show']);
    Route::post('/ideas/{idea}/refine', [IdeaController::class, 'refine'])->name('ideas.refine');
    Route::post('/ideas/{idea}/propose', [IdeaController::class, 'propose'])->name('ideas.propose');
});

Route::view('/planning', 'section-placeholder', ['title' => 'Planning'])->name('planning.index');
Route::view('/development', 'section-placeholder', ['title' => 'Development'])->name('development.index');
Route::view('/testing', 'section-placeholder', ['title' => 'Testing'])->name('testing.index');
Route::view('/security', 'section-placeholder', ['title' => 'Security'])->name('security.index');
Route::view('/ops', 'section-placeholder', ['title' => 'Ops'])->name('ops.index');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'can:access-admin'])->name('admin.dashboard');

Route::middleware(['auth', 'can:access-admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{user}/impersonate', [ImpersonationController::class, 'store'])->name('users.impersonate');
    Route::delete('/impersonation', [ImpersonationController::class, 'destroy'])->name('impersonation.destroy');
    Route::view('/roles', 'section-placeholder', ['title' => 'Roles'])->name('roles.index');
});
