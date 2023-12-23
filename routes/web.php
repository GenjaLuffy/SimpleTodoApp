<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    
    Route::post('/todos/create', [TodoController::class, 'create'])->name('todo.create');
    Route::patch('/todos/{todo}/update', [TodoController::class, 'update'])->name('todo.update');
    Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit');
    Route::delete('/todos/{todo}/destroy', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::post('/todos/{todo}/status', [TodoController::class, 'status'])->name('todo.status');
});
Route::get('/todos', [TodoController::class, 'index'])->name('todo.index');

require __DIR__ . '/auth.php';
