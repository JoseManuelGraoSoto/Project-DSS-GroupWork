<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RewardController;

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
    return view('admin.init');
});

//Rutas rewards

//Getters
Route::get('reward/', [RewardController::class, 'showAll'])->name('reward.showAll');

//Create
Route::get('createRewardForm/', [RewardController::class, 'createRewardFormulary'])->name('reward.createForm');
Route::post('createReward/', [RewardController::class, 'create'])->name('reward.create');

//Update
Route::get('updateRewardForm/', [RewardController::class, 'updateRewardFormulary'])->name('reward.updateForm');
Route::post('updateReward/', [RewardController::class, 'update'])->name('reward.update');

//Delete
Route::get('deleteReward/', [RewardController::class, 'deleteRewardFormulary'])->name('reward.deleteForm');
Route::post('deleteReward/{id}', [RewardController::class, 'delete'])->name('reward.delete');
