<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get("/itemList", [ItemController::class, "showItemList"])->name("itemController.showItemList");
Route::get("/addItemForm/{cartId}", [CartController::class, "addItemForm"])->name("cartController.addItemForm");

// only users who have login can access
Route::group(['middleware' => 'auth'], function () {
    Route::post("/addItem", [CartController::class, "addItem"])->name("cartController.addItem");
    Route::get("/cartList/{userId}", [CartController::class, "showCartList"])->name("cartController.showCartList");
    Route::post("/updateCart", [CartController::class, "updateCart"])->name("cartController.updateCart");
    Route::get("/deleteCart/{cartId}", [CartController::class, "deleteCart"])->name("cartController.deleteCart");
    Route::get("/checkout/{userId}", [CartController::class, "showCheckoutForm"])->name("cartController.showCheckoutForm");
    Route::post("/checkout", [CartController::class, "checkout"])->name("cartController.checkout");
    Route::get("/onlineBanking", [PaymentController::class, "showOnlineBankingForm"])->name("paymentController.showOnlineBankingForm");
    Route::post("/onlineBanking", [PaymentController::class, "onlineBanking"])->name("paymentController.onlineBanking");
    Route::get("/showCreditCardForm", [PaymentController::class, "showCreditCardForm"])->name("paymentController.showCreditCardForm");
    Route::post("/creditCard", [PaymentController::class, "creditCard"])->name("paymentController.creditCard");
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('logout', [LoginController::class, 'logout']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
