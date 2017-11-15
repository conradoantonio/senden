<?php

namespace App\Http\Controllers;

use App\Order;
use App\DoneOrder;
use App\Business;
use Illuminate\Http\Request;
use DB;
use Excel, File;

class DoneOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu = $title = 'Pedidos finalizados';
        if (auth()->user()->isSendenAdmin()) {
            $orders = Order::orderCompleteData(5);
        } else {
            $orders = Order::orderCompleteData(5, false, auth()->user()->business_id);
        }
        $businesses = Business::all();
        return view('admin.done.index', ['title' => $title, 'menu' => $menu, 'orders' => $orders, 'businesses' => $businesses]);

		/*if ($request->ajax()) {
			return view('admin.done.table', ['orders' => $orders]);
		} else {
            $businesses = Business::all();
			return view('admin.done.index', ['title' => $title, 'menu' => $menu, 'orders' => $orders, 'businesses' => $businesses]);
		}*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::orderCompleteData(5, $id);
        /*$orders = DB::table('orders')
        ->leftJoin('order_details', 'order_details.order_id', '=', 'orders.id')
        ->leftJoin('sendenboys', 'sendenboys.id', '=', 'orders.sendenboy_id')
        ->leftJoin('users', 'sendenboys.user_id', '=', 'users.id')#Sendenboy
        ->leftJoin('users as users2', 'orders.user_id', '=', 'users2.id')#Cliente
        ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
        ->leftJoin('businesses', 'businesses.id', '=', 'orders.business_id')
        ->leftJoin('tkey', 'tkey.order_id', '=', 'orders.id')
        ->where('orders.id', '=', $id)
        ->select(DB::raw('orders.*, orders.created_at as order_date, tkey.akey as order_number_g, users.name as sendenboy, users.email as sb_email, users.phoneNumber as sb_numero, 
            order_details.quantity as product_quantity, order_details.price as product_price, order_details.subtotal as product_subtotal, products.name as product, products.price, 
            products.description AS product_description, sendenboys.id as sb_no, users2.id as cliente_id, users2.name as cliente, 
            users2.email as cliente_email, users2.municipality as cliente_municipio, 
            users2.phoneNumber as cliente_numero, businesses.name as negocio, businesses.rfc, businesses.street as bus_calle, 
            businesses.ext_number as bus_numext, businesses.colony as bus_colonia, businesses.city as bus_ciudad, businesses.state as bus_estado,
            CONCAT(
                IFNULL(users2.street, ""),
                IF(users2.ext_number, " #", ""),
                IFNULL(users2.ext_number, ""),
                IF(users2.int_number, " INT. #", ""),
                IFNULL(users2.int_number, ""),", ",
                IFNULL(users2.colony, ""),
                IF(users2.postal_code, " C.P. ", ""),
                IFNULL(users2.postal_code, "")
            ) AS client_address
        '))
        ->get();
        return $orders;*/
    }
    
    public function export($business_id = false, $sendenboy_id = false, $start_date = false, $end_date = false, $is_paid_business = false, $is_paid_sendenboy = false) 
    {
        //dd($business_id, $start_date, $end_date, $is_paid_business, $is_paid_sendenboy);
        $query = Order::leftJoin('sendenboys', 'sendenboys.id', '=', 'orders.sendenboy_id')
        ->leftJoin('users', 'sendenboys.user_id', '=', 'users.id')/*Sendenboy*/
        ->leftJoin('users as users2', 'orders.user_id', '=', 'users2.id')/*Cliente*/
        ->leftJoin('businesses', 'businesses.id', '=', 'orders.business_id')
        ->leftJoin('tkey', 'tkey.order_id', '=', 'orders.id')
        /*->leftJoin('users', 'sendenboys.user_id', '=', 'users.id')
        ->leftJoin('users as users2', 'orders.user_id', '=', 'users2.id')
        ->leftJoin('businesses', 'businesses.id', '=', 'orders.business_id')*/
        ->where('orders.status_id', 5)
        ->select(DB::raw('orders.id as Id, orders.conekta_order_id, tkey.akey as "Número orden", users.name as Sendenboy, users2.name as Cliente, 
            businesses.id as "Id negocio", businesses.name as Negocio, orders.real_time as "Fecha creación", 
            TRUNCATE((initialFee + kmFee), 2) AS subtotal_sendenboy, TRUNCATE((distance/100),2) AS "Distancia KM", kmFee AS "Distancia $", orders.total AS "Total $"'));
        
        $query = $business_id != 'false' ? $query->where('orders.business_id', $business_id) : $query;
        
        $query = $sendenboy_id != 'false' ? $query->where('sendenboys.id', $sendenboy_id) : $query;

        $query = $start_date != 'false' ? $query->where(DB::raw('TIMESTAMP(orders.real_time)'), '>=', $start_date.' 00:00:00') : $query;
        
        $query = $end_date != 'false' ? $query->where(DB::raw('TIMESTAMP(orders.real_time)'), '<=', $end_date.' 23:59:59') : $query;
        
        $query = $is_paid_business != 'false' ? $query->where('orders.isPaidBusiness', $is_paid_business) : $query;

        $query = $is_paid_sendenboy != 'false' ? $query->where('orders.isPaidSendenboy', $is_paid_sendenboy) : $query;
            
        $query = $query->get();

        foreach ($query as $key => $order) {
            //$order->subtotal = DB::table('order_details')->where('order_id', $order->id)->sum(DB::raw('subtotal'));
            $order->subtotal_negocio = DB::table('order_details')->where('order_id', $order->Id)->sum(DB::raw('quantity * price'));
        }
        //return $query;

        $excel = Excel::create('Ordenes finalizadas', function($excel) use($query) {
            $excel->sheet('Hoja 1', function($sheet) use($query) {
                $sheet->cells('A:M', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                
                $sheet->cells('A1:M1', function($cells) {
                    $cells->setFontWeight('bold');
                });

                $sheet->fromArray($query);
            });
        })->export('xlsx');

        return $excel;
        /*incluir excel!!*/
    }

}