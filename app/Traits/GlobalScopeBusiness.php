<?php

namespace App\Traits;

use App\Scopes\BusinessScope;

trait GlobalScopeBusiness
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        $user = auth()->user();
        static::addGlobalScope(new BusinessScope($user));
    }
}
