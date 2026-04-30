<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectRoleController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::resource('roles', RoleController::class);

    Route::resource('projects', ProjectController::class);

    Route::resource('projectroles', ProjectRoleController::class);

    Route::resource('applications', ApplicationController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
    Route::patch('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
});

require __DIR__.'/auth.php';