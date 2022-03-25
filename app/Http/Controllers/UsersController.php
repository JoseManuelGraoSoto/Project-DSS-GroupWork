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

    public function delete($id){
        $user = User::where('name', $id)-> first();
        $user->delete();
        return 'Borrado';
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
 
        //
    }

    public function update(){
        
    }
}
