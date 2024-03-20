<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{LoginController,CategoryController,TaskController,DashboardController};

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
    return view('welcome');
})->name('login');

Route::post('login',[LoginController::class,'login_store'])->name('login-submit');
Route::post('register',[LoginController::class,'register_store'])->name('register-submit');

Route::view('register','register')->name('register');

Route::group(['prefix'=>'user','middleware'=>['auth_check']],function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('logout',[DashboardController::class,'logout'])->name('logout');
    Route::resource('category',CategoryController::class);
    Route::get('tast-restore',[TaskController::class,'restore'])->name('task.restore');
    Route::get('tast-restore-data/{id}',[TaskController::class,'restore_data'])->name('task.restore_data');
    Route::resource('task',TaskController::class);
});
