<?php

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
//include DatabaseStorageController
use App\Http\Controllers\DatabaseStorageController;
// index route
Route::get('/', function () {
//DatabaseStorageController index function
    return (new DatabaseStorageController)->index();
});
//Home route
Route::get('/home', function () {
    return (new DatabaseStorageController)->index();
});
//DatabaseStorage routes
Route::resource('database_storage', 'App\Http\Controllers\DatabaseStorageController')
        ->only(['index', 'store', 'create','destroy','update','edit','show']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
