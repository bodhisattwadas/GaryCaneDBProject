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
    return view('welcome');
});
//Home route
Route::get('/home', function () {
    return (new DatabaseStorageController)->index();
})->middleware('auth');
//DatabaseStorage routes
Route::resource('database_storage', 'App\Http\Controllers\DatabaseStorageController')
        ->only(['index', 'store', 'create','destroy','update','edit','show'])->middleware('auth');
Route::resource('backup_controller', 'App\Http\Controllers\BackupController')->middleware('auth');
//test_connection route
Route::post('/backup_controller/test_connection', 'App\Http\Controllers\BackupController@test_connection')->name('test_connection')->middleware('auth');
//backup_controller.backup_now route
Route::post('/backup_controller/backup_now', 'App\Http\Controllers\BackupController@backup_now')->name('backup_now')->middleware('auth');
//  Route::get('/cronBackup', 'App\Http\Controllers\BackupController@_cronBackup')->name('cronBackup');
//backup_history
Route::get('/backup_history/{database_id}', 'App\Http\Controllers\BackupController@backup_history')->name('backup_history')->middleware('auth');
//backup_history_all
Route::get('/backup_history_all', 'App\Http\Controllers\BackupController@backup_history_all')->name('backup_history_all')->middleware('auth');
//download_backup
Route::get('/download_backup/{backup_id}', 'App\Http\Controllers\BackupController@download_backup')->name('download_backup')->middleware('auth');

//Profile routes
Route::resource('profile', 'App\Http\Controllers\ProfileController')->only(['index', 'update'])->middleware('auth');


Auth::routes();
//bLOCK REGISTER ROUTE
// Route::get('/register', function () {
//     return redirect('/login');
// });
Auth::routes([
    'register' => true, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);
//register false

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


