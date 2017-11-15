<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Traits\GlobalScopeBusiness;

class Message extends Model
{    
	#use GlobalScopeBusiness;
    /**
     * The business that the message belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business() {
        return $this->belongsTo(Business::class);
    }
    
}
