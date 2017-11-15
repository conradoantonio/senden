<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Business extends Model
{   
    /**
     * The business category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * The business users list.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany(User::class);
    }

    /**
     * The business details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail() {
        return $this->hasOne(BusinessDetail::class);
    }

    /**
     * The business service dates.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviceDates() {
        return $this->hasMany(BusinessServiceDate::class);
    }

    /**
     * The business holidays.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function holidays() {
        return $this->hasMany(Holiday::class);
    }
    /**
     * The orders the users made to the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasMany(Order::class);
    }
    /**
     * The orders history of the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordersHistory() {
        return $this->hasMany(OrderHistory::class);
    }
    /**
     * The products of the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(Product::class);
    }
    /**
     * The incidences of the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidences() {
        return $this->hasMany(Incidence::class);
    }
    /**
     * The messages of the business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages() {
        return $this->hasMany(Message::class);
    }

    /**
     * Total of active business.
     *
     * @return Int
     */
    public static function countBusinesses() {
        //Modify where to know the business status
        return Business::where('status', 1)->count();
    }

    /**
     * Return the orders that own to a business according to tha paid status.
     *
     * @param int, date, date
     * @return eloquent
     */
    public static function getBusinessOrderForPaid($isPaidBusiness, $business_id = false, $start_date = false, $end_date = false) {
        $query = Order::select(DB::raw('orders.id, orders.conekta_order_id, orders.total as total_cost, businesses.name AS business, businesses.bank_name, businesses.clabe, TRUNCATE((total - (initialFee + kmFee + insuranceFee)), 2) AS total, orders.real_time AS created_at'))
        ->leftJoin('businesses', 'orders.business_id', '=', 'businesses.id')
        ->where('orders.status_id', 5)/*Que se hayan finalizado*/
        ->where('isPaidBusiness', $isPaidBusiness);

        $query = $business_id ? $query->where('orders.business_id', $business_id) : $query;

        $query = $start_date ? $query->where(DB::raw('TIMESTAMP(orders.real_time)'), '>=', $start_date.' 00:00:00') : $query;
        
        $query = $end_date ? $query->where(DB::raw('TIMESTAMP(orders.real_time)'), '<=', $end_date.' 23:59:59') : $query;

        $query = $query->get();
        
        foreach ($query as $key => $order) {
            //$order->subtotal = DB::table('order_details')->where('order_id', $order->id)->sum(DB::raw('subtotal'));
            $order->subtotal = DB::table('order_details')->where('order_id', $order->id)->sum(DB::raw('quantity * price'));
            $order->comision = round($order->subtotal * 0.03, 2, PHP_ROUND_HALF_DOWN);
            $order->total_to_pay = round($order->subtotal - $order->comision, 2, PHP_ROUND_HALF_DOWN);
        }

        return $query;
    }
}
