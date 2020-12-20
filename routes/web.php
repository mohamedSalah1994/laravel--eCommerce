<?php

use App\Http\Controllers\backEnd\favouritesController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backEnd\usersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backEnd\DashboardController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\ReviewController;

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



Route::get('/home', [HomeController::class, 'index']);


Route::get('favourit',[favouritesController::class,'index'])->name('user.fav');
Route::Post('favourit/{id}',[favouritesController::class,'store'])->name('fav.add');
Route::delete('product/{id}',[favouritesController::class,'destroy'])->name('fav.delete');



Route::get('product/{id}',[ProductDetailsController::class,'show'])->name('product.details');


// Route::get('revieww/{id}',[ReviewController::class,'index']);
Route::post('review/{id}',[ReviewController::class,'store'])->name('add.review');
Route::post('review/{review}',[ReviewController::class,'destroy'])->name('delete.review');


// Route::get('admin/home', function () {
//    return view('backEnd.layouts.index');
//});

// });
// Route::namespace('backEnd')->prefix('admin')->group(function (){
//         Route::get('',[homeController::class,'index'] );
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::Post('product/{id}',[favouritesController::class,'store'])->name('product.fav');
########################################  users#####################################
// Route::resource('users',[usersController::class,'index']);

Route::group(['middleware' => 'auth'], function () {


Route::get('admin/home', [homeController::class, 'index']);


    Route::group(["middleware" => 'chechAdmin'], function () {


    });
});
Route::get('notfound', function () {
    return view('notfound');
})->name('notfound');

Route::resource('admin/users', usersController::class);


////////////////////////////////////////////--Start Category--//////////////////////////////////////////
use App\Http\Controllers\backEnd\CategoriesController;

Route::prefix('admin')->group(function (){
//    Route::resources(['users' => usersController::class]);
    Route::get('home',[DashboardController::class,'index'])->name('admin');
    Route::get('category/create',[CategoriesController::class,'create'] );
    Route::post('category/create',[CategoriesController::class,'store'] );
    Route::get('category',[CategoriesController::class,'index'] );
    Route::get('category/{id}',[CategoriesController::class,'show'] );
    Route::get('category/{id}/edit',[CategoriesController::class,'edit'] );
    Route::post('category/{id}',[CategoriesController::class,'update'] );
    Route::get('category/{id}/delete',[CategoriesController::class,'destroy'] );

});
////////////////////////////////////////////--End Category--//////////////////////////////////////////

////////////////////////////////////////////--Start product--//////////////////////////////////////////
use App\Http\Controllers\backEnd\ProductsController;
Route::namespace('backEnd')->prefix('admin')->group(function (){
    Route::get('product/create',[ProductsController::class,'create'] )->middleware('checkCategory');
    Route::post('product/create',[ProductsController::class,'store'] );
    Route::get('product',[ProductsController::class,'index'] );
    Route::get('product/{id}',[ProductsController::class,'show'] );
    Route::get('product/{id}/edit',[ProductsController::class,'edit'] );
    Route::post('product/{id}',[ProductsController::class,'update'] );
    Route::get('product/{id}/delete',[ProductsController::class,'destroy'] );
    Route::get('trashed',[ProductsController::class,'trashed'] );
    Route::get('trashed/{id}',[ProductsController::class,'restore'] );
});
////////////////////////////////////////////--Start product--//////////////////////////////////////////



