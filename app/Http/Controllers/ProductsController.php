<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Business;
use App\Vehicle;
use DB;

class ProductsController extends Controller
{
	/**
     * Show the products table.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Mis productos';
        $menu = 'Productos';
        $products = Product::where('status', '!=', 3)->get();
        return view('admin.products.index', ['menu' => $menu, 'title' => $title, 'products' => $products]);
    }

    /**
     * Store a single product.
     *
     * @return $product
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'vehiculo' => 'required',
            'descripcion' => 'required|min:3',
            'nombre' => 'required|min:3',
            'imagen' => 'image',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
            'peso' => 'required',
            'alto' => 'required:numeric',
            'largo' => 'required:numeric',
            'ancho' => 'required:numeric',
        ]);

        $folder = auth()->user()->business_id;

        $product = new Product();
        $product->business_id = auth()->user()->business_id;
        $product->status = 2;//Cambiar esta propiedad
        $product->vehicle_id = $request->vehiculo;
        $product->name = $request->nombre;
        $product->description = $request->descripcion;

        $img = $request->file('imagen');
        $name = $img->getClientOriginalName();
        $img->move('products/'.$folder, $name);
        $product->photo = 'products/'.$folder.'/'.$name;

        $product->price = $request->precio;
        $product->stock = $request->stock;
        $product->weight = $request->peso;
        $product->lenght = $request->largo;
        $product->height = $request->alto;
        $product->width = $request->ancho;
        $product->is_best_seller = $request->mas_vendido ? 1 : 0;
        $product->in_promotion = $request->en_promocion ? 1 : 0;
        $product->all_day = $request->disponible_todo_el_dia? 1 : 0;
        $product->istop20 = $request->istop20 ? 1 : 0;
        $product->save();
        return $product;
    }

    /**
     * Uodate a single product.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
        $folder = auth()->user()->business_id;  

        $this->validate($request, [
            'vehiculo' => 'required',
            'nombre' => 'required|min:3',
            'descripcion' => 'required|min:3',
            'nombre' => 'required|min:3',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
            'peso' => 'required',
            'alto' => 'required:numeric',
            'largo' => 'required:numeric',
            'ancho' => 'required:numeric',
        ]);

        $extensions = ['jpeg', 'jpg', 'png', 'gif'];
        $file = $request->file('imagen');

        if ( $file && $file instanceof UploadedFile) {
            if (!array_search($file->getClientOriginalExtension(), $extensions)) {
                return 'error';
            }
        }

        $product->vehicle_id = $request->vehiculo;
        $product->name = $request->nombre;
        $product->description = $request->descripcion;

        if ($request->file('imagen')) {
            $extension_archivo = $file->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $img = $request->file('imagen');
                $name = $img->getClientOriginalName();
                $img->move('products/'.$folder, $name);
                $path = 'products/'.$folder.'/'.$name;
                $product->photo = $path;
            }
        }

        //isset($path) ? return 'trae algo' : return 'no trae imagen';
        //$product->photo = isset($path) ? $path : $request->imagen;

        $product->status = 2;
        $product->price = $request->precio;
        $product->stock = $request->stock;
        $product->weight = $request->peso;
        $product->lenght = $request->largo;
        $product->height = $request->alto;
        $product->width = $request->ancho;
        $product->is_best_seller = $request->mas_vendido ? 1 : 0;
        $product->in_promotion = $request->en_promocion ? 1 : 0;
        $product->all_day = $request->disponible_todo_el_dia ? 1 : 0;
        $product->istop20 = $request->istop20 ? 1 : 0;
        $product->save();

        return $product;
    }

    /**
     * Destroy a single product.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->status = 3;
        $product->save();

        return $product;
    }

    /**
     * Destroy multiple products.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelections(Request $req)
    {
        return DB::table('products')
        ->whereIn('id', $req->ids)
        ->update(['status' => 3]);
    }

    /**
     * Export the products that belongs to an ecommerce.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportProducts()
    {
        return Product::exportProducts();
    }

    /**
     * Export the products that belongs to an ecommerce.
     *
     * @return \Illuminate\Http\Response
     */
    public function importProducts(Request $req)
    {
        $this->validate($req, [
            'excel' => 'file|required|max:5000',
        ]);
        $extensions = ['xls', 'xlsx'];
        $file = $req->file('excel');

        if ( $file && $file instanceof UploadedFile) {
            if (!array_search($file->getClientOriginalExtension(), $extensions)) {
                return 'error';
            }
        }
        return Product::importProducts($req);
    }

    /**
     * Download the excel template for products.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadTemplate()
    {
        return Product::downloadTemplate();
    }

    /**
     *============================================================================================================================
     *=                      Empiezan los métodos relacionados al módulo de productos para el administrador                      =
     *============================================================================================================================
     */

    /**
     * Show the products table to the admin user in order to approve products.
     *
     * @return \Illuminate\Http\Response
     */
    public function approveProducts()
    {
        $menu = $title = 'Validar productos';
        
        $products = Product::with('business')->where('status', 2)->get();
        foreach ($products as $product) {
            $product->vehicle_name = Vehicle::where('id', $product->vehicle_id)->first();
        }
        return view('admin.products.approve', ['menu' => $menu, 'title' => $title, 'products' => $products]);
    }

    /**
     * Approve or reject a product.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateProduct(Product $product, Request $request)
    {
        $product->status = $request->validation == 1 ? 1 : 0;
        $product->save();

        return $product;
    }
}
