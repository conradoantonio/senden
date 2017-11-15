<?php

namespace App;

use DB;
use App\Traits\GlobalScopeBusiness;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The sendenboy table.
     *
     * @var string
     */
    protected $table = 'orders';

    //use GlobalScopeBusiness;
    /**
     * The business the order belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business() {
        return $this->belongsTo(Business::class);
    }
    /**
     * The order's status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status() {
        return $this->belongsTo(Status::class);
    }
    /**
     * The user that made the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
    /**
     * The senden boy who delivers the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sendenboy() {
        return $this->belongsTo(SendenBoy::class, 'sendenboy_id');
    }
    /**
     * The order's details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details() {
        return $this->hasMany(OrderDetail::class);
    }
    /**
     * The order's history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function history() {
        return $this->hasOne(OrderHistory::class);
    }

    /**
     * The order with business, sendenboy, customer and products (All the details)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public static function orderCompleteData($status, $order_id = false, $business_id = false) {
        $order = Order::select(DB::raw("
            categories.name as businesses_category, businesses.id AS idBussiness, businesses.name AS businesses_name, businesses.phone AS businesses_phone, 
            businesses.rfc AS businesses_rfc, businesses.state AS businesses_state, businesses.city AS businesses_city, CONCAT(
              IFNULL(businesses.street, ''),
              IF(businesses.ext_number, ' #', ''),
              IFNULL(businesses.ext_number, ''),
              IF(businesses.int_number, ' INT. #', ''),
              IFNULL(businesses.int_number, ''),', ',
              IFNULL(businesses.colony, ''),
              IF(businesses.postal_code, ' C.P. ', ''),
              IFNULL(businesses.postal_code, '')
            ) AS business_address,

            orders.id AS idOrder, orders.deliveryAddress AS order_addres, orders.real_time AS created_at, orders.comment AS order_comment, total AS order_total, 
            tkey.akey AS order_number,

            sendenboys.id AS idSendenboy, users.username AS sendenboy_username, users.id AS sendenboy_user_id, users.name AS sendenboy_name, 
            users.email AS sendenboy_email, users.state AS sendenboy_state, users.municipality AS sendeboy_municipality, 
            sendenboys.bank AS sendenboy_bank, users.phoneNumber AS sendenboy_phone, sendenboys.driver_photo AS sendenboy_photo,
            sendenboys.clabe AS sendenboy_clabe, CONCAT(
                IFNULL(users.`street`, ''),
                IF(users.`ext_number`, ' #', ''),
                IFNULL(users.`ext_number`, ''),
                IF(users.`int_number`, ' INT. #', ''),
                IFNULL(users.`int_number`, ''),', ',
                IFNULL(users.`colony`, ''),
                IF(users.`postal_code`, ' C.P. ', ''),
                IFNULL(users.`postal_code`, '')
            ) sendenboy_address,

            users_customer.id AS customer_id, users_customer.name AS customer_name, users_customer.email AS customer_email, users_customer.phoneNumber AS customer_phone,
            users.state AS customer_state, users_customer.municipality AS customer_municipality,
            CONCAT(
                IFNULL(users_customer.`street`, ''),
                IF(users_customer.`ext_number`, ' #', ''),
                IFNULL(users_customer.`ext_number`, ''),
                IF(users_customer.`int_number`, ' INT. #', ''),
                IFNULL(users_customer.`int_number`, ''),', ',
                IFNULL(users_customer.`colony`, ''),
                IF(users_customer.`postal_code`, ' C.P. ', ''),
                IFNULL(users_customer.`postal_code`, '')
            ) AS customer_address
        "))

        ->leftJoin('sendenboys', 'sendenboys.id', '=', 'orders.sendenboy_id')
        ->leftJoin('tkey', 'orders.id', '=', 'tkey.order_id')
        ->leftJoin('businesses', 'businesses.id', '=', 'orders.business_id')
        ->leftJoin('categories', 'categories.id', '=', 'businesses.category_id')
        ->leftJoin('users', 'sendenboys.user_id', '=', 'users.id')/*El usuario de senden*/
        ->leftJoin('users as users_customer', 'orders.user_id', '=', 'users_customer.id')/*El cliente*/
        ->orderBy('orders.created_at', 'desc');

        if ($order_id) {
            $order = $order->where('orders.id', '=', $order_id);
        }

        if ($business_id) {
            $order = $order->where('orders.business_id', '=', $business_id);
        }
        
        $order = $order->where('orders.status_id', '=', $status)
        ->get();

        if ($order_id) {/*Este if es innecesario pero lo dejamos por mero entendimiento*/
            foreach ($order as $val) {
                $val->products = OrderDetail::select(DB::raw('products.id AS product_id, products.name AS product_name, products.description as product_description,
                    products.photo AS product_image, order_details.quantity as product_quantity, order_details.price as product_price, 
                    TRUNCATE((order_details.quantity * order_details.price), 2) AS product_subtotal'))
                ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
                ->where('order_details.order_id', '=', $order_id)
                ->get();
            }
        }

        return $order;
    }

    /**
     * Count the number of orders done of all the business
     *
     */
    public static function countOrdersDone() 
    {
        return Order::where('status_id', 5)->count();
    }

    /**
     * Count the number of orders done by one business
     *
     */
    public static function countOrdersDoneBy($id) 
    {
        return Order::where('status_id', 5)->where('business_id', $id)->count();
    }

    /**
     * Count the number of orders in progress of all the business.
     *
     */
    public static function countOrdersInProgress() 
    {
        return Order::whereNotIn('status_id', [5,6])->count();
    }

     /**
     * Count the number of orders in progress of all the business.
     *
     */
    public static function countOrdersInProgressBy($id) 
    {
        return Order::whereNotIn('status_id', [5,6])->where('business_id', $id)->count();
    }

    /**
     * Count the number of orders in progress of all the business.
     *
     */
    public static function countOrdersRejected() 
    {
        return Order::where('status_id', 6)->count();
    }

    /**
     * Count the number of orders rejected by one business
     *
     */
    public static function countOrdersRejectedBy($id) 
    {
        return Order::where('status_id', 6)->where('business_id', $id)->count();
    }

    /**
     *
     * @return Returns the orders done
     */
    public static function weeklySales($business_id)
    {
        $sales = DB::table('orders')
        ->select(DB::raw('SUBSTRING_INDEX(real_time, " ", 1) as real_time, SUM(total) AS "Costo_total", 
            MONTH(`real_time`) AS Mes, DAY(`real_time`) AS Dia, COUNT(*) AS Total_Ventas'))
        ->where('real_time', '>=', DB::raw('SUBDATE(CURDATE(),INTERVAL 7 DAY)'))
        ->where('real_time', '<', DB::raw('CURDATE()'))
        ->where('status_id', 5);
        $business_id ? $sales = $sales->where('business_id', $business_id) : '';
        
        $sales = $sales->groupBy(DB::raw('DAY(created_at)'))->get();
        return $sales;
    }

    /**
     *
     * @return The total of sales of all the bussiness
     */
    public static function totalSales($business_id = false)
    {
        $total = $business_id ? Order::where('status_id', 5)->where('business_id', $business_id)->sum(DB::raw('total')) : Order::where('status_id', 5)->sum(DB::raw('total'));
        return $total;
    }
}
