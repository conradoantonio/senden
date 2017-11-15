<?php

namespace App;

use App\Traits\GlobalScopeBusiness;
use Illuminate\Database\Eloquent\Model;

class ServiceDate extends Model
{
	use GlobalScopeBusiness;
    /**
     * The businesses that work in the service date.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businesses() {
        return $this->hasMany(BusinessServiceDate::class);
    }
    
}
