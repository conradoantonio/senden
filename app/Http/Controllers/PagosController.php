<?php

namespace App\Http\Controllers;

use App\Business;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\SendenBoy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PagosController extends Controller
{
	/**
     *=============================================================================================================================================
     *=                                      Empiezan las funciones relacionadas a los pagos de los negocios                                      =
     *=============================================================================================================================================
     */

    /**
     * @return Shows the view to filter the orders by the business.
     */
    public function pagar_negocios() 
    {
        $title = 'Pago a negocio';
        $menu = 'Pagos';
        $orders = Business::getBusinessOrderForPaid(0);
        $business_valid = Business::where('status', 1)->get();
        return view('admin.pagos.pagos_negocios', ['orders' => $orders, 'business_valid' => $business_valid, 'title' => $title, 'menu' => $menu]);
    }

    /**
     * @return Filter the orders of the businesses by the parameters.
     */
    public function filter_business_order(Request $req) 
    {
        $orders = Business::getBusinessOrderForPaid($req->is_paid_business, $req->business_id, $req->start_date, $req->end_date);
        return $orders;
    }

    /**
     * @return Mark as paid the sent orders.
     */
    public function mark_as_paid(Request $req) 
    {
    	Order::whereIn('id', $req->ids)
        ->update(['isPaidBusiness' => 1]);
        $orders = Business::getBusinessOrderForPaid(0, $req->business_id, $req->start_date, $req->end_date);
        return $orders;
    }

    /**
     * @return Get the main orders.
     */
    public function source(Request $req) 
    {
        $orders = Business::getBusinessOrderForPaid($req->is_paid_business);
    	return $orders;
    }
    
    /**
     * @return Shows the view with the history of orders paid to the businesses.
     */
    public function historial_pago_negocios() 
    {
        $title = 'Historial pago a negocios';
        $menu = 'Pagos';
        $orders = Business::getBusinessOrderForPaid(1);
        $business_valid = Business::where('status', 1)->get();
        return view('admin.pagos.historial_pago_negocios', ['orders' => $orders, 'business_valid' => $business_valid, 'title' => $title, 'menu' => $menu]);
    }

    /**
     *=============================================================================================================================================
     *=                                     Empiezan las funciones relacionadas a los pagos de los sendenboys                                     =
     *=============================================================================================================================================
     */

    /**
     * @return Shows the view to filter the orders by the sendenboy.
     */
    public function pagar_sendenboys() 
    {
        $title = 'Pago a sendenboy';
        $menu = 'Pagos';
        $orders = SendenBoy::getSendenboysOrderForPaid(0);
        $sendenboys_valid = SendenBoy::sendenboyByStatus(1);
        return view('admin.pagos.pagos_sendenboys', ['orders' => $orders, 'sendenboys_valid' => $sendenboys_valid, 'title' => $title, 'menu' => $menu]);
    }

    /**
     * @return Filter the orders of the sendenboy by the parameters.
     */
    public function filter_sendenboy_order(Request $req) 
    {
        $orders = SendenBoy::getSendenboysOrderForPaid($req->is_paid_sendenboy, $req->sendenboy_id, $req->start_date, $req->end_date);
        return $orders;
    }

    /**
     * @return Mark as paid the sent orders to the sendenboy.
     */
    public function mark_as_paid_sendenboy_orders(Request $req) 
    {
        Order::whereIn('id', $req->ids)
        ->update(['isPaidSendenboy' => 1]);
        $orders = SendenBoy::getSendenboysOrderForPaid(0, $req->sendenboy_id, $req->start_date, $req->end_date);
        return $orders;
    }

    /**
     * @return Get the main orders.
     */
    public function source_orders_sendenboy(Request $req) 
    {
        $orders = SendenBoy::getSendenboysOrderForPaid($req->is_paid_sendenboy);
        return $orders;
    }

    /**
     * @return Shows the view to filter the orders paid to the sendenboy.
     */
    public function historial_pago_sendenboys() 
    {
        $title = 'Historial pago a sendenboys';
        $menu = 'Pagos';
        $orders = SendenBoy::getSendenboysOrderForPaid(1);
        $sendenboys_valid = SendenBoy::sendenboyByStatus(1);
        return view('admin.pagos.historial_pago_sendenboys', ['orders' => $orders, 'sendenboys_valid' => $sendenboys_valid, 'title' => $title, 'menu' => $menu]);
    }

    /**
     *=============================================================================================================================================
     *=                              Empiezan las funciones relacionadas a poder ver los pedidos pagados por negocio                              =
     *=============================================================================================================================================
     */

    /**
     * @return Shows the view to filter the orders paid to the bisiness admin.
     */
    public function my_earnings() 
    {
        $title = $menu = 'Mis pagos';
        $paid_orders = Business::getBusinessOrderForPaid(1, auth()->user()->business_id);
        return view('admin.pagos.mis_pagos_negocio', ['orders' => $paid_orders, 'title' => $title, 'menu' => $menu]);
    }

    /**
     * @return Shows the details of a order.
     */
    public function order_details(Request $req) 
    {
        return Order::orderCompleteData($req->status, $req->orden_id);
    }

    /**
     * @return Export the paid orders of the business.
     */
    public function export_orders(Request $req) 
    {
        return $orders_details;
    }
}
