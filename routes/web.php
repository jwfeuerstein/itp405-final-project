<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LineupController;
use App\Http\Controllers\AuthController;
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



if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}

Route::get('/', [LineupController::class, 'index'])->name('lineups.index');
Route::get('/lineups', [LineupController::class, 'index']);
Route::get('/lineups/show/{id}', [LineupController::class, 'show'])->name('lineups.show');

Route::get('/lineups/create', [LineupController::class, 'create'])->name('lineups.create');
Route::post('/lineups/create', [LineupController::class, 'store'])->name('lineups.store');

Route::post('/lineups/delete/{id}', [LineupController::class, 'delete'])->name('lineups.delete');

Route::get('/lineups/edit/{id}', [LineupController::class, 'edit'])->name('lineups.edit');
Route::post('/lineups/edit/{id}', [LineupController::class, 'save'])->name('lineups.save');

Route::post('/comment/{id}', [LineupController::class, 'comment'])->name('lineups.comment');

Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.registerForm');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/about', function () {
    return view('about');
})->name('about');
