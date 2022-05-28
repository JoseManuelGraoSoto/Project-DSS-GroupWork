<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Article_userController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ValorationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SingleArticleController;
use App\Http\Controllers\TransactionUsersController;

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

// Test
Route::get('/test', function () {
    return view('common.add.article');
});

Auth::routes();

// Home Controller
Route::get('/', [HomeController::class, 'loadContent'])->name('home');

// Ruta articulo
Route::get('/article/{id}', [SingleArticleController::class, 'getArticle'])->name('article');

Route::middleware('auth')->group(function () {
    // Crear valoración
    Route::post('/article/{id}/createValoration', [SingleArticleController::class, 'createValoration'])->name('article.valoration.create');

    // Actualizar valoración
    Route::post('/article/{id}/updateValoration', [SingleArticleController::class, 'updateValoration'])->name('article.valoration.update');

    // Ruta aceptar articulo
    Route::post('/article/{id}/accept', [SingleArticleController::class, 'acceptArticle'])->name('article.acept')->middleware('is_moderator');

    // Ruta biblioteca
    Route::get('/library', [LibraryController::class, 'search'])->name('library');

    // Ruta perfil
    Route::get('/profile', [ProfileController::class, 'updateProfileFormulary'])->name('profile');
    Route::post('/profileUpdate', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    /**************** RUTAS ADMIN ***************/
    Route::middleware('is_admin')->group(function () {
        //Rutas users
        //Getters
        Route::get('/admin', function () {
            return view('admin.init');
        })->name('adminHome');

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
        //Create
        Route::get('/valorations/addForm', [ValorationController::class, 'createValorationFormulary'])->name('valoration.createForm');
        Route::post('/valorations/add', [ValorationController::class, 'create'])->name('valoration.create');

        //Update
        Route::get('/valorations/updateForm', [ValorationController::class, 'updateValorationFormulary'])->name('valoration.updateForm');
        Route::post('/valorations/update', [ValorationController::class, 'update'])->name('valoration.update');
        Route::get('/volverValoration', [ValorationController::class, 'volver']);

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
        Route::get('/category', [CategoryController::class, 'search'])->name('category');
        Route::get('/category/add', [CategoryController::class, 'create'])->name('category.create');

        Route::get('/transaction', [TransactionUsersController::class, 'search'])->name('transaction');
    });
});

// Rutas suscripcion
Route::get('/subscrip', function () {
    return view('client.subscrip');
})->name('suscripcion');

//Rutas plataforma de Pago, la segunda hay que modificarla en el controlador y mostrarla como un pop up y actualizar la base de datos
Route::get('/paypal/pay', [PaymentController::class, 'payWithPayPal'])->name('pay');
Route::get('/paypal/status', [PaymentController::class, 'paypalStatus'])->name('status');
