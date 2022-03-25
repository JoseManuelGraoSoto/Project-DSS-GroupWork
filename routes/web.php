<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticlesController;
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

Route::get('/', function () {
    return view('welcome');
});

//Rutas users
Route::get('user/{id}', [UsersController::class, 'show'])->name('user.show');
Route::get('users/', [UsersController::class, 'showAll'])->name('user.showAll');
Route::delete('deleteUser/{id}', [UsersController::class, 'delete'])->name('user.delete');


//Rutas articles
Route::get('article/{id}', [ArticlesController::class, 'show'])->name('article.show');
Route::get('articles/', [ArticlesController::class, 'showAll'])->name('article.showAll');



