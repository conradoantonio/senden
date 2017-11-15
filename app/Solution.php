<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    /**
     * The solution's incidences.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidences() {
        return $this->hasMany(Incidence::class);
    }
    
}
