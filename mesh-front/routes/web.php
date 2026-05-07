<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StlGeneratorController;
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

    // Rutas del generador STL
    Route::get('/generator', [StlGeneratorController::class, 'index'])->name('generator.index');
    Route::post('/generator', [StlGeneratorController::class, 'generate'])->name('generator.generate');
    Route::get('/generator/{generatedModel}/download', [StlGeneratorController::class, 'download'])->name('generator.download');
    Route::get('/models/{generatedModel}', [StlGeneratorController::class, 'show'])->name('generator.show');
});

require __DIR__.'/auth.php';

