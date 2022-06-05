<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimalsController;
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

Route::get('/api/check_life_animal', [AnimalsController::class, 'check_life_animal']);
Route::get('/api/animal_kinds', [AnimalsController::class, 'get_all_animals']);
Route::post('/api/create_animal', [AnimalsController::class, 'create_animal']);
Route::post('/api/save_status', [AnimalsController::class, 'save_status']);
Route::get('/', function () {
    return view('index');
});


Auth::routes();

