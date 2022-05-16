<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class RewardController extends Controller
{

    //Devuelve la vista rewardsProfile pasándole como parámetro todos los rewards
    public function showAll()
    {
        $rewards = Reward::paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at']);
        return view('admin.reward', ['rewards' => $rewards]);
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
            return redirect(route('reward.createForm'))
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
        $user = User::where('email', $inputs['email'])->firstOrFail();
        $new_reward->user()->associate($user);
        $new_reward->save();
        return redirect()->action([RewardController::class, 'search'])->withInput();
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
            return redirect(route('reward.createForm'))
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
        $user = User::where('email', $inputs['email'])->firstOrFail();
        $new_reward->user()->associate($user);
        $new_reward->save();
        return redirect()->action([RewardController::class, 'search'])->withInput();
        /*
        $user = User::where('email', $request->input('email'))->firstOrFail();
        error_log($request->input('reward_id'));
        $new_reward->points = $request->input('quantity');
        $month = date('m');
        $fecha = '2022-' . $month . '-01 00:00:00';
        $new_reward->month = $fecha;
        $new_reward->isModerator = $request->has('isModerator');
        $new_reward->Reward()->associate($Reward);
        $new_reward->save();
        return redirect()->action([RewardController::class, 'showAll'])->withInput();*/
    }

    //Devuelve el formulario de borrado de Reward pasándole como parámetro los rewards
    public function deleteRewardFormulary()
    {
        $rewards = Reward::all();
        return view('deleteReward', ['rewards' => $rewards]);
    }

    public function extraerMes($mes)
    {
        switch ($mes) {
            case 'Enero':
                return '01';
            case 'Febrero':
                return '02';
            case 'Marzo':
                return '03';
            case 'Abril':
                return '04';
            case 'Mayo':
                return '05';
            case 'Junio':
                return '06';
            case 'Julio':
                return '07';
            case 'Agosto':
                return '08';
            case 'Septiembre':
                return '09';
            case 'Octubre':
                return '10';
            case 'Noviembre':
                return '11';
            case 'Diciembre':
                return '12';
        }
    }

    //TODO:
    public function search(Request $request)
    {
        $descendente = $request->has('order');
        $fecha = $request->input('datepicker');
        $dia = '';
        $mes = '';
        $anyo = '';
        if ($fecha !== null) {
            $j = 0;
            for ($j = 0; $j < strlen($fecha); $j++) {
                if ($fecha[$j] === ' ') {
                    $j++;
                    break;
                }
            }
            $dia = $fecha[$j] . $fecha[$j + 1];
            $j += 3;
            $mes = '';
            for ($j; $j < strlen($fecha); $j++) {
                if ($fecha[$j] === ' ') {
                    $j++;
                    break;
                } else {
                    $mes .= $fecha[$j];
                }
            }
            $mes = $this->extraerMes($mes);
            $anyo = $fecha[$j] . $fecha[$j + 1] . $fecha[$j + 2] . $fecha[$j + 3];

            $fecha = $anyo . '-' . $mes . '-' . $dia;
        }

        $types = array(0, 1);
        if ($request->has('authorCheckbox') || $request->has('moderatorCheckbox')) {
            $types = array();
        }
        if ($request->has('authorCheckbox')) {
            $types[] = 0;
        }
        if ($request->has('moderatorCheckbox')) {
            $types[] = 1;
        }

        $nombre = $request->input('name');
        $email = $request->input('email');

        $rewards = null;
        if ($nombre === null && $email !== null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('rewards.isModerator', $types)->whereBetween('rewards.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('rewards.id', 'desc')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                } else {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('rewards.isModerator', $types)->whereBetween('rewards.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('rewards.id')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                }
            } else {
                if ($descendente) {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('rewards.isModerator', $types)->orderBy('rewards.id', 'desc')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                } else {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('rewards.isModerator', $types)->orderBy('rewards.id')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                }
            }
        } elseif ($nombre !== null && $email === null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.name', 'LIKE', '%' . $nombre . '%')->whereIn('rewards.isModerator', $types)->whereBetween('rewards.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('rewards.id', 'desc')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                } else {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.name', 'LIKE', '%' . $nombre . '%')->whereIn('rewards.isModerator', $types)->whereBetween('rewards.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('rewards.id')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                }
            } else {
                if ($descendente) {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.name', 'LIKE', '%' . $nombre . '%')->whereIn('rewards.isModerator', $types)->orderBy('rewards.id', 'desc')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                } else {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.name', 'LIKE', '%' . $nombre . '%')->whereIn('rewards.isModerator', $types)->orderBy('rewards.id')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                }
            }
        } else {
            if ($fecha !== null) {
                if ($descendente) {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.name', 'LIKE', '%' . $nombre . '%')->whereBetween('rewards.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->whereIn('rewards.isModerator', $types)->orWhere('users.email', 'LIKE', '%' . $email . '%')->whereBetween('rewards.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->whereIn('rewards.isModerator', $types)->orderBy('rewards.id', 'desc')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                } else {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.name', 'LIKE', '%' . $nombre . '%')->whereBetween('rewards.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->whereIn('rewards.isModerator', $types)->orWhere('users.email', 'LIKE', '%' . $email . '%')->whereBetween('rewards.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->whereIn('rewards.isModerator', $types)->orderBy('rewards.id')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                }
            } else {
                if ($descendente) {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.name', 'LIKE', '%' . $nombre . '%')->whereIn('rewards.isModerator', $types)->orWhere('users.email', 'LIKE', '%' . $email . '%')->whereIn('rewards.isModerator', $types)->orderBy('rewards.id', 'desc')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                } else {
                    $rewards = Reward::join('users', 'users.id', '=', 'rewards.user_id')->where('users.name', 'LIKE', '%' . $nombre . '%')->whereIn('rewards.isModerator', $types)->orWhere('users.email', 'LIKE', '%' . $email . '%')->whereIn('rewards.isModerator', $types)->orderBy('rewards.id')->paginate($perPage = 7, $columns = ['rewards.id', 'users.email', 'users.name', 'rewards.points', 'rewards.isModerator', 'rewards.created_at'])->withQueryString();
                }
            }
        }

        return view('admin.reward', ['rewards' => $rewards]);
    }

    public function delete(Request $request)
    {
        $rewards = json_decode($request->input('rewards'));

        foreach ($rewards as $id) {
            $reward = Reward::find($id);
            $reward->delete();
        }

        return back()->withInput();
    }

    public function volver()
    {
        return redirect()->action([RewardController::class, 'search'])->withInput();
    }
}
