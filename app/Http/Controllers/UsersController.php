<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use function Ramsey\Uuid\v1;

class UsersController extends Controller {
    //Devuelve la vista userProfile pasándole como parámetro el usuario con el id requerido en la url
    public function show($id)
    {
        $user = User::where('name', $id)->first();
        return view('userProfile', ['user' => $user]);
    }

    //Devuelve la vista usersProfile pasándole como parámetro todos los usuarios

    public function showAll($users)
    {
        $users = User::paginate(7);
        return view('admin.user', ['users' => $users]);
        // $users = User::all();
        // return view('admin.user', ['users' => $users]);
    }

    //Devuelve el formulario de creación de User
    public function createUserFormulary(Request $request)
    {
        $user = User::find($request->input('user_id'));
        return view('admin.add.createUser', ['user' => $user]);
    }

    //Recibe la información de un usuario y lo añade a la base de datos
    public function create(Request $request)
    {
        $inputs = $request->all();
        $new_user = new User;
        $new_user->name = $inputs['name'];
        $new_user->type = $inputs['radio'];
        $new_user->email = $inputs['email'];
        $new_user->password = $inputs['password'];
        $new_user->telephone = $inputs['telephone'];
        $new_user->save();
        //TODO: cambiar a redirect
        return redirect()->action([UsersController::class, 'search'])->withInput();
        /*$users = User::paginate(7);
        return view('admin.user', ['users' => $users]);*/
    }

    //Devuelve el formulario de actualización de user
    public function updateUserFormulary(Request $request)
    {
        $user = User::find($request->input('user_id'));
        return view('admin.add.updateUser', ['user' => $user]);
    }

    //Recibe la información de un usuario y lo modifica en la base de datos
    public function update(Request $request)
    {
        $inputs = $request->all();
        $new_user = User::find($inputs['user_id']);
        $new_user->name = $inputs['name'];
        $new_user->type = $inputs['radio'];
        $new_user->email = $inputs['email'];
        $new_user->password = $inputs['password'];
        $new_user->telephone = $inputs['telephone'];
        $new_user->save();
        return redirect()->action([UsersController::class, 'search'])->withInput();
    }

    //Devuelve el formulario de borrado de User pasándole como parámetro los usuarios
    public function deleteUserFormulary()
    {
        $users = User::all();
        return view('deleteUser', ['users' => $users]);
    }

    //Recibe un id de usuario y borra el usuario
    public function delete($id)
    {
        $user = User::find($id);
        $name = $user->name;
        $user->delete();
        return $name . ' borrado';
    }

    //Devuelve el formulario de borrado de User pasándole como parámetro los usuarios
    public function searchUserFormulary()
    {
        return view('vistaPruebaControladores.searchUserForm');
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

        $types = array();
        //select * from users where type in ('reader', 'author')
        if ($request->has('readerCheckbox')) {
            $types[] = 'reader';
        }
        if ($request->has('authorCheckbox')) {
            $types[] = 'author';
        }
        if ($request->has('moderatorCheckbox')) {
            $types[] = 'moderator';
        }
        if ($request->has('administratorCheckbox')) {
            $types[] = 'administrator';
        }

        $nombre = $request->input('name');
        $email = $request->input('email');
        $primeraParteEmail = '';
        for ($i = 0; $i < strlen($email); $i++) {
            if ($email[$i] === '@') {
                break;
            }
            $primeraParteEmail .= $email[$i];
        }

        //TODO: MODIFICAR PARA AÑADIR QUE SI EL $TYPES ESTÁ VACÍO SE HAGA UNA COSA O LA OTRA


        $users = null;
        if ($nombre === null && $email !== null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {
                    $users = User::where('email', 'LIKE', $primeraParteEmail . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('email', 'LIKE', $primeraParteEmail . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate(7)->withQueryString();
                }
            } else {
                if ($descendente) {
                    $users = User::where('email', 'LIKE', $primeraParteEmail . '%')->whereIn('type', $types)->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('email', 'LIKE', $primeraParteEmail . '%')->whereIn('type', $types)->orderBy('id')->paginate(7)->withQueryString();
                }
            }
        } elseif ($nombre !== null && $email === null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate(7)->withQueryString();
                }
            } else {
                if ($descendente) {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->whereIn('type', $types)->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->whereIn('type', $types)->orderBy('id')->paginate(7)->withQueryString();
                }
            }
        } else {
            if ($fecha !== null) {
                if ($descendente) {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orWhere('email', 'LIKE', $primeraParteEmail . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orWhere('email', 'LIKE', $primeraParteEmail . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate(7)->withQueryString();
                }
                //$usersName = User::where('name', 'LIKE', '%' . $nombre . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->get();
                //$usersEmail = User::where('email', 'LIKE', $primeraParteEmail . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->get();
            } else {
                if ($descendente) {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->orWhere('email', 'LIKE', $primeraParteEmail . '%')->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->orWhere('email', 'LIKE', $primeraParteEmail . '%')->orderBy('id')->paginate(7)->withQueryString();
                }
            }
        }
        return view('admin.user', ['users' => $users]);
    }

    public function delete_multiple(Request $request)
    {
        $users = json_decode($request->input('users'));

        foreach ($users as $id) {
            $user = User::find($id);
            $user->delete();
        }

        return back()->withInput();
    }

    public function volver() {
        error_log('HOLAAAAAAAAA');
        return redirect()->action([UsersController::class, 'search'])->withInput();
    }

    public function comprobarLogin(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();
        if ($user) {
            if (strcmp($password, $user->password) === 0) {
                if (strcmp($user->type,'administrator') === 0) {
                    return redirect()->action([UsersController::class, 'logged']);
                } else {
                    return back()->withInput()->withErrors(['type' => 'No es administrador']);
                }
            } else {
                return back()->withInput()->withErrors(['password' => 'Contraseña incorrecta']);
            }
        } else {
            return back()->withInput()->withErrors(['email' => 'Email incorrecto']);
        }
    }

    public function logged() {
        return view('admin.init');
    }
}
