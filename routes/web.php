<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'can:access-admin'])->name('admin.dashboard');
