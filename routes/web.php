<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/mahasiswa');
});

Route::get('/dashboard', function () {
    return redirect('/mahasiswa');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/dashboard/analisis', [DashboardController::class, 'analisis']);
    Route::get('/dashboard/ranking', [DashboardController::class, 'ranking']);

    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
    Route::post('/mahasiswa/update/{id}', [MahasiswaController::class, 'update']);
    Route::get('/mahasiswa/delete/{id}', [MahasiswaController::class, 'destroy']);
    Route::post('/mahasiswa/import', [MahasiswaController::class, 'import']);
});

require __DIR__.'/auth.php';
