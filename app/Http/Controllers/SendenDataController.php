<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SendenData;

class senden_datasController extends Controller
{
	/**
     * Show the form to store
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $senden_data = SendenData::first();
        return view('admin.senden_data.index', ['senden_data' => $senden_data]);
    }

    /**
     * Store a single senden_data.
     *
     * @return $senden_data
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            contact_number
            address
            contact_email
            privacy_terms_file
            terms_and_conditions_file
            longitude
            latitude
            logo

            'numero_contacto' => 'required',
            'direccion' => 'required|min:3',
            'email' => 'required|email',
            'terminos_privacidad' => 'required',
            'terminos_condiciones' => 'required',
            'longitud' => 'required|numeric',
            'latitud' => 'required|numeric',
            'logo' => 'image',

        ]);

        $senden_data = new SendenData();
        $senden_data->contact_number = $request->numero_contacto;
        $senden_data->address = $request->direccion;
        $senden_data->contact_email = $request->email;

        $extensions = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        $file = $request->file('terminos_privacidad');

        if ( $file && $file instanceof UploadedFile) {
            if (!array_search($file->getClientOriginalExtension(), $extensions)) {
                return 'error';
            }
        }

        $privacy_file = $request->file('terminos_privacidad');
        $name = time().'.'.$privacy_file->getClientOriginalExtension();
        $privacy_file->move('files', $name);
        $senden_data->image = 'files/'.$name;

        $senden_data->price = $request->precio;

        $senden_data->save();
        return $senden_data;
    }

    /**
     * Uodate a single senden_data.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, senden_data $senden_data)
    {
       $this->validate($request, [
            'vehiculo_id' => 'required',
            'nombre' => 'required|min:3',
            'descripcion' => 'required|min:3',
            'nombre' => 'required|min:3',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
            'peso' => 'required',
            'alto' => 'required:numeric',
            'largo' => 'required:numeric',
            'ancho' => 'required:numeric',
            'popular' => 'required',
            'en_promocion' => 'required',
            'inicio_hora_venta' => 'required',
            'fin_hora_venta' => 'required',
        ]);

        $extensions = ['jpeg', 'jpg', 'png', 'gif'];
        $file = $request->file('imagen');

        if ( $file && $file instanceof UploadedFile) {
            if (!array_search($file->getClientOriginalExtension(), $extensions)) {
                return 'error';
            }
        }

        $senden_data->business_id = auth()->user()->business_id;
        $senden_data->status_id = 2;//Cambiar esta propiedad
        $senden_data->vehicle_id = $request->vehiculo_id;
        $senden_data->name = $request->nombre;
        $senden_data->descripcion = $request->descripcion;

        if ($request->file('imagen')) {
            $img = $request->file('imagen');
            $name = time().'.'.$img->getClientOriginalExtension();
            $img->move('senden_datas', $name);
            $path = 'senden_datas/'.$name;
            $senden_data->image = $path;
        }

        $senden_data->image = isset($path) ? $path : $request->imagen;

        $senden_data->price = $request->precio;
        $senden_data->stock = $request->stock;
        $senden_data->weight = $request->peso;
        $senden_data->lenght = $request->largo;
        $senden_data->height = $request->alto;
        $senden_data->width = $request->ancho;
        $senden_data->is_best_seller = $request->popular;
        $senden_data->in_promotion = $request->en_promocion;
        $senden_data->start_selling = $request->inicio_hora_venta;
        $senden_data->end_selling = $request->fin_hora_venta;
        $senden_data->save();

        return $senden_data;
    }

    /**
     * Destroy a single senden_data.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(senden_data $senden_data)
    {
        $senden_data->delete();

        return $senden_data;
    }

    /**
     * Destroy multiple senden_datas.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelections(Request $req)
    {
        return DB::table('senden_datas')
        ->whereIn('id', $req->ids)
        ->delete();
    }

    /**
     * Export the senden_datas that belongs to an ecommerce.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportsenden_datas()
    {
        return senden_data::exportsenden_datas();
    }

    /**
     * Export the senden_datas that belongs to an ecommerce.
     *
     * @return \Illuminate\Http\Response
     */
    public function importsenden_datas(Request $req)
    {
        return senden_data::importsenden_datas($req);
    }
}
