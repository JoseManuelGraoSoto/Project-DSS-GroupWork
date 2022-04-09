<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Valoration;
use App\Models\User;
use App\Models\Article;

class ValorationController extends Controller
{
    //Devuelve la vista articleInfo pasándole como parámetro el articulo con el id requerido en la url
    public function show($id)
    {
        $valoration = Valoration::find($id);
        return view('valorationInfo', ['comment' => $valoration]);
    }

    //Devuelve la vista articlesList pasándole como parámetro todos los articulos
    public function showAll()
    {
        $valorations = Valoration::paginate(7);
        return view('admin.valoration', ['valorations' => $valorations]);
    }

    //Devuelve el formulario de creación de Reward
    public function createValorationFormulary()
    {
        return view('createValoration');
    }

    //Recibe la información de un Reward y lo añade a la base de datos
    public function create(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $article = Article::find($request->input('article_id'));
        $new_Valoration = new Valoration;
        $new_Valoration->points = $request->input('value');
        $new_Valoration->month = $request->input('comment');
        $new_Valoration->isModerator = $request->input('isModerator');
        $new_Valoration->acepted = 0;
        $new_Valoration->user()->associate($user);
        $new_Valoration->article()->associate($article);
        $new_Valoration->save();
        return view('valorationCreada');
    }

    //Devuelve el formulario de borrado de Reward pasándole como parámetro los reward
    public function deleteValorationFormulary()
    {
        $valo = Valoration::all();
        return view('deleteValorations', ['comment' => $valo]);
    }

    //Recibe un id de usuario y borra la reward
    public function delete(Request $request)
    {
        $valo = Valoration::where('user_id', $request->input('user_id'))->where('article_id', $request->input('article_id'));
        $valo->delete();
    }

    public function delete_multiple(Request $request)
    {
        $valorations = json_decode($request->input('valorations'));

        foreach ($valorations as $id) {
            $valorations = Valoration::find($id);
            $valorations->delete();
        }

        return back()->withInput();
    }
}
