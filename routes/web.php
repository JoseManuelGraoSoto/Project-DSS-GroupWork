<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Article_userController;

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

//Getters
Route::get('user/{id}', [UsersController::class, 'show'])->name('user.show');
Route::get('users/', [UsersController::class, 'showAll'])->name('user.showAll');

//Create
Route::get('createUserForm/',[UsersController::class, 'createUserFormulary'])->name('user.createForm');
Route::post('createUser/',[UsersController::class, 'create'])->name('user.create');

//Update
Route::get('updateUserForm/',[UsersController::class, 'updateUserFormulary'])->name('user.updateForm');
Route::post('updateUser/',[UsersController::class, 'update'])->name('user.update');

//Delete
Route::get('deleteUser/',[UsersController::class, 'deleteUserFormulary'])->name('user.deleteForm');
Route::post('deleteUser/{id}', [UsersController::class, 'delete'])->name('user.delete');

//Rutas articles

//Getters
Route::get('article/{id}', [ArticlesController::class, 'show'])->name('article.show');
Route::get('articles/', [ArticlesController::class, 'showAll'])->name('article.showAll');

//Create
Route::get('createArticleForm/',[ArticlesController::class, 'createArticleFormulary'])->name('article.createForm');
Route::post('createArticle/',[ArticlesController::class, 'create'])->name('article.create');

//Update
Route::get('updateArticleForm/',[ArticlesController::class, 'updateArticleFormulary'])->name('article.updateForm');
Route::post('updateArticle/',[ArticlesController::class, 'update'])->name('article.update');

//Delete
Route::get('deleteArticle/',[ArticlesController::class, 'deleteArticleFormulary'])->name('article.deleteForm');
Route::post('deleteArticle/{id}', [ArticlesController::class, 'delete'])->name('article.delete');

//Rutas 

//Getters
Route::get('article_user/{id}', [Article_userController::class, 'show'])->name('article_user.show');
Route::get('articles_user/', [Article_userController::class, 'showAll'])->name('article_user.showAll');

//Create
Route::get('createArticle_userForm/',[Article_userController::class, 'createArticle_userFormulary'])->name('article_user.createForm');
Route::post('createArticle_user/', [Article_userController::class, 'create'])->name('article_user.create');

//Update
Route::get('updateArticle_userForm/',[Article_userController::class, 'updateArticle_userFormulary'])->name('article_user.updateForm');
Route::post('updateArticle_user/',[Article_userController::class, 'update'])->name('article_user.update');

//Delete
Route::get('deleteArticle_user/',[Article_userController::class, 'deleteArticleFormulary'])->name('article_user.deleteForm');
Route::post('deleteArticle_user/{id}', [Article_userController::class, 'delete'])->name('article_user.delete');


