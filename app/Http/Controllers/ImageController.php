<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller {
    public function store(Request $request) {
        // Sirve para obtener el nombre del fichero
        $name = $request->file('image')->getClientOriginalName();

        // Sirve para obtener el tamaño del fichero
        $extension = $request->file('image')->getSize();

        // Sirve para obtener la extensión de la imagen
        $size = $request->file('image')->guessExtension();
        //$newImageName = $request->name . '.'. $request->image->extension();
        $newImageName = $request->file('image')->getClientOriginalName();
        echo 'Nombre: '.$newImageName; 
        $request->image->move(public_path('images'), $newImageName);
        /* $image = Image::create([
            'nombre' => 'required',
            'extensión' => 'required|mines:jpg,png,jpeg|max:5048',
            'tamaño' => 'required|max:5048',
        ]); */

        $imagen = Image::create([
/*             'nombre' => $request->file('image')->getClientOriginalName(),
            'extensión' => $request->file('image')->guessExtension(),
            'tamaño' => $request->file('image')->getSize() */
            'nombre' => $name,
            'extensión' => $extension,
            'tamaño' => $size
        ]);

        return redirect('/prueba');
    }
}