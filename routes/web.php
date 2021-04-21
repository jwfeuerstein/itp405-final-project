<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LineupController;
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
Route::get('/lineups/{id}', [LineupController::class, 'show'])->name('lineups.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/db', function () {
    DB::table('players')->insert([
        'name' => "Brandon Ingram",
    ]);
});
