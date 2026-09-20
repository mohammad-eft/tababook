<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AuthMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'home')->name('home');


Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/signup', [UserController::class, "create"])->name('signup');
Route::post('/check', [UserController::class, "checkAuth"])->name('checkAuth');

Route::group([
    'prefix' => 'users',
    'controller' => UserController::class,
    'as' => 'user.',
    'middleware' => [AuthMiddleware::class]
], function () {
    Route::post("/store", "store")->name('store')->withoutMiddleware([AuthMiddleware::class]);
    Route::post("/check", "check")->name('check')->withoutMiddleware([AuthMiddleware::class]);
    Route::get("/logout", "logout")->name('logout');
    Route::get("/", "index")->name('list');
    Route::get("/panel/{user}", "panel")->name('panel');
    Route::get('/profile/{user?}', 'profile')->name('profile');
    Route::get('/show/{user}', 'show')->name('show');
    Route::get("/edit/{user}", "edit")->name('edit');
    Route::post("/update", "update")->name('update');
    Route::get("/delete/{user}", "delete")->name('delete');
    Route::get('/compelete', 'compelete_form')->name('compelete_form');
    Route::post('/save', 'save')->name('save');
    Route::get('/setting', 'setting')->name('setting');
    Route::post('/set', 'set')->name('set');
    route::post('/set_order', 'set_order')->name('set_order');
    Route::get('/create_user', 'create_user')->name('create_user');
    Route::post('/store_user', 'store_user')->name('store_user');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

// category routes
Route::group([
    'prefix' => 'category',
    'controller' => CategoryController::class,
    'as' => 'category.',
    'middleware' => AuthMiddleware::class
], function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/admin/list', 'adminIndex')->name('adminIndex');
    Route::post('/admin/show', 'adminShow')->name('adminShow');
    Route::post('/edit/', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
    Route::get('/list', 'index')->withoutMiddleware(AuthMiddleware::class)->name('index');
    Route::get('/relatedProducts/{category}', 'relatedProducts')->withoutMiddleware(AuthMiddleware::class)->missing(function () {
        return to_route('missing');
    })->name('relatedProducts');


    // Route::get('/show/{category}', 'show')->withoutMiddleware(AuthMiddleware::class)->missing(function () {
    //     return to_route('missing');
    // })->name('show');
    // Route::post('/showSubCategories', 'showSubCats')->withoutMiddleware(AuthMiddleware::class)->name('showSubCats');
    // Route::post('/admin/deleteAll', 'deleteAll')->name('deleteAll');
});


// product routes
Route::group([
    'prefix' => 'product',
    'controller' => ProductController::class,
    'as' => 'product.',
    'middleware' => AuthMiddleware::class
], function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/admin/list', 'adminIndex')->name('adminIndex');
    Route::post('/edit/', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
    Route::get('/show/{product}', 'show')->withoutMiddleware(AuthMiddleware::class)->missing(function () {
        return to_route('missing');
    })->name('show');
    Route::get('/list', 'index')->withoutMiddleware(AuthMiddleware::class)->name('index');
    Route::post('/filterRelatedProducts', 'filter')->withoutMiddleware(AuthMiddleware::class)->name('filter');
    Route::post('/search', 'search')->withoutMiddleware(AuthMiddleware::class)->name('search');
    Route::post('/searchResult', 'searchResult')->withoutMiddleware(AuthMiddleware::class)->name('searchResult');
    // Route::get('/admin/show/{product}', 'adminShow')->missing(function () {
    //     return to_route('missing');
    // })->name('adminShow');
    // Route::post('/admin/deleteAll', 'deleteAll')->name('deleteAll');
});
