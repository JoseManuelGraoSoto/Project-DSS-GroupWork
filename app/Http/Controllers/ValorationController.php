<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Valoration;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class ValorationController extends Controller
{
    //Devuelve la vista articlesList pasándole como parámetro todos los articulos
    public function showAll()
    {
        $valorations = Valoration::paginate(7);
        return view('admin.valoration', ['valorations' => $valorations]);
    }

    //Devuelve el formulario de creación de valoration
    public function createvalorationFormulary(Request $request)
    {
        // No funciona, no está implementado obviamente, no es uno de los 3
        $valoration = Valoration::find($request->input('valoration_id'));
        return view('admin.add.createValoration', ['valoration' => $valoration]);
    }

    //Recibe la información de un valoration y lo añade a la base de datos: no integrado
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'title' => 'required|exists:articles,title',
            'quantity' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect(route('valoration.createForm'))
                ->withErrors($validator)
                ->withInput();
        }
        $inputs = $validator->validated();
        $user = User::where('email', $inputs['email'])->first();
        $article = Article::where('title', $inputs['title'])->first();
        $new_valoration = new Valoration;
        $new_valoration->value = $inputs['quantity'];
        $new_valoration->comment = $request->input('comment');
        $new_valoration->isModerator = $request->has('isModerator');
        $new_valoration->user()->associate($user);
        $new_valoration->article()->associate($article);
        $new_valoration->save();
        return
            redirect()->action([ValorationController::class, 'search'])->withInput();
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

        $title = $request->input('title');
        $email = $request->input('email');

        $valorations = null;
        $users = null;
        $articles = null;
        if ($title === null && $email !== null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('valorations.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('valorations.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            } else {
                if ($descendente) {

                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            }
        } elseif ($title !== null && $email === null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {

                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->whereBetween('valorations.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->whereBetween('valorations.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            } else {
                if ($descendente) {

                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            }
        } elseif ($title === null && $email === null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {

                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->whereIn('users.type', $types)->whereBetween('valorations.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->whereIn('users.type', $types)->whereBetween('valorations.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            } else {
                if ($descendente) {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            }
        } else {
            if ($fecha !== null) {
                if ($descendente) {

                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->orWhere('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('valorations.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->orWhere('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('valorations.created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            } else {
                if ($descendente) {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->orWhere('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $valorations = Valoration::join('articles', 'articles.id', '=', 'valorations.article_id')->join('users', 'users.id', '=', 'valorations.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->orWhere('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['valorations.id', 'valorations.value', 'valorations.comment', 'valorations.created_at', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            }
        }

        return view('admin.valoration', compact('valorations'));
    }

    //Devuelve el formulario de borrado de valoration pasándole como parámetro los valoration
    public function deletevalorationFormulary()
    {
        $valo = valoration::all();
        return view('deletevalorations', ['comment' => $valo]);
    }

    public function delete(Request $request)
    {
        $valorations = json_decode($request->input('valorations'));

        foreach ($valorations as $id) {
            $valoration = valoration::find($id);
            $valoration->delete();
        }

        return back()->withInput();
    }

    public function volver()
    {
        return redirect()->action([ValorationController::class, 'search'])->withInput();
    }
}
