<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\RegisterController;

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

/*
| Authentication Routes
|---------------
*/
// Show login forms
Route::get('/login', [LoginController::class, 'showUserLoginForm'])->name('login');
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('login.admin');

// Handle login POST
Route::post('/login', [LoginController::class, 'userLogin'])->name('user.login.submit');
Route::post('/login/admin', [LoginController::class, 'adminLogin'])->name('admin.login.submit');

// Show register forms
Route::get('register', [RegisterController::class, 'showUserRegisterForm'])->name('register');
Route::get('register/admin', [RegisterController::class, 'showAdminRegisterForm'])->name('register.admin');

// Handle register POST
Route::post('register', [RegisterController::class, 'registerUser'])->name('register.user');
Route::post('register/admin', [RegisterController::class, 'registerAdmin'])->name('admin.register.submit');

Route::get('logout', [LoginController::class, 'logout']);




/*
| Home Routes
|---------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('showItems');




/*
| Admin Routes
|---------------
*/
Route::group(['middleware' => ['auth', 'adminAccess']], function () {
    //Items
    Route::get('/itemForm', [ItemController::class, 'create'])->name('item.createForm');
    Route::get('/itemForm/{item}', [ItemController::class, 'edit'])->name('item.editForm');
    Route::post('/itemForm', [ItemController::class, 'store'])->name('item.create');
    Route::patch('/itemForm/{item}', [ItemController::class, 'update'])->name('item.edit');

    Route::delete('/deleteItem/{item}', [ItemController::class, 'destroy'])->name('item.delete');

    //Events
    Route::get('/eventForm', [EventController::class, 'create'])->name('event.createForm');
    Route::get('/eventForm/{event}', [EventController::class, 'edit'])->name('event.editForm');
    Route::post('/eventForm', [EventController::class, 'store'])->name('event.create');
    Route::patch('/eventForm/{event}', [EventController::class, 'update'])->name('event.edit');

    Route::delete('/deleteEvent/{event}', [EventController::class, 'destroy'])->name('event.delete');
});


/*
| Cart Routes
|---------------
*/
Route::group(['middleware' => ['cart']], function () {
    // Cart
Route::post("/addItem", [CartController::class, "addItem"])->name("cartController.addItem");
Route::get("/cartList/{userId}", [CartController::class, "showCartList"])->name("cartController.showCartList");
Route::post("/updateCart", [CartController::class, "updateCart"])->name("cartController.updateCart");
Route::get("/deleteCart/{cartId}", [CartController::class, "deleteCart"])->name("cartController.deleteCart");
Route::get("/checkout", [CartController::class, "showCheckoutForm"])->name("cartController.showCheckoutForm");
Route::post("/checkout", [CartController::class, "checkout"])->name("cartController.checkout");

// Payment
Route::get("/onlineBanking", [PaymentController::class, "showOnlineBankingForm"])->name("paymentController.showOnlineBankingForm");
Route::post("/onlineBanking", [PaymentController::class, "onlineBanking"])->name("paymentController.onlineBanking");
Route::get("/creditCard", [PaymentController::class, "showCreditCardForm"])->name("paymentController.showCreditCardForm");
Route::post("/creditCard", [PaymentController::class, "creditCard"])->name("paymentController.creditCard");
Route::get("/cash", [PaymentController::class, "cash"])->name("paymentController.cash");
});


