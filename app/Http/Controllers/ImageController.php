<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Producto;
use Auth;
use Redirect;

class ImageController extends Controller
{
    /**
     * Carga la vista para subir imágenes con dropzone al servidor.
     *
     * @return view imagenes.cargarImagenes
     */
    public function index()
    {
        if (Auth::check()) {
            $title = 'Cargar imágenes';
            $menu = 'Imágenes';
            return view('admin.imagenes.cargarImagenes', ['menu' => $menu, 'title' => $title]);
        } else {
            return redirect::to('/');
        }
    }

    /**
     * Sube las imagenes al servidor.
     *
     * @return ['uploaded'=>true]
     */
    public function subir_imagenes()
    {
        $folder = auth()->user()->business_id;
        $path = "products/".$folder.'/'."default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
        $file = Input::file('file');
        $extension_archivo = $file->getClientOriginalExtension();
        if (array_search($extension_archivo, $extensiones_permitidas)) {
            $name = $file->getClientOriginalName();
            $file->move('products/'.$folder, $name);
            return ['uploaded'=>true];
        }
        return ['uploaded' => false];
    }
}
