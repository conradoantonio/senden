<?php

namespace App;

use App\Traits\GlobalScopeBusiness;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
{
    use Notifiable, GlobalScopeBusiness;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The user's business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business() {
        return $this->belongsTo(Business::class);
    }

    /**
     * The business category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    /**
     * The user's sendenboy data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sendenboy() {
        return $this->hasOne(SendenBoy::class);
    }

    /**
     * The user's orders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasOne(Order::class);
    }

    /**
     * Check if the user has any given role.
     *
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        $roles = is_array($roles) ? $roles : func_get_args();
        foreach ($roles as $role) {
            if ($this->type->name == $role) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the user is a senden-admin.
     *
     * @return boolean
     */
    public function isSendenAdmin() {
        
        return $this->type ? $this->type->name == 'SendenAdmin' : false;
    }

    /**
     * Gives the id of the bussiness if the user is an adminbusiness
     *
     * @return boolean
     */
    public function isOpenBusiness() {
        if (auth()->user()->user_type_id == 3) {//Si es un usuario de negocio
            $business = Business::where('id', auth()->user()->business_id)->first();
            if ($business->isOpen == 0) {
                return false;
            } else {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the user is a business owner.
     *
     * @return boolean
     */
    public function isBusinessOwner() {
        
        return $this->type ? $this->type->name == 'business-owner' : false;
    }

    /**
     * Determine if the user is a business-admin.
     *
     * @return boolean
     */
    public function isBusinessAdmin() {
        
        return $this->type ? $this->type->name == 'Administrador' : false;
    }

    /**
     * Determine if the user is a senden-admin.
     *
     * @return boolean
     */
    public function isBusinessSalesman() {
        
        return $this->type ? $this->type->name == 'Vendedor' : false;
    }

    /**
     * Determine if the user is a senden-admin.
     *
     * @return boolean
     */
    public function isSendenBoy() {
        
        return $this->type ? $this->type->name == 'Sendenboy' : false;
    }

    /**
     * Determine if the user is a senden-admin.
     *
     * @return boolean
     */
    public function isClient() {
        
        return $this->type ? $this->type->name == 'client' : false;
    }

    /**
     * Return number of users by business 
     *
     * @return Int
     */
    public static function countUsersSalesBy($id) {
        return User::where('business_id', $id)->where('user_type_id', 4)->count();
    }

    /**
     * Return number of users by business 
     *
     * @return Int
     */
    public static function countUsersBusinesssBy($id) {
        return User::where('business_id', $id)->where('user_type_id', 3)->count();
    }

    
    /**
     * Return number of sendenshop app users 
     *
     * @return Int
     */
    public static function countSendenshopUsers() {
        return User::where('isPanelUser', '!=', 1)->where('user_type_id', 5)->count();
    }

    /**
     * Return number of sendenshop app users 
     *
     * @return Int
     */
    public static function countSendenboyUsers() {
        return User::where('isPanelUser', '!=', 1)->where('user_type_id', 2)->count();
    }

    /**
     * Return number of banned app users
     *
     * @return Int
     */
    public static function countBannedUsers() {
        return User::where('status', 2)->count();
    }

    /**
     * Return number of banned app users
     *
     * @return Int
     */
    public static function countBusinessesUsers() {
        return User::where(function($query)
                {
                    $query->orWhere('user_type_id','=',3)
                          ->orWhere('user_type_id','=',4);
                })->count();
    }

    /**
     *
     * @return Search the user with the given email.
     */
    public static function searchUserByEmail($correo, $correo_viejo = false)
    {
        return $correo_viejo ? User::where('email', '=', $correo)->where('email', '!=', $correo_viejo)->get() : User::where('email', '=', $correo)->get();
    }

    /**
     *
     * @return Search the user with the given email.
     */
    public static function searchUserByUsername($username, $username_viejo = false)
    {
        return $username_viejo ? User::where('username', '=', $username)->where('username', '!=', $username_viejo)->get() : User::where('username', '=', $username)->get();
    }

    /**
     *
     * @return Return the users by the given privilege.
     */
    public static function getUsersWithPrivilege($name_privilege, $status, $user_id = null)
    {
        $users = User::select(DB::raw("users.*, user_types.name AS 'privilege_name'"))
        ->leftJoin('user_types', 'users.user_type_id', '=', 'user_types.id')
        ->where('user_types.name', $name_privilege)
        ->where('status', $status);

        $user_id ? $users = $users->where('users.id', '!=', $user_id) : '';
        
        $users = $users->get();
        return $users;
    }

    /**
     *
     * @return Return the users by the given privilege.
     */
    public static function usersWithBusiness($status)
    {
        return User::select(DB::raw("users.*, user_types.name AS 'privilege_name', businesses.name as business"))
        ->leftJoin('user_types', 'users.user_type_id', '=', 'user_types.id')
        ->leftJoin('businesses', 'users.business_id', '=', 'businesses.id')
        ->where('user_types.name', 'Administrador')
        ->where('users.status', $status)
        ->get();
    }

    /**
     *
     * @return Return the users that have the same business.
     */
    public static function usersByBusiness($status, $business_id, $user_id)
    {
        return User::select(DB::raw("users.*, businesses.`name` AS negocio, user_types.`name` AS tipo_usuario"))
        ->leftJoin('businesses', 'users.business_id', '=', 'businesses.id')
        ->leftJoin('user_types', 'users.user_type_id', '=', 'user_types.id')
        ->where('users.status', $status)
        ->where('users.business_id', $business_id)
        ->where('users.id', '!=', $user_id)
        ->get();
    }    
}
