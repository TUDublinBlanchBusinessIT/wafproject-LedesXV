<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (must be logged in)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Protected pages
Route::middleware(['auth'])->group(function () {

    Route::get('/roles', function () {
        return 'Roles page coming soon';
    })->name('roles.index');

    Route::get('/projects', function () {
        return 'Projects page coming soon';
    })->name('projects.index');

    Route::get('/project-roles', function () {
        return 'Project Roles page coming soon';
    })->name('projectroles.index');

    Route::get('/applications', function () {
        return 'Applications page coming soon';
    })->name('applications.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::resource('roles', \App\Http\Controllers\RoleController::class);

    Route::resource('projects', \App\Http\Controllers\ProjectController::class);
});

require __DIR__.'/auth.php';