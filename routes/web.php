<?php

use App\Http\Middleware\IsUser;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::get('/redirect',[HomeController::class,'redirect']);

Route::controller(ProductController::class)->group(function(){



    Route::middleware(IsAdmin::class)->group(function(){


            // allproduct
            Route::get("products","allProducts");

            //show
            Route::get("product/show/{id}","show");


            //create
            Route::get("products/create","create");
            Route::post("products","store")->name('store');


            //edit
            Route::get('products/edit/{id}','edit');
            Route::put('products/{id}','update');

            //delete

            Route::delete('products/{id}','delete');
        });
    });


Route::get('change/{lang}',[LangController::class,'changeLang']);

Route::controller(UserController::class)->group(function() {
    Route::get("","allProductsgest");
    Route::get("redirect","allProducts");
    Route::get("Product/{id}","show");
    Route::get("mycart","mycart");
    Route::get('search','search');
    Route::post('addToCart/{id}','addToCart');
    Route::post('makeOrder','makeOrder');
    });

