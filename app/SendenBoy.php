<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class SendenBoy extends Model
{
    /**
     * The sendenboy table.
     *
     * @var string
     */
    protected $table = 'sendenboys';
    
    /**
     * The sendenboy's user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(Business::class);
    }
        
    /**
     * The product's delivery method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
    
    /**
     * The orders in which the product was requested.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function orders() {
        return $this->hasMany(Order::class);
    }

    /**
     * All the sendenboys of the application.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public static function getSendenboys() {
        return SendenBoy::select(DB::raw('sendenboys.user_id as user_id, sendenboys.id as sendenboy_id, users.name, users.email, vehicles.name AS vehicle, sendenboys.plate_number, sendenboys.bank, sendenboys.clabe, sendenboys.driver_photo'))
        ->leftJoin('users', 'sendenboys.user_id', '=', 'users.id')
        ->leftJoin('vehicles', 'sendenboys.vehicle_id', '=', 'vehicles.id')
        ->where('users.status', '!=', 0)
        ->get();
    }

    /**
     * Get the data from a sendenboy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public static function getSendenboyData($sendenboy_id) {
        return SendenBoy::select(DB::raw('sendenboys.id AS sendenboy_id, sendenboys.user_id, sendenboys.vehicle_id, sendenboys.insurance_policy, 
            sendenboys.circulation_card, sendenboys.license, sendenboys.driver_photo, sendenboys.vehicle_photo, sendenboys.plate_number, sendenboys.bank, sendenboys.clabe, 
            users.name, users.surname, users.email, users.username, users.user_password, users.photo, users.street, users.ext_number, users.int_number, users.colony, users.municipality,
            users.state, users.phoneNumber, users.postal_code'))
        ->leftJoin('users', 'sendenboys.user_id', '=', 'users.id')
        ->leftJoin('vehicles', 'sendenboys.vehicle_id', '=', 'vehicles.id')
        ->where('sendenboys.id', $sendenboy_id)
        ->first();
    }

    /**
     * Return the orders made by a sendenboy according to tha paid status.
     *
     * @param int, date, date
     * @return eloquent
     */
    public static function getSendenboysOrderForPaid($isPaidSendenboy, $sendenboy_id = false, $start_date = false, $end_date = false) 
    {
        $query = Order::select(DB::raw('orders.id, orders.conekta_order_id, users.name AS sendenboy_name, sendenboys.bank, sendenboys.clabe, TRUNCATE((initialFee + kmFee), 2) AS total, 
            TRUNCATE((initialFee + kmFee) * 0.15, 2) AS comision, TRUNCATE((initialFee + kmFee) - (initialFee + kmFee) * 0.15, 2) AS total_to_pay, orders.real_time AS created_at'))
        ->leftJoin('sendenboys', 'orders.sendenboy_id', '=', 'sendenboys.id')
        ->leftJoin('users', 'sendenboys.user_id', '=', 'users.id')
        ->where('isPaidSendenboy', $isPaidSendenboy)
        ->where('orders.status_id', 5);/*Que se hayan finalizado*/

        $query = $sendenboy_id ? $query->where('orders.sendenboy_id', $sendenboy_id) : $query;

        $query = $start_date ? $query->where(DB::raw('TIMESTAMP(orders.real_time)'), '>=', $start_date.' 00:00:00') : $query;
        
        $query = $end_date ? $query->where(DB::raw('TIMESTAMP(orders.real_time)'), '<=', $end_date.' 23:59:59') : $query;

        return $query->get();
    }

    /**
     * Return the orders made by a sendenboy according to tha paid status.
     *
     * @param int, date, date
     * @return eloquent
     */

    public static function sendenboyByStatus($status)
    {
        return Sendenboy::select(DB::raw('sendenboys.`id` AS sendenboy_id, users.name AS nombre_usuario, users.id AS user_id'))
        ->leftJoin('users', 'users.id', '=', 'sendenboys.user_id')
        ->get();
    }
}
