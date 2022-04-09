<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\User;

class RewardController extends Controller {
    //Devuelve la vista rewardProfile pasándole como parámetro el reward con el id requerido en la url
    public function show($id) {
        $reward = Reward::where('points', $id)-> first();
        return view('rewardProfile', ['reward' => $reward]);
    }

    //Devuelve la vista rewardsProfile pasándole como parámetro todos los rewards
    public function showAll(){
        $rewards = Reward::all();
        return view('admin.reward', ['rewards' => $rewards]);
    }

    //Devuelve el formulario de creación de Reward
    public function createRewardFormulary(){
        return view('createReward');
    }

  //Recibe la información de un reward y lo añade a la base de datos
    public function create(Request $request){
        $new_reward = new Reward;
        $new_reward->points = $request->input('points');
        $new_reward->month = $request->input('month');
        $new_reward->isModerator = $request->input('isModerator');
        $new_reward->save();
        return view('rewardCreado');
    }

    //Devuelve el formulario de actualización de reward
    public function updateRewardFormulary(){
        return view('updateReward');
    }

    //Recibe la información de un reward y lo modifica en la base de datos
    public function update(Request $request){
        $reward = Reward::find($request->input('reward_id'));
        $reward->points = $request->input('points');
        $reward->month = $request->input('month');
        $reward->isModerator = $request->input('isModerator');
        $reward->user_id = $request->input('user_id');
        $reward->telephone = $request->input('telephone');
        $reward->save();
        return 'Usuario actualizado';
    }

    //Devuelve el formulario de borrado de Reward pasándole como parámetro los rewards
    public function deleteRewardFormulary(){
        $rewards = Reward::all();
        return view('deleteReward', ['rewards' => $rewards]);
    }

    //Recibe un id de reward y borra el reward
    public function delete($id){
        $reward = Reward::find($id);
        $points = $reward->points;
        $reward->delete();
        return $points . ' borrado';
    }

}