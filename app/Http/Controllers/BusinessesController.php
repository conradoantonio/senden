<?php

namespace App\Http\Controllers;

use App\Business;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use DB;

class BusinessesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $businesses = Business::where('status', 1)->get();

        $menu = $title = 'Negocios';

        if ($req->ajax()){
            return view('admin.businesses.table', ['businesses' => $businesses]);
        } else {
            return view('admin.businesses.index', ['businesses' => $businesses, 'menu' => $menu, 'title' => $title]);    
        }
        
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexData()
    {
        $businesses = Business::where('status', 1)->get();
        return ['businesses' => $businesses];
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	/*$this->validate($request, [
            'categoria' => 'required|numeric',
            'NombreComercial' => 'required|min:3',
            'RazonSocial' => 'required|min:3',
            'rfc' => 'required|min:13|max:13',
            'calle' => 'required|min:3',
            'NumeroExterior' => 'required|numeric',
            'NumeroInterior' => 'nullable|numeric',
            'cp' => 'required|min:5|max:5',
            'longitud' => 'required|min:3',
            'latitud' => 'required|min:3',
            'colonia' => 'required|min:3',
            'ciudad' => 'required|min:3',
            'estado' => 'required|min:3',
            'telefono' => 'required|min:3',
            'logo' => 'required|image',
            'foto1' => 'required|image',
            'foto2' => 'nullable|image',
        ]);*/
        $data = Input::all();

        $business = new Business();
        $business->category_id = $data['categoria'];
        $business->tradename = $data['RazonSocial'];
        $business->name = $data['NombreComercial'];
        $business->rfc = $data['rfc'];
        $business->description = $data['descripcion'];
        $business->street = $data['calle'];
        $business->ext_number = $data['NumeroExterior'];
        $business->int_number = $data['NumeroInterior'];
        $business->postal_code = $data['cp'];
        $business->latitude = $data['latitud'];
        $business->longitude = $data['longitud'];
        $business->colony = $data['colonia'];
        $business->city = $data['ciudad'];
        $business->state = $data['estado'];
        $business->phone = $data['telefono'];
        $business->clabe = $data['clabe'];
        $business->bank_name = $data['bank_name'];
        
        $business->semana_inicio = $data['semana_inicio'];
        $business->semana_fin = $data['semana_fin'];
        $business->semana_com_inicio = $data['semana_com_inicio'];
        $business->semana_com_fin = $data['semana_com_fin'];

        $business->sabado_inicio = $data['sabado_inicio'];
        $business->sabado_fin = $data['sabado_fin'];
        $business->sabado_com_inicio = $data['sabado_com_inicio'];
        $business->sabado_com_fin = $data['sabado_com_fin'];

        $business->domingo_inicio = $data['domingo_inicio'];
        $business->domingo_fin = $data['domingo_fin'];
        $business->domingo_com_inicio = $data['domingo_com_inicio'];
        $business->domingo_com_fin = $data['domingo_com_fin'];

        $business->contract_number = $data['contract_number'];

        $business->status = 1;

        $business->save();

        $folder = $business->id;
        
        Business::find($business->id);

        if (Input::hasFile('logo')) {
            $logo = $data['logo'];
            $logo_nombre = 'logo'.'.'.$logo->getClientOriginalExtension();
            $logo->move('businesses/'.$folder, $logo_nombre);
            $logo_path = 'businesses/'.$folder.'/'.$logo_nombre;
            $business->logo = $logo_path;
        }
        if (Input::hasFile('photo1')) {
            $photo1 = $data['photo1'];
            $photo1_nombre = 'photo1'.'.'.$photo1->getClientOriginalExtension();
            $photo1->move('businesses/'.$folder, $photo1_nombre);
            $photo1_path = 'businesses/'.$folder.'/'.$photo1_nombre;
            $business->photo1 = $photo1_path;
        }
        if (Input::hasFile('photo2')) {
            $photo2 = $data['photo2'];
            $photo2_nombre = 'photo2'.'.'.$photo2->getClientOriginalExtension();
            $photo2->move('businesses/'.$folder, $photo2_nombre);
            $photo2_path = 'businesses/'.$folder.'/'.$photo2_nombre;
            $business->photo2 = $photo2_path;
        }
        if (Input::hasFile('contract')) {
            $contrato = $data['contract'];
            $contrato_nombre = 'contract'.'.'.$contrato->getClientOriginalExtension();
            $contrato->move('businesses/'.$folder, $contrato_nombre);
            $contrato_path = 'businesses/'.$folder.'/'.$contrato_nombre;
            $business->contract = $contrato_path;
        }

        if ($business->save()) {
            return redirect('admin/businesses');
        } else {
            $categories = Category::all();
            return view('admin.businesses.create', ['categories' => $categories]);
        } 
    }

    public function create() {
        $menu = 'Negocios';
        $title = 'Crear negocio';
		$categories = Category::all();
    	return view('admin.businesses.create', ['menu' => $menu, 'title' => $title, 'categories' => $categories]);
    }

    public function edit($id) {
        $menu = 'Negocios';
        $title = 'Editar negocio';
    	$business = Business::find($id);
        $categories = Category::all();

    	return view('admin.businesses.update', ['menu' => $menu, 'title' => $title, 'business' => $business,'categories' => $categories]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        /*$this->validate($request, [
            'categoria' => 'required|numeric',
            'NombreComercial' => 'required|min:3',
            'RazonSocial' => 'required|min:3',
            'rfc' => 'required|min:13|max:13',
            'calle' => 'required|min:3',
            'NumeroExterior' => 'required|numeric',
            'NumeroInterior' => 'nullable',
            'cp' => 'required|min:5|max:5',
            'longitud' => 'required',
            'latitud' => 'required',
            'colonia' => 'required|min:3',
            'ciudad' => 'required|min:3',
            'estado' => 'required|min:3',
            'telefono' => 'required|min:3',
        ]);*/

        $data = Input::all();

        $business = Business::find($data['id']);

        $business->category_id = $data['categoria'];
        $business->name = $data['NombreComercial'];
        $business->tradename = $data['RazonSocial'];
        $business->rfc = $data['rfc'];
        $business->description = $data['descripcion'];
        $business->street = $data['calle'];
        $business->ext_number = $data['NumeroExterior'];
        $business->int_number = $data['NumeroInterior'];
        $business->postal_code = $data['cp'];
        $business->latitude = $data['latitud'];
        $business->longitude = $data['longitud'];
        $business->colony = $data['colonia'];
        $business->city = $data['ciudad'];
        $business->state = $data['estado'];
        $business->phone = $data['telefono'];
        $business->clabe = $data['clabe'];
        $business->bank_name = $data['bank_name'];

        $business->semana_inicio = $data['semana_inicio'];
        $business->semana_fin = $data['semana_fin'];
        $business->semana_com_inicio = $data['semana_com_inicio'];
        $business->semana_com_fin = $data['semana_com_fin'];

        $business->sabado_inicio = $data['sabado_inicio'];
        $business->sabado_fin = $data['sabado_fin'];
        $business->sabado_com_inicio = $data['sabado_com_inicio'];
        $business->sabado_com_fin = $data['sabado_com_fin'];

        $business->domingo_inicio = $data['domingo_inicio'];
        $business->domingo_fin = $data['domingo_fin'];
        $business->domingo_com_inicio = $data['domingo_com_inicio'];
        $business->domingo_com_fin = $data['domingo_com_fin'];
        $business->contract_number = $data['contract_number'];

        $business->save();

        $folder = $business->id;
        
        Business::find($business->id);

        if (Input::hasFile('logo')) {
            $logo = $data['logo'];
            $logo_nombre = 'logo'.'.'.$logo->getClientOriginalExtension();
            $logo->move('businesses/'.$folder, $logo_nombre);
            $logo_path = 'businesses/'.$folder.'/'.$logo_nombre;
            $business->logo = $logo_path;
        }
        if (Input::hasFile('photo1')) {
            $photo1 = $data['photo1'];
            $photo1_nombre = 'photo1'.'.'.$photo1->getClientOriginalExtension();
            $photo1->move('businesses/'.$folder, $photo1_nombre);
            $photo1_path = 'businesses/'.$folder.'/'.$photo1_nombre;
            $business->photo1 = $photo1_path;
        }
        if (Input::hasFile('photo2')) {
            $photo2 = $data['photo2'];
            $photo2_nombre = 'photo2'.'.'.$photo2->getClientOriginalExtension();
            $photo2->move('businesses/'.$folder, $photo2_nombre);
            $photo2_path = 'businesses/'.$folder.'/'.$photo2_nombre;
            $business->photo2 = $photo2_path;
        }
        if (Input::hasFile('contract')) {
            $contrato = $data['contract'];
            $contrato_nombre = 'contract'.'.'.$contrato->getClientOriginalExtension();
            $contrato->move('businesses/'.$folder, $contrato_nombre);
            $contrato_path = 'businesses/'.$folder.'/'.$contrato_nombre;
            $business->contract = $contrato_path;
        }

        if ($business->save()){
            return redirect('admin/businesses');
        } else {
            $this->edit();
        }
        return $business;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        /*$business->delete();
        return $business;*/
        $business->status = 0;
        $business->isOpen = 0;
        return $business;
    }


    /**
     * Destroy multiple businesses.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelections(Request $req)
    {
        return DB::table('businesses')
            ->whereIn('id', $req->ids)
            ->update(['status' => 0, 'isOpen' => 0]);
            /*->delete();*/
    }
    
    /**
     * Decides if a business is open or closed.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request){
    	Business::where('id', $request->id)
          ->update(['isOpen' => $request->status]);
    }
}
