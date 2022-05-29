<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Valoration;
use App\Models\Category;
use App\Models\Article_user;

use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;

class SingleArticleController extends Controller
{

    const GUARDAR = "public/articles/";

    // Obtener datos del artículo
    public function getArticle(Request $request, $id)
    {
        $article = Article::find($id);
        $user = Auth::id();
        $article->access()->attach($user);

        $valoration = Valoration::where('article_id', $id)->where('user_id', Auth::user()->id)->first();
        return view('common.article', ['article' => $article, 'valoration' => $valoration]);
    }

    public function acceptArticle(Request $request, $id)
    {
        $new_article = Article::find($id);
        $new_article->acepted = 1;
        $new_article->save();
        return back();
    }

    public function updateValoration(Request $request, $id)
    {
        $valoration = Valoration::where('article_id', $id)->where('user_id', Auth::user()->id)->first();
        $valoration->value = ($request->input('star') == null) ? 0 : $request->input('star');
        $valoration->save();
        return back();
    }

    public function createValoration(Request $request, $id)
    {
        $valoration = new Valoration();
        $valoration->value = ($request->input('star') == null) ? 0 : $request->input('star');
        $valoration->user_id = Auth::user()->id;
        $valoration->article_id = $id;
        // Hay que quitar lo siguiente
        $valoration->comment = "";
        $valoration->isModerator = 0;
        $valoration->save();
        return back();
    }

    public function createArticle()
    {
        $categories = Category::all();
        return view('common.add.article', ['categories' => $categories]);
    }

    // Recibe la información de un artículo y lo añade a la base de datos
    public function createArticleUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'selec-txt' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('createArticle'))
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = $validator->validated();
        $img = $inputs['selec-txt'];
        if ($img == null) {
            $nombreImagen = "prueba.pdf";
        } else {
            $nombreImagen = $img->getClientOriginalName();
            \Storage::disk('local')->put(self::GUARDAR . $nombreImagen, \File::get($img));
        }
        $user = User::find(Auth::id());
        $categoria = Category::where('category', $inputs['category'])->firstOrFail();
        $new_article = new Article;
        $new_article->title = $inputs['title'];
        $new_article->category = $categoria->category;
        $new_article->valoration = 0;
        $new_article->pdf_path = $nombreImagen;
        $new_article->content = $inputs['description']; //$request->input('content');
        $new_article->acepted = $request->has('accepted');
        $new_article->guestAccessible = 0;
        $new_article->category_id = $categoria->id;
        $new_article->user()->associate($user);
        $new_article->save();

        return redirect()->route('article', ['id' => $new_article->id]);
    }
}
