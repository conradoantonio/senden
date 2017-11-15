<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The sendenboys that own a certain vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sendenboys() {
        return $this->hasMany(SendenBoy::class);
    }
    /**
     * The products that are to be sent in a certain vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(Product::class);
    }
    
}