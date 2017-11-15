<?php

namespace App\Http\Controllers;

use DB;
use App\OrderDetail;
use Illuminate\Http\Request;

class LiberarPedidosController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $pedido_id = null)
    {
        //
    	$menu = $title = 'Liberar Pedidos';
        if ( $request->ajax() ) {
        	$orders = DB::table('orders as o')
				->leftJoin('businesses as b','b.id','=','o.business_id')
				->leftJoin('categories as c','c.id','=','b.category_id')
				->leftJoin('sendenboys as s','s.id','=','o.sendenboy_id')
				->leftJoin('users as u','u.id','=','s.user_id')
				->whereNotIn('o.status_id',[6,7])
				->where('o.id',$pedido_id)
				->select('o.id as order_id', 'o.order_number', 'o.comment', 'b.name as business_name', 'c.name as categorie_name' ,'o.sendenboy_id', 'o.created_at as order_date', 'u.name AS sendenboy')
				->get();
        	return view('admin.liberarPedidos.table', ['orders' => $orders]);
        } else {
        	$orders = [];
        	return view('admin.liberarPedidos.index', ['menu' => $menu, 'title' => $title, 'orders' => $orders]);
        }
    }

    public function getData(Request $request){
    	
		return $orders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderDetails(Request $request)
    {
        try{
            if($request->ajax()){
                $get = $request->input();
                $orderDetails = DB::select('call sp_ordersget('.$get["orderId"].', 0)');
                $orderProducts = OrderDetail::with('product')->where('order_id', $get["orderId"])->get();
                return response()->json(['success' => true, 'msg' => 'Petición realizada con éxito.', 
                'orderDetails' => $orderDetails, 'orderProducts' => $orderProducts]);
            }
        }
        catch(Exception $e){
            return response()->json(['success' => false, 'msg' => 'Ocurrió un problema, favor de volver a intentarlo.']);
        }
        
    }
}
