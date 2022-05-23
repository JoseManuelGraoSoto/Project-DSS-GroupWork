<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    const LOCATION = "storage/app/public/users/";
    const GUARDAR = "public/users/";
    //Devuelve la vista usersProfile pasándole como parámetro todos los usuarios
    public function showAll($users)
    {
        $users = User::paginate(7);
        return view('admin.user', ['users' => $users]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'radio' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'selec-img' => 'mimes:jpg,png,jpeg,webp|max:5048',
            'number_days' => 'required|max:365|min:0',
            'telephone' => 'required|regex:/([0-9]){3,3}([ ]){1,1}([0-9]){3,3}([ ]){1,1}([0-9]){3,3}/'
        ]);

        if ($validator->fails()) {
            return redirect(route('user.createForm'))
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = $validator->validated();
        //$request->file('selec-img')->storeAs(public_path('images'), $inputs['selec-img']);
        $img = $inputs['selec-img'];
        if ($img == null) {
            $nombreImagen = "default.png";
        } else {
            $nombreImagen = $request->file('selec-img')->getClientOriginalName();
            \Storage::disk('local')->put(self::GUARDAR . $nombreImagen, \File::get($img));
        }
        //$nombreImagen = self::LOCATION . $nombreImagen;
        $new_user = new User;
        $new_user->name = $inputs['name'];
        $new_user->type = $inputs['radio'];
        $new_user->email = $inputs['email'];
        $new_user->password = $inputs['password'];
        $new_user->telephone = $inputs['telephone'];
        $new_user->imagen_path = $nombreImagen;
        $new_user->numberDaysSuscripted = $inputs['number_days'];
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'radio' => 'required',
            'email' => 'required|email',
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'selec-img' => 'required|mimes:jpg,png,jpeg,webp|max:5048',
            'number_days' => 'required|max:365|min:0',
            'telephone' => 'required|regex:/([0-9]){3,3}([ ]){1,1}([0-9]){3,3}([ ]){1,1}([0-9]){3,3}/'
        ]);

        if ($validator->fails()) {
            return redirect(route('user.updateForm'))
                ->withErrors($validator)
                ->withInput();
        }
        $img = $inputs['selec-img'];
        if ($img == null) {
            $nombreImagen = "default.png";
        } else {
            $nombreImagen = $request->file('selec-img')->getClientOriginalName();
            \Storage::disk('local')->put(self::GUARDAR . $nombreImagen, \File::get($img));
        }
        $nombreImagen = self::LOCATION . $nombreImagen;
        $inputs = $validator->validated();
        $new_user = User::find($request->input('user_id'));
        $new_user->name = $inputs['name'];
        $new_user->type = $inputs['radio'];
        $new_user->email = $inputs['email'];
        $new_user->password = $inputs['password'];
        $new_user->imagen_path = $nombreImagen;
        $new_user->numberDaysSuscripted = $inputs['number_days'];
        $new_user->telephone = $inputs['telephone'];
        $new_user->save();
        return redirect()->action([UsersController::class, 'search'])->withInput();
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

        $types = array('reader', 'author', 'moderator', 'administrator');
        if ($request->has('readerCheckbox') || $request->has('authorCheckbox') || $request->has('moderatorCheckbox') || $request->has('administratorCheckbox')) {
            $types = array();
        }
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

        $users = null;
        if ($nombre === null && $email !== null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {
                    $users = User::where('email', 'LIKE', '%' . $email . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('email', 'LIKE', '%' . $email . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate(7)->withQueryString();
                }
            } else {
                if ($descendente) {
                    $users = User::where('email', 'LIKE', '%' . $email . '%')->whereIn('type', $types)->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('email', 'LIKE', '%' . $email . '%')->whereIn('type', $types)->orderBy('id')->paginate(7)->withQueryString();
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

                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orWhere('email', 'LIKE', '%' . $email . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orWhere('email', 'LIKE', '%' . $email . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate(7)->withQueryString();
                }
                //$usersName = User::where('name', 'LIKE', '%' . $nombre . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->get();
                //$usersEmail = User::where('email', 'LIKE', '%' . $email . '%')->whereIn('type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->get();
            } else {
                if ($descendente) {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->orWhere('email', 'LIKE', '%' . $email . '%')->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $users = User::where('name', 'LIKE', '%' . $nombre . '%')->orWhere('email', 'LIKE', '%' . $email . '%')->orderBy('id')->paginate(7)->withQueryString();

                }
            }
        }
        return view('admin.user', ['users' => $users]);
    }

    public function delete(Request $request)
    {
        $users = json_decode($request->input('users'));

        foreach ($users as $id) {
            $user = User::find($id);
            $user->delete();
        }

        return back()->withInput();
    }

    public function volver()
    {
        return redirect()->action([UsersController::class, 'search'])->withInput();
    }

    public function comprobarLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->firstOrFail();
        if ($user) {
            if (strcmp($password, $user->password) === 0) {
                if (strcmp($user->type, 'administrator') === 0) {
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

    public function logged()
    {
        return view('admin.init');
    }
}
