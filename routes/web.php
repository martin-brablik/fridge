<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

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

Route::get('/', [ItemController::class, "list"]);

Route::get('/add', [ItemController::class, 'index']);

Route::get('/edit/{item}', [ItemController::class, 'edit'])->name('item.edit');

Route::post('/add_submit', [ItemController::class, 'add_item']);

Route::post('edit_submit/{item}', [ItemController::class, 'edit_item']);

Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('item.destroy');
