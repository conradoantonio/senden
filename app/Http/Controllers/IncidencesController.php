<?php

namespace App\Http\Controllers;

use App\Incidence;
use App\Solution;
use Illuminate\Http\Request;
use DB;

class IncidencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = auth()->user()->isBusinessAdmin() ? 'Mis incidencias' : 'Incidencias';
        $menu = 'Incidencias';
    	//$incidences = Incidence::all();
    	$incidences = DB::table('incidences')
			->leftJoin('solutions', 'solutions.id', '=', 'incidences.solution_id')
			->leftJoin('incidence_types', 'incidence_types.id', '=', 'incidences.incidence_type_id')
			->leftJoin('businesses', 'businesses.id', '=', 'incidences.business_id')
            ->select('incidences.*', 'solutions.name', 'businesses.tradename')
            ->where('solution_id','=','')
                ->orWhere(function($query){
                    $query->whereNull('solution_id');
                });
            auth()->user()->isBusinessAdmin() ? $incidences = $incidences->where('business_id', auth()->user()->business_id) : '';
        $incidences = $incidences->get();
    	if ($request->ajax()) {
            return view('admin.incidences.table', ['menu' => $menu, 'title' => $title, 'incidences' => $incidences]);
		} else {
			$solutions = Solution::all();
        	$tipo_incidencia = DB::table('incidence_types')->get();
            return view('admin.incidences.index', ['menu' => $menu, 'title' => $title, 'incidences' => $incidences, 'solutions' => $solutions, 'tipo_incidencia' => $tipo_incidencia]);
        }
        
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $incidence = DB::table('incidences')
            ->leftJoin('solutions', 'solutions.id', '=', 'incidences.solution_id')
            ->leftJoin('incidence_types', 'incidence_types.id', '=', 'incidences.incidence_type_id')
            ->leftJoin('businesses', 'businesses.id', '=', 'incidences.business_id')
            ->leftJoin('orders', 'incidences.order_id', '=', 'orders.id')
            ->leftJoin('order_details', 'order_details.order_id', '=', 'orders.id')
            ->leftJoin('sendenboys', 'sendenboys.id', '=', 'orders.sendenboy_id')
            ->leftJoin('users', 'sendenboys.user_id', '=', 'users.id')
            ->leftJoin('users as users2', 'orders.user_id', '=', 'users2.id')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->select('incidences.*', 'incidences.created_at AS fecha_creacion','solutions.name','incidence_types.name as tipo','orders.*', 'users.name as sendenboy','users.email as sb_email' , 'order_details.*','products.name as product', 'products.price', 'users2.name as cliente', 'businesses.name as negocio','businesses.rfc','businesses.street as bus_calle','businesses.ext_number as bus_numext','businesses.colony as bus_colonia','businesses.city as bus_ciudad','businesses.state as bus_estado')
            ->where('incidences.id', '=', $id)
            ->get();
        echo json_encode($incidence);
    }

    public function store(Request $request){
        DB::table('incidences')->insert([
            'business_id' => auth()->user()->business_id, 
            'order_number' => $request->order_number,
            'order_id' => $request->order_number,
            'description' => $request->description,
            'incidence_type_id' => $request->incidence_type_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		//
		//$incidence = Incidence::find($request->id);
		//print_r($incidence);
		//die;$incidence->solution_id = 2;
		//print_r($request);
		Incidence::where('id', $request->id)
          ->update([
                'solution_id' => $request->solution_id,
                'observations' => $request->observation,
            ]);
		//$incidence->save();
	}
}
