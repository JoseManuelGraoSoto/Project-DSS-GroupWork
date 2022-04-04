<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //Devuelve la vista userProfile pasándole como parámetro el usuario con el id requerido en la url
    public function show($id) {
        $user = User::where('name', $id)-> first();
        return view('userProfile', ['user' => $user]);
    }

    //Devuelve la vista usersProfile pasándole como parámetro todos los usuarios
    public function showAll(){
        $users = User::all();
        return view('usersList', ['users' => $users]);
    }

    //Devuelve el formulario de creación de User
    public function createUserFormulary(){
        return view('createUser');
    }

    //Recibe la información de un usuario y lo añade a la base de datos
    public function create(Request $request){
        $new_user = new User;
        $new_user->name = $request->input('name');
        $new_user->type = $request->input('type');
        $new_user->email = $request->input('email');
        $new_user->password = $request->input('password');
        $new_user->telephone = $request->input('telephone');
        $new_user->save();
        return view('usuarioCreado');
    }

    //Devuelve el formulario de actualización de user
    public function updateUserFormulary(){
        return view('updateUser');
    }

    //Recibe la información de un usuario y lo modifica en la base de datos
    public function update(Request $request){
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
    public function deleteUserFormulary(){
        $users = User::all();
        return view('deleteUser', ['users' => $users]);
    }

    //Recibe un id de usuario y borra el usuario
    public function delete($id){
        $user = User::find($id);
        $name = $user->name;
        $user->delete();
        return $name . ' borrado';
    }

}
