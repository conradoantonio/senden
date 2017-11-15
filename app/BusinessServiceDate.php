<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessServiceDate extends Model
{
    use GlobalScopeBusiness;
    /**
     * The business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business() {
        return $this->belongsTo(Business::class);
    }
    /**
     * The business service date.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceDate() {
        return $this->belongsTo(ServiceDate::class, 'service_date_id');
    }
    
}
