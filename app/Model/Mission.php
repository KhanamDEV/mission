<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $table = 'missions';

    public function answers(){
        return $this->hasMany('App\Model\MissionQuestionAnswer', 'mission_id', 'id');
    }

    public function feedbacks(){
        return $this->hasMany('App\Model\Feedback', 'mission_id', 'id');
    }

    public function team(){
        return $this->belongsTo('App\Model\Team', 'team_id', 'id');
    }

    public function program(){
        return $this->belongsTo('App\Model\Program', 'program_id', 'id');
    }

    public function questions(){
        return $this->hasMany('App\Model\MissionQuestionAnswer', 'mission_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }

    public function targetUser(){
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }
}
