<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UsersController extends Controller
{
    //Devuelve la vista userProfile pasándole como parámetro el usuario con el id requerido en la url
    public function show($id)
    {
        $user = User::where('name', $id)->first();
        return view('userProfile', ['user' => $user]);
    }

    //Devuelve la vista usersProfile pasándole como parámetro todos los usuarios
    public function showAll()
    {
        $users = User::all();
        return view('admin.user', ['users' => $users]);
    }

    //Devuelve el formulario de creación de User
    public function createUserFormulary()
    {
        return view('createUser');
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
        $users = User::all();
        return view('admin.user', ['users' => $users]);
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
        $user = User::find($request->input('user_id'));
        $user->name = $request->input('name');
        $user->type = $request->input('type');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->telephone = $request->input('telephone');
        $user->save();
        return 'Usuario actualizado';
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

    /*
    public function redirectUserSearch(Collection $users)
    {
        return view('admin.user', ['users' => $users]);
    }*/

    public function search(Request $request)
    {
        $nombre = $request->input('name');
        $email = $request->input('email');
        $primeraParteEmail = '';
        for ($i = 0; $i < strlen($email); $i++) {
            if ($email[$i] === '@') {
                break;
            }
            $primeraParteEmail .= $email[$i];
        }

        $users = null;
        if ($nombre === null && $email !== null) {
            $users = User::where('email', 'LIKE', $primeraParteEmail . '%')->get();
        } elseif ($nombre !== null && $email === null) {
            $users = User::where('name', 'LIKE', '%' . $nombre . '%')->get();
        } else {
            $usersName = User::where('name', 'LIKE', '%' . $nombre . '%')->get();
            $usersEmail = User::where('email', 'LIKE', $primeraParteEmail . '%')->get();
            $users = $usersName->concat($usersEmail)->unique();
        }

        return view('admin.user', ['users' => $users]);
    }
}
