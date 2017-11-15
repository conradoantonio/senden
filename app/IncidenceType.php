<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidenceType extends Model
{
    /**
     * The type's incidences.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidences() {
        return $this->hasMany(Incidence::class);
    }
    
}
