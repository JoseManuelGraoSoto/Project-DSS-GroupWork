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

    public function create(Request $request, $name)
    {
        $new_category = new Category;
        $new_category->category = $name;
        $new_category->save();
        return back();
    }

    public function showAll()
    {
        $categorys = Category::all();
        return view('admin.category', ['categorys' => $categorys]);
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
