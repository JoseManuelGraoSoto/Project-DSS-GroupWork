<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\User;

class RewardController extends Controller
{
    //Devuelve la vista articleInfo pasándole como parámetro el articulo con el id requerido en la url
    public function show($id) {
        $reward = Reward::find($id);
        return view('rewardInfo', ['reward' => $reward]);
    }

    //Devuelve la vista articlesList pasándole como parámetro todos los articulos
    public function showAll(){
        $rewards = Reward::all();
        return view('rewardList', ['reward' => $rewards]);
    }

    //Devuelve el formulario de creación de Reward
    public function createRewardFormulary(){
        return view('createReward');
    }

    //Recibe la información de un Reward y lo añade a la base de datos
    public function create(Request $request){
        $user = User::find($request->input('user_id'));
        $new_reward = new Reward;
        $new_reward->points = $request->input('points');
        $new_reward->month = $request->input('month');
        $new_reward->isModerator = $request->input('isModerator');
        $new_reward->save();
        return view('rewardCreado');
    }

    //Devuelve el formulario de actualización de Article
    public function updateRewardFormulary(){
        return view('updateReward');
    }

    //Recibe la información de un reward y lo modifica en la base de datos
    public function update(Request $request){
        $user_Reward = User::find($request->input('user_id'));
        $user_Reward->points = $request->input('points');
        $user_Reward->month = $request->input('month');
        $user_Reward->isModerator = $request->input('isModerator');
        $user_Reward->save();
        return 'Reward actualizado';
    }

    //Devuelve el formulario de borrado de Reward pasándole como parámetro los reward
    public function deleteRewardFormulary(){
        $rewards = Reward::all();
        return view('deleteRewards', ['reward' => $rewards]);
    }

    //Recibe un id de usuario y borra la reward
    public function delete(Request $request){
        $reward = User::find($request->input('user_id'));
        $fecha = $reward->Fecha;
        $reward->delete();
        return $fecha . ' borrado';
    }
}
