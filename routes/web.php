<?php

use App\Http\Controllers\CartsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\SearchController;
use App\Models\product;
Route::get('/test', function(){
    $products = product::with('carts')->get();
    dd($products);
});

Route::get('/', [SettingController::class, 'home'])->name('home');

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
    'middleware' => AdminMiddleware::class
], function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/admin/list', 'adminIndex')->name('adminIndex');
    Route::post('/admin/show', 'adminShow')->name('adminShow');
    Route::post('/edit', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
    Route::get('/list', 'index')->withoutMiddleware(AdminMiddleware::class)->name('index');
    Route::get('/relatedProducts/{category}', 'relatedProducts')->withoutMiddleware(AdminMiddleware::class)->missing(function () {
        return to_route('missing');

    })->name('relatedProducts');
    Route::get('/show' , 'show')->name('show');


    // Route::get('/show/{category}', 'show')->withoutMiddleware(AdminMiddleware::class)->missing(function () {
    //     return to_route('missing');
    // })->name('show');
    // Route::post('/showSubCategories', 'showSubCats')->withoutMiddleware(AdminMiddleware::class)->name('showSubCats');
    // Route::post('/admin/deleteAll', 'deleteAll')->name('deleteAll');
});


// product routes
Route::group([
    'prefix' => 'product',
    'controller' => ProductController::class,
    'as' => 'product.',
    'middleware' => AdminMiddleware::class
], function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/admin/list', 'adminIndex')->name('adminIndex');
    Route::post('/edit', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
    Route::get('/show/{product}', 'show')->withoutMiddleware(AdminMiddleware::class)->missing(function () {
        return to_route('missing');
    })->name('show');
    Route::get('/list', 'index')->withoutMiddleware(AdminMiddleware::class)->name('index');
    Route::post('/filterRelatedProducts', 'filter')->withoutMiddleware(AdminMiddleware::class)->name('filter');
    Route::post('/search', 'search')->withoutMiddleware(AdminMiddleware::class)->name('search');
    Route::post('/searchResult', 'searchResult')->withoutMiddleware(AdminMiddleware::class)->name('searchResult');
    // Route::get('/admin/show/{product}', 'adminShow')->missing(function () {
    //     return to_route('missing');
    // })->name('adminShow');
    // Route::post('/admin/deleteAll', 'deleteAll')->name('deleteAll');
});

Route::group([
    'prefix'=>'setting',
    'controller'=>SettingController::class,
    'middleware'=>[AdminMiddleware::class],
    'as'=>'setting.'

], function(){
    Route::get('/headerSettings', 'headerSettings')->name('headerSettings');
    Route::post('/storeHeaderSetting', 'storeHeaderSetting')->name('storeHeaderSetting');
    Route::get('/bannerSettings', 'bannerSettings')->name('bannerSettings');
    Route::post('/storeBanners', 'storeBanners')->name('storeBanners');
    Route::get('/cardSettings', 'cardSettings')->name('cardSettings');
    Route::post('/cardStore', 'cardStore')->name('cardStore');
    Route::get('/serviceSettings', 'serviceSettings')->name('serviceSettings');
    Route::post('/serviceStore', 'serviceStore')->name('serviceStore');
    Route::get('/footerSettings', 'footerSettings')->name('footerSettings');
    Route::post('/footerStore', 'footerStore')->name('footerStore');
});

Route::group([
    'prefix'=>'search',
    'controller'=>SearchController::class,
    'as'=>'search.'
], function(){
    // Route::post('/', 'search')->name('search');
    Route::post('/', 'page')->name('page');
});

Route::group([
    'prefix'=>'cart',
    'controller'=>CartsController::class,
    'as'=>'cart.'
], function(){
    Route::get('/', 'list')->name('list');
});

// aboutUs
Route::group([
    'prefix' => 'aboutUs',
    'controller' => AboutUsController::class,
    'as' => 'aboutUs.',
    'middleware' => [AuthMiddleware::class]
], function () {
    Route::get('/create_edit/{aboutUs?}', 'create_edit')->name('create_edit');
    Route::post('/updateOrcreate', 'updateOrcreate')->name('updateOrcreate');
    Route::get('/aboutUs', 'index')->name('list');
    Route::get('/delete/{aboutUs}', 'delete')->name('delete');
    Route::get('/clientList', 'clientList')->name('clientList')->withoutMiddleware([AuthMiddleware::class]);
});

///contactUs
Route::group([
    'prefix' => 'contactUs',
    'controller' => contactUsController::class,
    'as' => 'contactUs.',
    'middleware' => [AuthMiddleware::class]
], function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/myMessage', 'myMessage')->name('myMessage');
    Route::get('/contactUs', 'index')->name('list');
    Route::get('/single/{contactUs}', 'single')->name('single');
    Route::get('/clientSingle/{contactUs}', 'clientSingle')->name('show');
    Route::get('/edit/{contactUs}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::get('/delete/{contactUs}', 'delete')->name('delete');
    Route::post('/deleteAll', 'deleteAll')->name('deleteAll');
});