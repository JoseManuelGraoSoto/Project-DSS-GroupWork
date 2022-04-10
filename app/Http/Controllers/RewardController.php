<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class RewardController extends Controller
{
    //Devuelve la vista rewardProfile pasándole como parámetro el reward con el id requerido en la url
    public function show($id)
    {
        $reward = Reward::where('points', $id)->first();
        return view('rewardProfile', ['reward' => $reward]);
    }

    //Devuelve la vista rewardsProfile pasándole como parámetro todos los rewards
    public function showAll()
    {
        $rewards = Reward::paginate(7);
        return view('admin.reward', ['rewards' => $rewards]);
        // $rewards = Reward::all();
        // return view('admin.reward', ['rewards' => $rewards]);
    }

    //Devuelve el formulario de creación de Reward
    public function createRewardFormulary()
    {
        return view('admin.add.createReward');
    }

    //Recibe la información de un reward y lo añade a la base de datos
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'quantity' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect('createRewardForm')
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = $validator->validated();
        $new_reward = new Reward;
        $new_reward->points = $inputs['quantity'];
        // La fecha debería ser la actual
        $month = date('m');
        $fecha = '2022-' . $month . '-01 00:00:00';
        $new_reward->month = $fecha;
        $new_reward->isModerator = $request->has('isModerator');
        $user = User::where('email', $inputs['email'])->first();
        $new_reward->user()->associate($user);
        $new_reward->save();
        return redirect()->action([RewardController::class, 'showAll'])->withInput();
    }

    //Devuelve el formulario de actualización de reward
    public function updateRewardFormulary(Request $request)
    {
        $reward = Reward::find($request->input('reward_id'));
        return view('admin.add.updateReward', ['reward' => $reward]);
    }

    //Recibe la información de un reward y lo modifica en la base de datos
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'quantity' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect('createRewardForm')
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = $validator->validated();
        $new_reward = Reward::find($request->input('reward_id'));
        $new_reward->points = $inputs['quantity'];
        // La fecha debería ser la actual
        $month = date('m');
        $fecha = '2022-' . $month . '-01 00:00:00';
        $new_reward->month = $fecha;
        $new_reward->isModerator = $request->has('isModerator');
        $user = User::where('email', $inputs['email'])->first();
        $new_reward->user()->associate($user);
        $new_reward->save();
        return redirect()->action([RewardController::class, 'showAll'])->withInput();
        /*
        $user = User::where('email', $request->input('email'))->first();
        error_log($request->input('reward_id'));
        $new_reward->points = $request->input('quantity');
        $month = date('m');
        $fecha = '2022-' . $month . '-01 00:00:00';
        $new_reward->month = $fecha;
        $new_reward->isModerator = $request->has('isModerator');
        $new_reward->user()->associate($user);
        $new_reward->save();
        return redirect()->action([RewardController::class, 'showAll'])->withInput();*/
    }

    //Devuelve el formulario de borrado de Reward pasándole como parámetro los rewards
    public function deleteRewardFormulary()
    {
        $rewards = Reward::all();
        return view('deleteReward', ['rewards' => $rewards]);
    }

    //TODO:
    public function search(Request $request)
    {
        return view('admin.reward', ['reward' => '']);
    }

    //Recibe un id de reward y borra el reward
    public function delete(Request $request)
    {
        $reward = Reward::find($request->input('reward_id'));
        $reward->delete();
        return 'Recompensa borrada';
    }

    public function delete_multiple(Request $request)
    {
        $rewards = json_decode($request->input('rewards'));

        foreach ($rewards as $id) {
            $rewards = Reward::find($id);
            $rewards->delete();
        }

        return back()->withInput();
    }

    public function volver()
    {
        return redirect()->action([RewardController::class, 'showAll'])->withInput();
    }
}
