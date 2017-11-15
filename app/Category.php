<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{    
    /**
     * The category's businesses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businesses() {
        return $this->hasMany(Business::class);
    }
    
}
