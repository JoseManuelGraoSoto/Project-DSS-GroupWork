<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller { 
/*     public function showAll($categorys) {
        $categorys = Category::paginate(7);
        return view('admin.category', ['category' => $categorys]);
    } */

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'categoria' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('category'))
                ->withErrors($validator)
                ->withInput();
        }
        $inputs = $validator->validated();
        $nombre = $request->input('categoria');
        if(!$this->buscar($nombre)) {
            $new_category = new Category;
            //$new_category = Category::find($request->input('category_id'));
            $new_category->category = $nombre;
            $new_category->save();
        }
        return redirect()->action([CategoryController::class, 'search'])->withInput();
    }
    
    public function updateCategory(Request $request) {

    }

    public function buscar($nombre) {
        $categorys = Category::where('category', '=', $nombre)->get();
        $existe = $categorys->count();
        if ($existe == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function search(Request $request) {
        $nombre = $request->input('name');
        if($nombre == null) {
            $categorys = Category::all();
        } else {
            $categorys =  Category::where('categoria', 'LIKE', '%'.$nombre.'%')->orderBy('name', 'desc');
        }
        return view('admin.category', ['categorys' => $categorys]);
    }

    public function delete(Request $request) {
        $categorias = $request->all();
        dd($categorias);
        foreach ($categorias as $id) {
            echo $id;
/*             if($id === array_key_first($categorias)) {
            } else {
                $borrar = Category::where('category', '=', $id);
                $borrar->delete();
            } */
        }
        dd($categorias);

        return back()->withInput();
    }
}