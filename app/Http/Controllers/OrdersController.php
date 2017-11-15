<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use DB;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $menu = $title = 'Pedidos Activos';
        $businessId = auth()->user()->isSendenAdmin() ? 0 : auth()->user()->business_id;
        $orders = DB::select('call sp_ordersget(0, '.$businessId.')');
        //return $orders;
        return view('admin.orders.index', ['menu' => $menu, 'title' => $title, 'orders' => $orders]);
    }

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

    public function reloadOrdersTable()
    {
        $businessId = auth()->user()->isSendenAdmin() ? 0 : auth()->user()->business_id;
        $orders = DB::select('call sp_ordersget(0, '.$businessId.')');
        return $orders;
    }

    public function cancelOrder(Request $request) 
    {
        $order = Order::find($request->order_id);

        if ($order) {
            $order->status_id = 6;
            $order->save();

            return ['msg' => 'Cancelled'];
        }
        return ['msg' => 'This order can not be cancelled'];
    }
}
