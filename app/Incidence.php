<?php

namespace App;

use App\Traits\GlobalScopeBusiness;
use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    
    use GlobalScopeBusiness;
    /**
     * The business that the incidence belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business() {
        return $this->belongsTo(Business::class);
    }
    
    /**
     * The incidence type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() {
        return $this->belongsTo(IncidenceType::class, 'incidence_type_id');
    }
    
    /**
     * The incidence solution.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function solution() {
        return $this->belongsTo(Solution::class);
    }
    
}
