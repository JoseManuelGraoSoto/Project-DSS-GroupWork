<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /*     public function showAll($categorys) {
        $categorys = Category::paginate(7);
        return view('admin.category', ['category' => $categorys]);
    } */

    public function create($name)
    {
        error_log('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbbb');
        /*
        $validator = Validator::make($request->all(), [
            'search-category' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('category'))
                ->withErrors($validator)
                ->withInput();
        }
        $inputs = $validator->validated();
        $nombre = $inputs['search-category'];
        if (!$this->buscar($nombre)) {
            $new_category = new Category;
            //$new_category = Category::find($request->input('category_id'));
            $new_category->category = $nombre;
            $new_category->save();
        }
        */
        return redirect()->action([CategoryController::class, 'showAll'])->withInput();
    }

    public function showAll()
    {
        $categorys = Category::all();
        return view('admin.category', ['categorys' => $categorys]);
    }

    public function buscar($nombre)
    {
        $categorys = Category::where('category', '=', $nombre)->get();
        $existe = $categorys->count();
        if ($existe == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(Request $request)
    {
        $categorys = $request->all();

        $i = 0;
        foreach ($categorys as $id) {
            if ($i == 0) {
                $i++;
                continue;
            }
            $category = Category::find($id);
            $category->delete();
        }

        return redirect()->action([CategoryController::class, 'showAll'])->withInput();
    }
}
