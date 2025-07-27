<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
// DashboardController
use App\Http\Controllers\DashboardController;
use App\Models\Task;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $tasks = Task::latest()->get();

    $total = $tasks->count();
    $completed = $tasks->where('is_completed', true)->count();
    $pending = $tasks->where('is_completed', false)->count();

    $latestTasks = $tasks->take(5); // Son 5 görevi göster

    return view('dashboard', compact('tasks', 'total', 'completed', 'pending', 'latestTasks'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Görevi tamamlama işlemi (custom patch route)
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    // Görev CRUD işlemleri için resource route
    Route::resource('tasks', TaskController::class);
    
    // Kategori işlemleri için route
    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])
        ->name('categories.index');
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])
        ->name('categories.store');
    Route::put('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])
        ->name('categories.update');
    Route::delete('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])
        ->name('categories.destroy');
});

require __DIR__.'/auth.php';
