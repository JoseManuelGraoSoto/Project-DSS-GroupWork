<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Article_userController;
use App\Http\Controllers\ValorationController;

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
    return view('access.login');
});

//Rutas users

//Getters
Route::get('user/{id}', [UsersController::class, 'show'])->name('user.show');
Route::get('users/', [UsersController::class, 'search'])->name('users');
Route::get('logged/', [UsersController::class, 'logged'])->name('logged');

//Create
Route::get('createUserForm/', [UsersController::class, 'createUserFormulary'])->name('user.createForm');
Route::post('createUser/', [UsersController::class, 'create'])->name('user.create');

//Update
Route::get('updateUserForm/', [UsersController::class, 'updateUserFormulary'])->name('user.updateForm');
Route::post('updateUser/', [UsersController::class, 'update'])->name('user.update');
Route::get('volver/', [UsersController::class, 'volver']);

//Delete
Route::get('/delete_users', [UsersController::class, 'delete_multiple']);

//Search
Route::get('searchUserForm/', [UsersController::class, 'searchUserFormulary'])->name('user.serachForm');
Route::get('comprobarUser/', [UsersController::class, 'comprobarLogin'])->name('user.comprobarLogin');
//Route::get('searchUser/', [UsersController::class, 'search'])->name('user.search');

//Rutas articles

//Getters
Route::get('article/{id}', [ArticlesController::class, 'show'])->name('article.show');
Route::get('articles/', [ArticlesController::class, 'search'])->name('articles');

//Create
Route::get('createArticleForm/', [ArticlesController::class, 'createArticleFormulary'])->name('article.createForm');
Route::post('createArticle/', [ArticlesController::class, 'create'])->name('article.create');

//Update
Route::get('updateArticleForm/', [ArticlesController::class, 'updateArticleFormulary'])->name('article.updateForm');
Route::post('updateArticle/', [ArticlesController::class, 'update'])->name('article.update');

//Delete
Route::get('/delete_articles', [ArticlesController::class, 'delete_multiple']);

//Rutas 

//Getters
Route::get('article_user/{id}', [Article_userController::class, 'show'])->name('article_user.show');
Route::get('articles_user/', [Article_userController::class, 'showAll'])->name('article_user.showAll');

//Create
Route::get('createArticle_userForm/', [Article_userController::class, 'createArticle_userFormulary'])->name('article_user.createForm');
Route::post('createArticle_user/', [Article_userController::class, 'create'])->name('article_user.create');

//Update
Route::get('updateArticle_userForm/', [Article_userController::class, 'updateArticle_userFormulary'])->name('article_user.updateForm');
Route::post('updateArticle_user/', [Article_userController::class, 'update'])->name('article_user.update');

//Rutas Reward
//Getters
Route::get('rewards/{id}', [RewardController::class, 'show'])->name('Reward.show');
Route::get('rewards/', [RewardController::class, 'showAll'])->name('rewards');
Route::get('volverReward/', [RewardController::class, 'volver']);


//Create
Route::get('createRewardForm/', [RewardController::class, 'createRewardFormulary'])->name('Reward.createForm');
Route::post('createReward/', [RewardController::class, 'create'])->name('Reward.create');

//Update
Route::get('updateRewardForm/', [RewardController::class, 'updateRewardFormulary'])->name('Reward.updateForm');
Route::post('updateReward/', [RewardController::class, 'update'])->name('Reward.update');

//Deleteg
Route::get('/delete_rewards', [RewardController::class, 'delete_multiple']);

// ValorationsggS

//Getters
Route::get('valorations/', [ValorationController::class, 'showAll'])->name('valorations');

//Create
Route::get('createValoration_Form/', [ValorationController::class, 'createValorationFormulary'])->name('valorationcreateForm');
Route::post('createValoration/', [ValorationController::class, 'create'])->name('valoration.create');

//Delete
Route::get('/delete_valorations', [ValorationController::class, 'delete_multiple']);


Route::get('/category', function () {
    return view('admin.category');
});
