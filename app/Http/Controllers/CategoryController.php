<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
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
