<?php

use Chicorycom\Cigaformation\Http\Controllers\Auth\LoginController;
use Chicorycom\Cigaformation\Http\Controllers\Auth\RegisterController;
use Chicorycom\Cigaformation\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => ['web']], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('store.register');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/espace-etudiants', [HomeController::class, 'students'])->middleware('auth:student');
    Route::get('/espace-etudiants/{view}', [HomeController::class, 'content'])->middleware('auth:student');;
    Route::post('/pre-register', [HomeController::class, 'preRegister']);
    Route::get('/{view}', [HomeController::class, 'index'])->name('page');
    Route::get('/{view}/{slug}', [HomeController::class, 'detail'])->name('details');
});



