<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
	// If changes to user's architecture rename methods.
    /**
     * The users that are of a certain type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany(User::class);
    }
    
}
