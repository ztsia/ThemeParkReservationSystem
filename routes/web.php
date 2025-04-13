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
| Home Routes
|---------------
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





/*
| Admin Routes
|---------------
*/
//Items
Route::get('/itemForm', [ItemController::class, 'createForm'])->name('itemForm.createForm');
Route::get('/itemForm/{item}', [ItemController::class, 'editForm'])->name('itemForm.editForm');
Route::post('/itemForm', [ItemController::class, 'createItem'])->name('itemForm.createItem');
Route::patch('/itemForm/{item}', [ItemController::class, 'editItem'])->name('itemForm.editItem');

//Events
Route::get('/eventForm', [EventController::class, 'createForm'])->name('eventForm.createForm');
Route::get('/eventForm/{event}', [EventController::class, 'editForm'])->name('eventForm.editForm');
Route::post('/eventForm', [EventController::class, 'createEvent'])->name('eventForm.createEvent');
Route::patch('/eventForm/{event}', [EventController::class, 'editEvent'])->name('eventForm.editEvent');