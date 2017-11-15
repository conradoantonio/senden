<?php

namespace App\Http\Controllers;

use App\SendenBoy;
use App\User;
use App\UserType;
use App\Vehicle;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SendenboysController extends Controller
{
    /**
     * @return The sendenboy's table.
     */
    public function index() {
        $menu = $title = 'Sendenboys';
        $sendenboys = Sendenboy::getSendenboys();
        //return $sendenboys;
        return view('admin.sendenboy.index', ['sendenboys' => $sendenboys, 'title' => $title, 'menu' => $menu]);
    }

    /**
     * @return The sendenboy's form.
     */
    public function form($sendenboy_id = 0) {
        $menu = 'Sendenboys';
        $sendenboy = Sendenboy::getSendenboyData($sendenboy_id);
        $title = $sendenboy ? 'Editar sendenboy' : 'Registrar sendenboy';

        $vehicles = Vehicle::all();
        return view('admin.sendenboy.formularioSendenboy', ['sendenboy' => $sendenboy, 'vehicles' => $vehicles, 'title' => $title, 'menu' => $menu]);
    }

    /**
     * @return Store a new sendenboy.
     */
    public function store(Request $request)
    {
        $data = Input::all();

        $mail_valido = User::searchUserByEmail($data['email_sendenboy']);
        if (count($mail_valido) > 0) {
            return redirect()->action('SendenboysController@index', ['valido' => md5('false')]);
        }

        $username_valido = User::searchUserByUsername($data['username_sendenboy']);
        if (count($username_valido) > 0) {
            return redirect()->action('SendenboysController@index', ['valido' => md5('false')]);
        }

        /*Creación del usuario del sendenboy*/
        $user = new User();

        $user->name = $data['nombre_sendenboy'];
        $user->surname = $data['apellido_sendenboy'];
        $user->user_type_id = 2;
        $user->username = $data['username_sendenboy'];
        $user->email = $data['email_sendenboy'];
        $user->password = bcrypt($data['password_sendenboy']);
        $user->user_password = $data['password_sendenboy'];
        $user->street = $data['calle_sendenboy'];
        $user->ext_number = $data['ext_number_sendenboy'];
        $user->int_number = $data['int_number_sendenboy'];
        $user->colony = $data['colonia_sendenboy'];
        $user->municipality = $data['municipio_sendenboy'];
        $user->state = $data['estado_sendenboy'];
        $user->postal_code = $data['codigo_postal_sendenboy'];
        $user->phoneNumber = $data['telefono_sendenboy'];
        $user->isPanelUser = 0;

        $user->save();

        /*Creación de los detalles del sendenboy*/
        $sendenboy = new SendenBoy();

        $sendenboy->user_id = $user->id;
        $sendenboy->vehicle_id = $data['vehiculo_id'];
        $sendenboy->plate_number = $data['placa_vehiculo_sendenboy'];
        $sendenboy->bank = $data['banco_sendenboy'];
        $sendenboy->clabe = $data['clabe_sendenboy'];
        $sendenboy->inLine = 0;

        if (Input::hasFile('insurance_policy')) {
            $file = $data['insurance_policy'];
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move('sendenboys/insurance_policy/'.$user->id, $file_name);
            $file_path = 'sendenboys/insurance_policy/'.$user->id.'/'.$file_name;
            $sendenboy->insurance_policy = $file_path;
        }

        if (Input::hasFile('circulation_card')) {
            $file = $data['circulation_card'];
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move('sendenboys/circulation_card/'.$user->id, $file_name);
            $file_path = 'sendenboys/circulation_card/'.$user->id.'/'.$file_name;
            $sendenboy->circulation_card = $file_path;
        }

        if (Input::hasFile('license')) {
            $file = $data['license'];
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move('sendenboys/license/'.$user->id, $file_name);
            $file_path = 'sendenboys/license/'.$user->id.'/'.$file_name;
            $sendenboy->license = $file_path;
        }

        if (Input::hasFile('driver_photo')) {
            $file = $data['driver_photo'];
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move('sendenboys/driver_photo/'.$user->id, $file_name);
            $file_path = 'sendenboys/driver_photo/'.$user->id.'/'.$file_name;
            $sendenboy->driver_photo = $file_path;
        }

        if (Input::hasFile('vehicle_photo')) {
            $file = $data['vehicle_photo'];
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move('sendenboys/vehicle_photo/'.$user->id, $file_name);
            $file_path = 'sendenboys/vehicle_photo/'.$user->id.'/'.$file_name;
            $sendenboy->vehicle_photo = $file_path;
        }

        $sendenboy->save();
        return redirect()->to('/admin/sendenboys');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Input::all();

        $email_valido = User::searchUserByEmail($data['email_sendenboy'], $data['email_sendenboy_old']);
        if (count($email_valido) > 0) {
            return redirect()->action('SendenboysController@index', ['valido' => md5('false')]);
        }

        $username_valido = User::searchUserByUsername($data['username_sendenboy'], $data['username_sendenboy_old']);
        if (count($username_valido) > 0) {
            return redirect()->action('SendenboysController@index', ['valido' => md5('false')]);
        }

        /*Actualiza los datos del usuario del sendenboy*/
        $user = User::find($data['user_id']);

        if ($user) {
            $user->name = $data['nombre_sendenboy'];
            $user->surname = $data['apellido_sendenboy'];
            $user->username = $data['username_sendenboy'];
            $user->password = bcrypt($data['password_sendenboy']);
            $user->user_password = $data['password_sendenboy'];
            $user->street = $data['calle_sendenboy'];
            $user->ext_number = $data['ext_number_sendenboy'];
            $user->int_number = $data['int_number_sendenboy'];
            $user->colony = $data['colonia_sendenboy'];
            $user->municipality = $data['municipio_sendenboy'];
            $user->state = $data['estado_sendenboy'];
            $user->postal_code = $data['codigo_postal_sendenboy'];
            $user->phoneNumber = $data['telefono_sendenboy'];

            $user->save();
        }

        /*Actualiza los detalles del sendenboy*/
        $sendenboy = SendenBoy::find($data['sendenboy_id']);

        if ($sendenboy) {
            $sendenboy->user_id = $user->id;
            $sendenboy->vehicle_id = $data['vehiculo_id'];
            $sendenboy->plate_number = $data['placa_vehiculo_sendenboy'];
            $sendenboy->bank = $data['banco_sendenboy'];
            $sendenboy->clabe = $data['clabe_sendenboy'];

            if (Input::hasFile('insurance_policy')) {
                $file = $data['insurance_policy'];
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $file->move('sendenboys/insurance_policy/'.$user->id, $file_name);
                $file_path = 'sendenboys/insurance_policy/'.$user->id.'/'.$file_name;
                $sendenboy->insurance_policy = $file_path;
            }

            if (Input::hasFile('circulation_card')) {
                $file = $data['circulation_card'];
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $file->move('sendenboys/circulation_card/'.$user->id, $file_name);
                $file_path = 'sendenboys/circulation_card/'.$user->id.'/'.$file_name;
                $sendenboy->circulation_card = $file_path;
            }

            if (Input::hasFile('license')) {
                $file = $data['license'];
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $file->move('sendenboys/license/'.$user->id, $file_name);
                $file_path = 'sendenboys/license/'.$user->id.'/'.$file_name;
                $sendenboy->license = $file_path;
            }

            if (Input::hasFile('driver_photo')) {
                $file = $data['driver_photo'];
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $file->move('sendenboys/driver_photo/'.$user->id, $file_name);
                $file_path = 'sendenboys/driver_photo/'.$user->id.'/'.$file_name;
                $sendenboy->driver_photo = $file_path;
            }

            if (Input::hasFile('vehicle_photo')) {
                $file = $data['vehicle_photo'];
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $file->move('sendenboys/vehicle_photo/'.$user->id, $file_name);
                $file_path = 'sendenboys/vehicle_photo/'.$user->id.'/'.$file_name;
                $sendenboy->vehicle_photo = $file_path;
            }

            $sendenboy->save();

        }

        return redirect()->to('/admin/sendenboys');
    }
    /**
     * Change the status of the sendenboy.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $req)
    {
        User::where('id', $req->user_id)
        ->update(['status' => 0]);

        return ['msg'=>'success'];
    }
}
