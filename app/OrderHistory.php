<?php

namespace App;

use App\Traits\GlobalScopeBusiness;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use GlobalScopeBusiness;
    protected $table = 'orders_history';

    /**
     * The business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business() {
        return $this->belongsTo(Business::class);
    }
    
    /**
     * The order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
