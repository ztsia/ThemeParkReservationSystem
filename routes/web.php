<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
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

Route::get("/showItemList", [ItemController::class, "showItemList"])->name("itemcontroller.showItemList");

Route::post("/addItem", [ItemController::class, "addItem"])->name("itemcontroller.addItem");

Route::get("/addItemForm/{id}", [ItemController::class, "addItemForm"])->name("item.addItemForm");

// Route::get('/', function () {
//     return view('welcome');
// });
