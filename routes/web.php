<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EventController;

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
| Authentication Routes (Login, Register, Password Reset)
|---------------
*/






/*
| Home Routes
|---------------
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





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

    //Events
    Route::get('/eventForm', [EventController::class, 'create'])->name('event.createForm');
    Route::get('/eventForm/{event}', [EventController::class, 'edit'])->name('event.editForm');
    Route::post('/eventForm', [EventController::class, 'store'])->name('event.create');
    Route::patch('/eventForm/{event}', [EventController::class, 'update'])->name('event.edit');
});
