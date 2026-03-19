<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 24/09/20
 * Time: 12:00
 */


use Chicorycom\Cigaformation\Http\Controllers\Admin\AppController;
use Chicorycom\Cigaformation\Http\Controllers\Admin\CategoryController;
use Chicorycom\Cigaformation\Http\Controllers\Admin\EventController;
use Chicorycom\Cigaformation\Http\Controllers\Admin\FormationController;
use Chicorycom\Cigaformation\Http\Controllers\Admin\PageController;
use Chicorycom\Cigaformation\Models\Menu;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Chicorycom\Cigaformation\Http\Controllers\Admin\LoginController;
use Chicorycom\Cigaformation\Http\Controllers\Admin\UserController;
use Chicorycom\Cigaformation\Http\Controllers\Admin\MenusController;

Route::group(['middleware' => 'chicorycomguest:api'], function () {
    //Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::get('menus-admin', [MenusController::class, 'index']);
Route::get('menus-public', [MenusController::class, 'publicMenus']);

Route::middleware('auth:api')->group(function(){
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('menus-store', [MenusController::class, 'store']);
    Route::delete('menus-delete/{menu}', [MenusController::class, 'destroy']);

    //User Route
    Route::get('user', [UserController::class, 'user']);
    Route::get('user/{user}/edit', [UserController::class, 'edit']);
    Route::put('user/{user}', [UserController::class, 'update']);
    Route::post('user', [UserController::class, 'store']);
    Route::delete('user/{user}', [UserController::class, 'destroy']);
    Route::post('roles', [AppController::class, 'roles']);
    Route::get('users-fetch', [UserController::class, 'users']);


    Route::get('slide-carousel', [AppController::class, 'carousel']);
    Route::post('slide-carousel', [AppController::class, 'storeCarousel']);
    Route::put('slide-carousel/{slide}', [AppController::class, 'updateCarousel']);
    Route::put('slide-carousel-status/{id}', [AppController::class, 'statusCarousel']);
    Route::delete('slide-carousel/{slide}', [AppController::class, 'deleteCarousel']);
    Route::get('slide-carousel/{slide}/edit', [AppController::class, 'editCarousel']);

    Route::get('formation-type', [FormationController::class, 'type']);
    Route::get('formation-data', [FormationController::class, 'index']);
    Route::get('formation-data/{formation}/edit', [FormationController::class, 'edit']);
    Route::post('formation-data', [FormationController::class, 'store']);
    Route::put('formation-data/{formation}', [FormationController::class, 'update']);
    Route::delete('formation-data/{formation}', [FormationController::class, 'destroy']);

    Route::get('event-data', [EventController::class, 'index']);
    Route::get('event-data/{event}/edit', [EventController::class, 'edit']);
    Route::post('event-store', [EventController::class, 'store']);
    Route::put('event-update/{event}', [EventController::class, 'update']);
    Route::delete('event-delete/{event}', [EventController::class, 'destroy']);

    Route::get('page-data', [PageController::class, 'index']);
    Route::get('page-data/{page}/edit', [PageController::class, 'edit']);
    Route::post('page-store', [PageController::class, 'store']);
    Route::put('page-update/{page}', [PageController::class, 'update']);
    Route::delete('page-delete/{page}', [PageController::class, 'destroy']);

    Route::get('countdown-data/{countdown}', [AppController::class, 'countdown']);
    //Route::get('page-data/{page}/edit', [PageController::class, 'edit']);
    Route::post('countdown-store', [AppController::class, 'countdownStore']);
    Route::post('countdown-status', [AppController::class, 'countdownStatus']);

    Route::get('category-data', [CategoryController::class, 'index']);
    Route::get('category-data/{category}/edit', [CategoryController::class, 'edit']);
    Route::post('category-data', [CategoryController::class, 'store']);
    Route::put('category-data/{category}', [CategoryController::class, 'update']);
    Route::delete('category-delete/{category}', [CategoryController::class, 'destroy']);
});


$base = public_path(  '/assets/js/app.js');
Route::get('', function () use($base) {
    $appjs = File::get($base);
    $menus = Menu::admin();
    return view('chicorycom::admin/index', compact('appjs', 'menus'));
});
Route::get('{path}', function ($path) use($base) {
    $appjs = File::get($base);
    $menus = Menu::admin();
    return view('chicorycom::admin/index', compact('appjs', 'menus'));
})->where('path', '(.*)');

