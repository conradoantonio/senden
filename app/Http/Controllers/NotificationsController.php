<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\TokenUser;
use Auth;
use Redirect;

class NotificationsController  extends Controller
{
    function __construct() {
        date_default_timezone_set('America/Mexico_City');
        $this->summer = date('I');
        $this->app_sendenshop_id = "0dfee29c-adf1-404b-b736-d3779d53b1de";
        $this->app_sendenboy_id = "9fb67f38-3604-4550-b299-39a353effc25";
        $this->app_sendenshop_key = "Mjk0MjAwYmYtNmQyNC00MzNkLWIzMjItZjFjNTBiZjY1MTNi";
        $this->app_sendenboy_key = "YjllYzIxNmUtNTZhZS00MGEwLWE0ZjktNjc3YjMxMzY3MDRh";
        $this->app_sendenshop_icon = asset('img/icon_notifications/sendenshop200x200.png');
        $this->app_sendenboy_icon = asset('img/icon_notifications/sendenboy200x200.png');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Notificaciones App';
        $menu = 'Ionic';
        $actual_date = date('Y-m-d');
        $clientes = User::where('user_type_id', 5)->where('status', 1)->whereHas('tokens')->get();
        $repartidores = User::where('user_type_id', 2)->where('status', 1)->whereHas('tokens')->get();
        return view('admin.notifications.index', ['menu' => $menu, 'title' => $title, 'clientes' => $clientes, 'repartidores' => $repartidores, 'start_date' => $actual_date]);
    }

    /**
    * Envía una notificación a todos los usuarios de la aplicación
    * @return $response
    */
    public function enviar_notificacion_general(Request $req) 
    {
        $mensaje = $req->mensaje;
        $titulo = $req->titulo;
        $dia = $req->fecha;
        $hora = $req->hora;
        $app_id = $req->aplicacion == 1 ? $this->app_sendenshop_id : $this->app_sendenboy_id;
        $app_key = $req->aplicacion == 1 ? $this->app_sendenshop_key : $this->app_sendenboy_key;
        $icon = $req->aplicacion == 1 ? $this->app_sendenshop_icon : $this->app_sendenboy_icon;
        $content = array(
            "en" => $mensaje
        );

        $header = array(
            "en" => $titulo
        );
        
        $fields = array(
            'app_id' => $app_id,
            'included_segments' => array('All'),
            'data' => array("type" => "general"),
            'headings' => $header,
            'contents' => $content,
            'large_icon' => $icon
        );

        if ($dia && $hora) {
            $time_zone = $dia.' '.$hora;
            $time_zone = $this->summer ? $time_zone.' '.'UTC-0500' : $time_zone.' '.'UTC-0600';
            $fields['send_after'] = $time_zone;
        }
        
        $fields = json_encode($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   "Authorization: Basic $app_key"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }

    /**
    * Envía una notificación a todos los usuarios de la aplicación
    * @return $response
    */
    public function enviar_notificacion_individual(Request $req) 
    {
        $player_ids = array();
        foreach($req->usuarios_id as $id) {
            $tokens = 
            $user = User::with('tokens')->where('id', $id)->first();
            foreach ($user->tokens as $row) {
                $player_ids [] = $row->token;
            }
        }

        $mensaje = $req->mensaje;
        $titulo = $req->titulo;
        $dia = $req->fecha;
        $hora = $req->hora;
        $app_id = $req->aplicacion == 1 ? $this->app_sendenshop_id : $this->app_sendenboy_id;
        $app_key = $req->aplicacion == 1 ? $this->app_sendenshop_key : $this->app_sendenboy_key;
        $icon = $req->aplicacion == 1 ? $this->app_sendenshop_icon : $this->app_sendenboy_icon;

        $content = array(
            "en" => $mensaje
        );

        $header = array(
            "en" => $titulo
        );
        
        $fields = array(
            'app_id' => $app_id,
            'include_player_ids' => $player_ids,
            'data' => array('type' => 'individual'),
            'headings' => $header,
            'contents' => $content,
            'large_icon' => $icon
        );

        if ($dia && $hora) {
            $time_zone = $dia.' '.$hora;
            $time_zone = $this->summer ? $time_zone.' '.'UTC-0500' : $time_zone.' '.'UTC-0600';
            $fields['send_after'] = $time_zone;
        }

        $fields = json_encode($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   "Authorization: Basic $app_key"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
}
