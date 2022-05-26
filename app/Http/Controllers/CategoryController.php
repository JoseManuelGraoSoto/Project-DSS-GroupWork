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
            dd(TRUE);
            $new_category = new Category;
            //$new_category = Category::find($request->input('category_id'));
            $new_category->category = $nombre;
            $new_category->save();
        }
            dd(FALSE);
        return redirect()->action([CategoryController::class, 'search'])->withInput();
    }
    
    public function updateCategory(Request $request) {

    }

    public function buscar($nombre) {
        //$category =  Category::where('category', '==', $nombre)->withQueryString();
        try{
            $category =  Category::where('category',$nombre);
            if ($category.wheres.count()) {
                return true;
            } else {
                return false;
            }
        } catch (QueryException $e) {
                dd(TRUE);
            return false;
        }
    }

    public function search(Request $request) {
        $nombre = $request->input('name');
        if($nombre == null) {
            $categorys = Category::paginate(7);
        } else {
            $categorys =  Category::where('name', 'LIKE', '%'.$nombre.'%')->orderBy('name', 'desc')->paginate(7)->withQueryString();
        }
        return view('admin.category', ['categorys' => $categorys]);
    }

    public function delete(Request $request) {
        $categorys = json_decode($request->input('categorys'));
        foreach ($categorys as $id) {
            $category = Category::find($id);
            $category->delete();
        }

        return back()->withInput();
    }
}