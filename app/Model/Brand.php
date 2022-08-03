<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Brand extends Authenticatable
{
    protected $table = 'brands';

    public function teams()
    {
        return $this->hasMany('App\Model\Team', 'brand_id', 'id');
    }
}
