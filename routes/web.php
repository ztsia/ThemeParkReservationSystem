<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
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

Route::get("/deleteCart/{cartId}", [CartController::class, "deleteCart"])->name("cartcontroller.deleteCart");

Route::post("/updateCart", [CartController::class, "updateCart"])->name("cartcontroller.updateCart");

Route::get("/showCartList/{userId}", [CartController::class, "showCartList"])->name("cartcontroller.showCartList");

Route::get("/showItemList", [ItemController::class, "showItemList"])->name("itemcontroller.showItemList");

Route::post("/addItem", [CartController::class, "addItem"])->name("cartcontroller.addItem");

Route::get("/addItemForm/{cartId}", [CartController::class, "addItemForm"])->name("cartcontroller.addItemForm");

// Route::get('/', function () {
//     return view('welcome');
// });
