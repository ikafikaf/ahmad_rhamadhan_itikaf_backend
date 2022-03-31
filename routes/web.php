<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/article/{articleId}', [App\Http\Controllers\HomeController::class, 'readArticle'])->name('read');
Route::get('/add', [App\Http\Controllers\HomeController::class, 'addArticle'])->name('add');
Route::get('/edit/{articleId}', [App\Http\Controllers\HomeController::class, 'editArticle'])->name('edit');
