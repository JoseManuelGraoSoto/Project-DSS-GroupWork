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

Auth::routes();

// Home Controller
Route::get('/', function () {
    return view('welcome.landingpage');
})->name('home');

// Ruta articulo
Route::get('/article/{id}', function () {
    return view('common.article');
})->name('article');

Route::middleware('auth')->group(function () {
    // Ruta biblioteca
    Route::get('/library', function () {
        return view('common.library');
    })->name('library');

    // Ruta perfil
    Route::get('/profile', [UsersController::class, 'updateProfileFormulary'])->name('profile');
    Route::post('/profileUpdate', [UsersController::class, 'updateProfile'])->name('updateProfile');

    /**************** RUTAS ADMIN ***************/

    //Rutas users
    //Getters
    Route::get('/users', [UsersController::class, 'search'])->name('users');

    //Create
    Route::get('/users/addForm', [UsersController::class, 'createUserFormulary'])->name('user.createForm');
    Route::post('/users/add', [UsersController::class, 'create'])->name('user.create');

    //Update
    Route::get('/users/updateForm', [UsersController::class, 'updateUserFormulary'])->name('user.updateForm');
    Route::post('/users/update', [UsersController::class, 'update'])->name('user.update');
    Route::get('/volver', [UsersController::class, 'volver']);

    //Delete
    Route::get('/users/delete', [UsersController::class, 'delete']);

    //Search
    Route::get('/searchUserForm', [UsersController::class, 'searchUserFormulary'])->name('user.serachForm');
    Route::get('/comprobarUser', [UsersController::class, 'comprobarLogin'])->name('user.comprobarLogin');


    //Rutas articles
    //Getters
    Route::get('articles/', [ArticlesController::class, 'search'])->name('articles');

    //Create
    Route::get('/articles/addForm', [ArticlesController::class, 'createArticleFormulary'])->name('article.createForm');
    Route::post('/articles/add', [ArticlesController::class, 'create'])->name('article.create');

    //Update
    Route::get('/articles/updateForm', [ArticlesController::class, 'updateArticleFormulary'])->name('article.updateForm');
    Route::post('/articles/update', [ArticlesController::class, 'update'])->name('article.update');
    Route::get('/volverArticle', [ArticlesController::class, 'volver']);

    //Delete
    Route::get('/articles/delete', [ArticlesController::class, 'delete']);


    //Rutas accesos
    //Getters
    Route::get('/access', [Article_userController::class, 'search'])->name('access');

    //Create
    Route::get('/access/addForm', [Article_userController::class, 'createArticle_userFormulary'])->name('access.createForm');
    Route::post('/access/add', [Article_userController::class, 'create'])->name('access.create');

    //Update
    Route::get('/access/updateForm', [Article_userController::class, 'updateArticle_userFormulary'])->name('access.updateForm');
    Route::post('/access/update', [Article_userController::class, 'update'])->name('access.update');

    //Delete
    Route::get('/access/delete', [Article_userController::class, 'delete']);


    // Rutas Valorations
    //Getters
    Route::get('/valorations', [ValorationController::class, 'search'])->name('valorations');

    //Create: implementado en prácticas posteriores
    // Route::get('createValorationForm/', [ValorationController::class, 'createValorationFormulary'])->name('valorationcreateForm');
    // Route::post('createValoration/', [ValorationController::class, 'create'])->name('valoration.create');

    //Delete
    Route::get('/valorations/delete', [ValorationController::class, 'delete']);


    //Rutas Reward
    //Getters
    Route::get('rewards/', [RewardController::class, 'search'])->name('rewards');

    //Create
    Route::get('/rewards/addForm', [RewardController::class, 'createRewardFormulary'])->name('reward.createForm');
    Route::post('/rewards/add', [RewardController::class, 'create'])->name('reward.create');

    //Update
    Route::get('/rewards/updateForm', [RewardController::class, 'updateRewardFormulary'])->name('reward.updateForm');
    Route::post('/rewards/update', [RewardController::class, 'update'])->name('reward.update');
    Route::get('/volverReward', [RewardController::class, 'volver']);

    //Delete
    Route::get('/rewards/delete', [RewardController::class, 'delete']);


    // Rutas category
    Route::get('/category', function () {
        return view('admin.category');
    })->name('category');
});
