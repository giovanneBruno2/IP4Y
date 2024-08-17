<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TaskController;
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
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/project', [ProjectsController::class, 'index'])->name('project.index');
    Route::get('/project/create', [ProjectsController::class, 'create'])->name('project.create');
    Route::post('/project/store', [ProjectsController::class, 'store'])->name('project.store');
    Route::get('/project/{project}', [ProjectsController::class, 'edit'])->name('project.edit');
    Route::patch('/project/{project}', [ProjectsController::class, 'update'])->name('project.update');
    Route::delete('/project/{project}', [ProjectsController::class, 'destroy'])->name('project.destroy');
    Route::get('/project/{project}/task', [ProjectsController::class, 'show'])->name('project.task');
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/task', [TaskController::class, 'create'])->name('task.create');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/{task}', [TaskController::class, 'edit'])->name('task.edit');
    Route::patch('/task/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('/project/export/{type}', [TaskController::class, 'exportTasks'])->name('task.exportTasks');

});

require __DIR__.'/auth.php';
