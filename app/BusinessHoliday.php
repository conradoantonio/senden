<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHoliday extends Model
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
    
}
