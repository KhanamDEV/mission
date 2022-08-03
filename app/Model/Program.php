<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';

    public function teams(){
        return $this->belongsToMany('App\Model\Team', 'program_histories', 'program_id', 'team_id');
    }

    public function missions(){
        return $this->belongsToMany('App\Model\Mission', 'program_missions', 'program_id', 'mission_id');
    }

}
