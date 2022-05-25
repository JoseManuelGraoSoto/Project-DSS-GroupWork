<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller { 
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.category'))
                ->withErrors($validator)
                ->withInput();
        }
        $inputs = $validator->validated();
        $nombre = $request->input('name');
        if(!buscar($nombre)) {
            $new_category = new Category;
            $new_category = Category::find($request->input('category_id'));
            $new_category->name = $nombre;
            $new_category->save();
        }
        return redirect()->action([CategoryController::class, 'search'])->withInput();
    }
    
    public function updateCategory(Request $request) {

    }

    public function buscar($nombre) {
        $users =  Category::where('name', '==', '%'.$nombre.'%')->orderBy('name', 'desc')->withQueryString();
        if ($users.count() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function search(Request $request) {
        $nombre = $request->input('name');
        $categorys =  Category::where('name', 'LIKE', '%'.$nombre.'%')->orderBy('name', 'desc')->withQueryString();
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