<?php

namespace App\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class BusinessScope implements Scope
{
    protected $user;

    public function __construct($user = null) 
    {
        $this->user = $user ? $user : Auth::user() ;
    }
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = $this->user;

        if ($user && $user->business_id && !$user->isSendenAdmin()) {
            $builder->where('business_id', $user->business_id);
        }
    }
}
