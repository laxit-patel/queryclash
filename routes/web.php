<?php

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(\App\Http\Controllers\PromptController::class)->group(function () {
        Route::get('/prompt', 'index')->name('prompt');
        Route::get('/prompt/create', 'create')->name('prompt.create');
        Route::post('/prompt', 'store')->name('prompt.store');
        Route::get('/prompt/{prompt}/edit', 'edit')->name('prompt.edit');
        Route::put('/prompt/{prompt}', 'update')->name('prompt.update');
        Route::delete('/prompt/{prompt}', 'destroy')->name('prompt.destroy');
        Route::get('/prompt/{prompt}/perform', 'perform')->name('prompt.perform');
        Route::post('/prompt/{prompt}/execute', 'execute')->name('prompt.execute');
    });

});

require __DIR__.'/auth.php';
