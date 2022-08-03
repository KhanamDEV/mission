<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MissionBase extends Model
{
    protected $table = 'mission_bases';

    public function question_bases(){
        return $this->hasMany('App\Model\QuestionBase', 'mission_base_id', 'id');
    }

    public function feedback_base(){
        return $this->hasOne('App\Model\FeedbackBase', 'mission_base_id', 'id');
    }
}
