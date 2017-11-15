<?php

namespace App\Http\Controllers;

use App\SendenBoy;
use App\User;
use App\UserType;
use App\Business;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UsersController extends Controller
{
    /**
     *============================================================================================================================================
     *=                                    Empiezan las funciones relacionadas a los usuarios administradores                                    =
     *============================================================================================================================================
     */
    
    /**
     * Show the SendenAdmin users.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_users()
    {
        $users = User::getUsersWithPrivilege('SendenAdmin', 1, auth()->user()->id);
        $businessId = auth()->user()->isSendenAdmin() ? 0 : auth()->user()->business_id;
        $menu = 'Usuarios';
        $title = 'Usuarios Administradores';
        return view('admin.users.sendenadmin', ['menu' => $menu, 'title' => $title, 'users' => $users, 'businessId' => $businessId]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function types()
    {
        $types = UserType::where('name', '<>', 'SendenAdmin')->get();
        $types = $types->filter(function ($type) {
            if (($type->name == 'Sendenboy' || $type->name == 'Administrador') && !auth()->user()->isSendenAdmin()) {
                return false;
            } else {
                return true;
            }
            return false;
        });
        return ['types' => $types];
    }

    /**
     * Store a superadminuser
     *
     * @return \Illuminate\Http\Response
     */
    public function store_superuser(Request $request)
    {
        $valido = User::searchUserByEmail($request->email);

        if (count($valido) > 0) {//Se valida que el correo no exista anteriormente
            return ['msg' => 'Email repetido'];
        }

        $tipo = UserType::where('name', 'SendenAdmin')->first();
        
        $user = new User();

        $user->user_type_id = $tipo->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->photo = 'users/default.jpg';
        $user->isPanelUser = 1;
        $user->status = 1;

        $user->save();

        $users = User::getUsersWithPrivilege('SendenAdmin', 1, auth()->user()->id);

        return $users;
    }

    /**
     * Update a superadminuser
     *
     * @return \Illuminate\Http\Response
     */
    public function update_superuser(Request $request)
    {
        $valido = User::searchUserByEmail($request->email, $request->email);

        if (count($valido) > 0) {//Se valida que el correo no exista anteriormente
            return ['msg' => 'Email repetido'];
        }

        $user = User::find($request->id);

        if ($user) {
            $user->name = $request->name;
            $request->password ? $user->password = bcrypt($request->password) : '';

            $user->save();
        }
        
        return User::getUsersWithPrivilege('SendenAdmin', 1, auth()->user()->id);
    }

    /**
     * Ban a user with SendenAdmin privilege
     *
     * @return \Illuminate\Http\Response
     */
    public function ban_admin(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->status = 0;
            $user->save();
        }

        return User::getUsersWithPrivilege('SendenAdmin', 1, auth()->user()->id);
    }

    /**
     *============================================================================================================================================
     *=                                      Empiezan las funciones relacionadas a los usuarios de negocios                                      =
     *============================================================================================================================================
     */

    /**
     * Show the business admin users.
     *
     * @return \Illuminate\Http\Response
     */
    public function business_users()
    {
        $users = User::usersWithBusiness(1);
        $businessId = auth()->user()->isSendenAdmin() ? 0 : auth()->user()->business_id;
        $bussinesses = Business::where('status', 1)->get();
        $menu = 'Usuarios';
        $title = 'Usuarios de Negocios';
        return view('admin.users.businesses', ['menu' => $menu, 'title' => $title, 'bussinesses' => $bussinesses, 'users' => $users, 'businessId' => $businessId]);
    }

    /**
     * Store a bussiness admin user.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_businessuser(Request $request)
    {
        $valido = User::searchUserByEmail($request->email);

        if (count($valido) > 0) {//Se valida que el correo no exista anteriormente
            return ['msg' => 'Email repetido'];
        }

        $tipo = UserType::where('name', 'Administrador')->first();
        
        $user = new User();

        $user->user_type_id = $tipo->id;
        $user->business_id = $request->business_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->photo = 'users/default.jpg';
        $user->isPanelUser = 1;
        $user->status = 1;

        $user->save();

        $users = User::usersWithBusiness(1);

        return $users;
    }

    /**
     * Update a bussiness admin user.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_businessuser(Request $request)
    {
        $valido = User::searchUserByEmail($request->email, $request->email);

        if (count($valido) > 0) {//Se valida que el correo no exista anteriormente
            return ['msg' => 'Email repetido'];
        }

        $user = User::find($request->id);

        if ($user) {
            $user->business_id = $request->business_id;
            $user->name = $request->name;
            $request->password ? $user->password = bcrypt($request->password) : '';

            $user->save();
        }
        
        return User::usersWithBusiness(1);
    }

    /**
     * Ban a user with business admin privilege
     *
     * @return \Illuminate\Http\Response
     */
    public function ban_business_user(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->status = 0;
            $user->save();
        }

        return User::usersWithBusiness(1);
    }

    /**
     * Edit some of the users fields of the current business user.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_business_user_info(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {

            if ($request->is_open) {
                $business = Business::find($request->idBusiness);
                $business->isOpen = 1;
                $business->save();
            } else {
                $business = Business::find($request->idBusiness);
                $business->isOpen = 0;
                $business->save();
            }

            $user->name = $request->name;
            $request->password ? $user->password = bcrypt($request->password) : '';

            $folder1 = $request->id;
            $folder2 = $request->idBusiness;
            $extensions = ['jpeg', 'jpg', 'png', 'gif'];
            $file = $request->file('photo');
            if ($request->file('photo')) {
                $extension_archivo = $file->getClientOriginalExtension();
                if (array_search($extension_archivo, $extensions)) {
                    /*Usuario*/
                    $name_photo = time().'.'.$file->getClientOriginalExtension();
                    $file->move('users/'.$folder1, $name_photo);
                    $path_photo = 'users/'.$folder1.'/'.$name_photo;
                    $user->photo = $path_photo;

                    /*Negocio*/
                    /*copy('users/'.$folder1.'/'.$name_photo, 'businesses/'.$folder2.'/logo.'.$extension_archivo);
                    $negocio = Business::find($request->idBusiness);
                    if ($negocio) {
                        $negocio->logo = 'businesses/'.$folder2.'/logo.'.$extension_archivo;
                        $negocio->save();
                    }*/

                }
            }

            $user->save();
        }
        return back();
    }

    /**
     * Change the isOpen field of a business (Duplicated).
     *
     * @return \Illuminate\Http\Response
     */
    public function change_is_open(Request $request) {
        Business::where('id', $request->id)
        ->update(['isOpen' => $request->status]);
        return ['msg' => 'success'];
    }

    /**
     *============================================================================================================================================
     *= Empiezan las funciones relacionadas a los usuarios de ventas y para poder duplicar administradores de negocio (Administrador de negocio) =
     *============================================================================================================================================
     */

    /**
     * Show the business admin users.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_users_as_admin_business()
    {
        $users = User::usersByBusiness(1, auth()->user()->business_id, auth()->user()->id);
        $menu = 'Usuarios';
        $title = 'Usuarios de mi negocio';
        return view('admin.users.business_sales_users', ['menu' => $menu, 'title' => $title, 'users' => $users]);
    }

    /**
     * Store a user with the same business that the business admin user.
     *
     * @return \Illuminate\Http\Response
     */
    public function mybusiness_save(Request $request)
    {
        $valido = User::searchUserByEmail($request->email);

        if (count($valido) > 0) {//Se valida que el correo no exista anteriormente
            return ['msg' => 'Email repetido'];
        }

        $user = new User();

        $user->user_type_id = $request->user_type_id;
        $user->business_id = auth()->user()->business_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->photo = 'users/default.jpg';
        $user->isPanelUser = 1;
        $user->status = 1;

        $user->save();

        return User::usersByBusiness(1, auth()->user()->business_id, auth()->user()->id);
    }

    /**
     * Store a user with the same business that the business admin user.
     *
     * @return \Illuminate\Http\Response
     */
    public function mybusiness_edit(Request $request)
    {
        $valido = User::searchUserByEmail($request->email);

        if (count($valido) > 0) {//Se valida que el correo no exista anteriormente
            return ['msg' => 'Email repetido'];
        }

        $user = User::find($request->id);

        if ($user) {
            $user->user_type_id = $request->user_type_id;
            $user->name = $request->name;
            $request->password ? $user->password = bcrypt($request->password) : '';

            $user->save();
        }
       
        return User::usersByBusiness(1, auth()->user()->business_id, auth()->user()->id);
    }

    /**
     * Ban a user that belongs to a business.
     *
     * @return \Illuminate\Http\Response
     */
    public function mybusiness_ban(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->status = 0;
            $user->save();
        }
        
        return User::usersByBusiness(1, auth()->user()->business_id, auth()->user()->id);
    }

    /**
     *============================================================================================================================================
     *=                                    Empiezan las funciones relacionadas a los usuarios clientes (app)                                     =
     *============================================================================================================================================
     */

    /**
     * Show the SendenAdmin users.
     *
     * @return \Illuminate\Http\Response
     */
    public function users_sendenshop()
    {
        $users = User::where('user_type_id', 5)->get();
        $menu = 'Usuarios';
        $title = 'Usuarios sendenshop';
        return view('admin.users.sendenshop', ['menu' => $menu, 'title' => $title, 'users' => $users]);
    }

    /**
     * Change the status of a sendenshop user
     *
     * @return \Illuminate\Http\Response
     */
    public function change_status (Request $request)
    {
        if ($request->status == 0) {//Significa que el usuario se va a borrar
            User::where('id', $request->id)
            ->delete();
        } else if ($request->status == 1 || $request->status == 2){
            User::where('id', $request->id)
            ->update(['status' => $request->status]);
        }
        return ['success' => true];
    }
}
