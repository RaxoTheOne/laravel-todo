<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('tasks.index'));

Route::resource('tasks', TaskController::class);

// Filter
Route::get('tasks/filter/{status}', [TaskController::class, 'filter'])->name('tasks.filter');

// Zusatz-Route zum Status-umschalten
Route::get('tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
