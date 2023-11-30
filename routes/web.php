<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;

use App\Models\Food;

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

    $data = food::all();
    return view('welcome',compact("data"));
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

Route::get('/home',[HomeController::class,"index"]);

Route::get('/redirect',[HomeController::class,"redirect"]);

Route::get('/food_menu',[AdminController::class,"food_menu"]);

Route::post('/uploadfood',[AdminController::class,"upload"]);

Route::post('/order_food',[AdminController::class,"order"]);

Route::get('/food_table',[AdminController::class,"food_table"]);

Route::get('/update_menu/{id}',[AdminController::class,"update_menu"]);

Route::get('/food_table/{id}',[AdminController::class,"delete_order"]);

Route::post('/save_menu/{id}',[AdminController::class,"save_menu"]);

Route::get('/adminhome/{id}',[AdminController::class,"clear_order"]);

Route::post('/feedback',[AdminController::class,"feedback"]);

Route::get('/view_feedback',[AdminController::class,"view_feedback"]);


