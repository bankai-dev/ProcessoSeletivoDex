<?php

use App\Http\Controllers\TransportadoraController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/register');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('api')->middleware('api')->group(function () {
    Route::get('/transportadoras', [TransportadoraController::class, 'index']);
    Route::post('/transportadoras', [TransportadoraController::class, 'store']);
    Route::get('/transportadoras/{id}', [TransportadoraController::class, 'show']);
    Route::put('/transportadoras/{id}', [TransportadoraController::class, 'update']);
    Route::delete('/transportadoras/{id}', [TransportadoraController::class, 'destroy']);
});

Route::prefix('transportadoras')->group(function () {
    Route::post('/cep', [TransportadoraController::class, 'buscarEnderecoPorCEP']);
});

require __DIR__.'/auth.php';
