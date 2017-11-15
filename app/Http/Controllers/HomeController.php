<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Business;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Input;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /*
    * Show the user's and business's profile
    */
    public function profile(){
        $title = $menu = 'Mi perfil';
        $user_data = DB::table('users')
        ->join('user_types', 'user_types.id', '=', 'users.user_type_id')
        ->join('businesses', 'businesses.id', '=', 'users.business_id')
        ->join('business_details', 'business_details.business_id', '=', 'businesses.id', 'left')
        ->select('users.id as idUser', 'users.name', 'users.email', 'users.photo', 'user_types.name as type_name', 'businesses.id as idBusiness', 
        'businesses.contract_number', 'businesses.name as business_name', 'businesses.street', 'businesses.colony', 'businesses.city', 'businesses.state',
        'businesses.phone', 'businesses.ext_number', 'businesses.postal_code', 'businesses.isOpen', 'businesses.created_at')
        ->where('users.id', '=', auth()->user()->id)
        ->first();
        return view('admin.profile.profile', compact('user_data', 'title', 'menu'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $title = $menu = 'Inicio';
        if (auth()->user()->user_type_id == 1) { 
            $dashboard = $this->dashboardAdminData();
            $ventas_semanales = $this->getWeeklySales();
        } else if (auth()->user()->user_type_id == 3 || auth()->user()->user_type_id == 4) { 
            $dashboard = $this->dashboardBusinessData();
            $ventas_semanales = $this->getWeeklySales(auth()->user()->business_id);
        }
        return view('admin.dashboard.dashboard', ['title' => $title, 'menu' => $menu, 'ventas_semanales' => $ventas_semanales, 'dashboard' => json_decode($dashboard)]);
    }

    /**
     * @return The total of app users, banned app users, bussinesses.
     */
    public function dashboardAdminData() {
        $main_data = new \stdClass();

        $main_data->orders_done = Order::countOrdersDone();
        $main_data->orders_in_progress = Order::countOrdersInProgress();
        $main_data->orders_rejected = Order::countOrdersRejected();
        $main_data->products_active = Product::countActiveProducts();
        $main_data->products_rejected = Product::countRejectedProducts();
        $main_data->products_pending = Product::countPendingProducts();
        $main_data->users_app_sendenshop = User::countSendenshopUsers();
        $main_data->users_app_sendenboy = User::countSendenboyUsers();
        $main_data->users_sys_businesses = User::countBusinessesUsers();

        /*$main_data->banned_app_users = User::countBannedUsers();*/
        $main_data->total_bussinesses = Business::countBusinesses();
        $main_data->total_sales = round(Order::totalSales(), 2, PHP_ROUND_HALF_DOWN);

        return json_encode($main_data);
    }

    /**
     * @return The total of app users, banned app users, bussinesses.
     */
    public function dashboardBusinessData() {
        $business_id = auth()->user()->business_id;
        
        $main_data = new \stdClass();

        $main_data->orders_done = Order::countOrdersDoneBy($business_id);
        $main_data->orders_in_progress = Order::countOrdersInProgressBy($business_id);
        $main_data->orders_rejected = Order::countOrdersRejectedBy($business_id);
        $main_data->my_users_business = User::countUsersBusinesssBy($business_id);
        $main_data->my_users_sales = User::countUsersSalesBy($business_id);
        $main_data->products_active = Product::countActiveProducts($business_id);
        $main_data->products_rejected = Product::countRejectedProducts($business_id);
        $main_data->products_pending = Product::countPendingProducts($business_id);
        $main_data->total_sales_business = round(Order::totalSales($business_id), 2, PHP_ROUND_HALF_DOWN);

        return json_encode($main_data);
    }

    /**
     * @return Save the image.
     */
    public function done(Request $req) {
        $data = Input::all();
        if (Input::hasFile('foto_producto')) {
            $foto = $data['foto_producto'];
            $foto_nombre = time().'.'.$foto->getClientOriginalExtension();
            $foto->move('img', $foto_nombre);
            $foto_path = 'img/'.$foto_nombre;
            //dd($foto_path);
        }
    }

    /**
     * @return The total of sales weekly.
     */
    public function getWeeklySales($business_id = false) 
    {
        $dias_s = array('','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');

        date_default_timezone_set('America/Mexico_City');//Esto fue puesto para obtener corectamente la hora en local, remover si es necesario

        $query = Order::weeklySales($business_id);

        $semana = array();
        $dia_nombre = array();
        for ($i=1; $i <= 7; $i++) {
            $fechaActual = date("Y-m-d");
            $fechaActual = date_create($fechaActual);
            $fechaActual = date_sub($fechaActual, date_interval_create_from_date_string($i.' days'));
            array_push($semana, $fechaActual->format('Y-m-d'));
        }

        foreach ($semana as $dia) {
            array_push($dia_nombre, $dias_s[date('N', strtotime($dia))]);
        }

        $array_wd = array();
        foreach ($query as $value) {
            array_push($array_wd, $value->created_at);
        }

        $numero_logs = array();
        foreach ($query as $value) {
            array_push($numero_logs, round($value->Costo_total, 2));
        }
        
        $final_array = $semana;

        foreach ($final_array as $key => $value) { $final_array[$key] = 0; }

        foreach ($array_wd as $key => $val) {
            $numero_logs[$key];
            $pasa = array_search($val, $semana);
            if (is_int($pasa)) {
                $final_array[$pasa] = $numero_logs[$key];
            } 
        }

        $object = new \stdClass();
        $object->dias_semana = array_reverse($dia_nombre);
        $object->total_ventas = array_reverse($final_array);

        return json_encode($object);
    }

    /**
     *============================================================================================================================================
     *=                                    Empiezan las funciones relacionadas a la información de la empresa                                    =
     *============================================================================================================================================
     */

    /**
     * Load th information enterprise of senden, only sendenadmin can change this.
     *
     * @return \Illuminate\Http\Response
     */
    public function info_enterprise()
    {
        if (auth()->check()) {
            $title = 'Información senden';
            $menu = 'Configuraciones';
            $datos = DB::table('informationenterprise')->first();
            $header = count($datos) > 0 ? 'Editar' : 'Guardar';
            return view('admin.profile.info_enterprise', ['title' => $title, 'menu' => $menu, 'datos' => $datos, 'header' => $header]);
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Save the senden enterprise information
     *
     * @return \Illuminate\Http\Response
     */
    public function save_info_enterprise(Request $request)
    {
        $file_path = "default.jpg";
        if ($request->file('logotype')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $request->file('logotype')->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $file = $request->file('logotype');
                $file_name = 'senden_logo'.'.'.$extension_archivo;
                $file->move('img/senden', $file_name);
                $file_path = 'img/senden/'.$file_name;
            }
        }

        DB::table('informationenterprise')->insert(
            ['name' => $request->name, 
             'description' => $request->description,
             'phoneNumber' => $request->phoneNumber,
             'latitude' => $request->latitude,
             'longitude' => $request->longitude,
             'address' => $request->address,
             'logotype' => $file_path,
             'email' => $request->email]
        );
        return back();
    }

    /**
     * Update the senden enterprise information
     *
     * @return \Illuminate\Http\Response
     */
    public function update_info_enterprise(Request $request)
    {
        $file_path = "default.jpg";
        if ($request->file('logotype')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $request->file('logotype')->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $file = $request->file('logotype');
                $file_name = 'senden_logo'.'.'.$extension_archivo;
                $file->move('img/senden', $file_name);
                $file_path = 'img/senden/'.$file_name;
            }
        }

        $actualizar = [ 'name' => $request->name, 
                        'description' => $request->description,
                        'phoneNumber' => $request->phoneNumber,
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                        'address' => $request->address,
                        'email' => $request->email]; 

        $file_path != "default.jpg" ? $actualizar += array('logotype' => $file_path): '';
        
        DB::table('informationenterprise')
        ->where('id', $request->id)
        ->update($actualizar);
        return back();
    }
}
