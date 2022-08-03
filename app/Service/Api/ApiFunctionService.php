<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 21/05/2021
 * Time: 9:11 AM
 **/


namespace App\Service\Api;


use App\Helpers\FastImage;
use App\Helpers\Helpers;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiFunctionService
{
    public function formatUser($user, $type = 'login')
    {
        $json = (object)[];

        if ($type == 'login') {
            $json->id = $user->id;
            $json->email = $user->email;
            $json->access_token = $user->access_token;
            $json->is_avatar = !is_null($user->thumbnail_url);
        }

        if ($type == 'detail'){
            $json->id = $user->id;
            $json->name_sei = $user->name_sei;
            $json->name_mei = $user->name_mei;
            $json->name_sei_kana = $user->name_sei_kana;
            $json->name_mei_kana = $user->name_mei_kana;
            $json->name = $json->name_sei.$json->name_mei.'/'.$json->name_sei_kana.$json->name_mei_kana;
            $json->full_name_sei = $json->name_sei.$json->name_mei;
            $json->detail = $user->detail;
            $json->thumbnail =  $this->formatImage($user->thumbnail_url, 'user');
        }

        if($type == 'list'){
            $json = [];
            foreach ($user as $item){
                $itemPush = (object)[];
                $itemPush->id = $item->id;
                $itemPush->name_sei = $item->name_sei;
                $itemPush->name_mei = $item->name_mei;
                $itemPush->name_sei_kana = $item->name_sei_kana;
                $itemPush->name_mei_kana = $item->name_mei_kana;
                $itemPush->name = $itemPush->name_sei.$itemPush->name_mei.'/'.$itemPush->name_sei_kana.$itemPush->name_mei_kana;
                $itemPush->thumbnail = $this->formatImage($item->thumbnail_url, 'user');
                array_push($json, $itemPush);
            }
        }
        return $json;
    }

    public function formatMission($missions, $type = 'list'){
        $json = (object)[];
        if ($type == 'list'){
            $json->answered = [];
            $json->not_answered = [];
            foreach ($missions["answered"] as $mission_answered){
                $mission = (object)[];
                $mission->id = $mission_answered->id;
                $mission->name = $mission_answered->name;
                $mission->team_name = $mission_answered->team_name;
                $mission->delivery_order_date = date('Y.m.d', strtotime($mission_answered->delivery_order_date));
                $mission->thumbnail = $this->formatImage($mission_answered->thumbnail_url);
                $mission->is_target = $mission_answered->is_target ? true : false;
                $userTarget = (object)[];
                if ($mission_answered->user_target != null){
                    $userTarget->name = $mission_answered->user_target->name_sei.$mission_answered->user_target->name_mei;
                    $userTarget->id = $mission_answered->user_target->id;
                }
                $mission->user_taget = $userTarget;
                array_push($json->answered, $mission);
            }
            foreach ($missions["not_answered"] as $mission_not_answered){
                    $mission = (object)[];
                    $mission->id = $mission_not_answered->id;
                    $mission->name = $mission_not_answered->name;
                    $mission->team_name = $mission_not_answered->team_name;
                    $mission->delivery_order_date = date('Y.m.d', strtotime($mission_not_answered->delivery_order_date));
                    $mission->thumbnail = $this->formatImage($mission_not_answered->thumbnail_url);
                    $mission->is_target = $mission_not_answered->is_target ? true : false;
                    $userTarget = (object)[];
                    if ($mission_not_answered->user_target != null){
                        $userTarget->name = $mission_not_answered->user_target->name_sei.$mission_not_answered->user_target->name_mei;
                        $userTarget->id = $mission_not_answered->user_target->id;
                    }
                    $mission->user_taget = $userTarget;
                    array_push($json->not_answered, $mission);
            }
        }
        return $json;
    }

    public function formatMissionQuestion($data, $type = 'not_answered'){
        //type = 1 : Checkbox
        //type = 2 : Select
        //type = 3 : Text
        //type = 4 : Image
        $json = (object)[];
        $json->mission = (object)[];
        $json->mission->id = $data['mission']->id;
        $json->mission->name = $data['mission']->name;
        $json->mission->delivery_order_date = $data['mission']->delivery_order_date;
        $json->mission->is_target = !($data['mission']->target_user_id == null);
        $json->mission->time_required = $data['mission']->time_required;
        $json->mission->is_anonymous = (boolean) $data['mission']->is_anonymous;
        $userTarget = (object)[];
        if ($data['mission']->target_user_id != null){
            $userTarget->id = $data['mission']->user_target->id;
            $userTarget->name = $data['mission']->user_target->name_sei.$data['mission']->user_target->name_mei;
            $userTarget->text = __('api::layer.user.target_text_mission');
        }
        $json->mission->user_target = $data['mission']->target_user_id == null ? null : $userTarget;


        $json->questions = [];
        foreach ($data['questions'] as $question){
            $data_push = (object)[];
            $data_push->id = $question->id;
            $data_push->title = $question->title;
            $data_push->type = $question->type;
            if ($data_push->type == 3  || $data_push->type == 4){
                $data_push->choice = request()->header('device') == 'ios' ? [] : "" ;
            } else{
                $data_push->choice = array_unique(explode(",", $question->choice));
                $data_push->choice = array_combine(range(0, count($data_push->choice) - 1), array_values($data_push->choice));
                if ($question->type == 1 || $question->type == 2){

                    foreach ($data_push->choice as $key => $item){
                        $data_push->choice[$key] = trim($item);
                    }
                }
            }
            if ($type == 'answered') {
                $data_push->answer = ($question->type == 1 || $question->type == 2) ? explode(",", $question->answer) : ($question->type == 3 ? ($question->answer == "" ?  (request()->header('device') == 'ios' ? [] : "") : (request()->header('device') == 'ios' ? [$question->answer] : $question->answer) ) : $this->formatImage($question->answer));
                $data_push->is_anonymous = $question->is_anonymous;
                $data_push->question_id = $question->question_id;
            }
            array_push($json->questions, $data_push);
        }
        return $json;
    }

    public function formatFeedback($data, $type = 'list')
    {
        $json = [];
        if ($type == 'list'){
            foreach ($data as $feedback){
                $data_push = (object)[];
                $data_push->id = $feedback->id;
                $data_push->title = $feedback->title;
                $data_push->detail = $feedback->detail;
                $data_push->percent = $feedback->percent;
                $data_push->is_lock = !(bool)$feedback->answers;
                $data_push->date = date('Y.m.d', strtotime($feedback->delivery_order_date));
                $data_push->thumbnail = $this->formatImage($feedback->thumbnail_url);
                array_push($json, $data_push);
            }
        }
        if ($type == 'detail'){
            $json = (object)[];
            //feedback
            $json->feedback = (object)[];
            $json->feedback->title = $data['feedback']->title;
            $json->feedback->thumbnail = $this->formatImage($data['feedback']->thumbnail_url);
            $json->feedback->hint_title = $data['feedback']->hint_title;
            $json->feedback->hint_detail = $data['feedback']->hint_detail;
            $json->feedback->is_target = isset($data['feedback']->user_target) ? true : false;
            if (!empty($data['feedback']->user_target)){
                $userTarget = (object)[];
                $userTarget->id = $data['feedback']->user_target->id;
                $userTarget->name = $data['feedback']->user_target->name_sei .$data['feedback']->user_target->name_mei;
                $userTarget->text = __('api::layer.user.target_text_feedback');
            }
            $json->feedback->user_target = $userTarget ?? null;
            //answers
            $json->answers = [];
            foreach ($data['answers'] as $value){
                $objAnswer = (object)[];
                $objAnswer->title = $value['title'];
                $objAnswer->list_answer = [];
                foreach ($value['list_answer'] as $answer){
                    $dataAnswer = (object)[];
                    $dataAnswer->user = $answer['user'];
                    $dataAnswer->type = $answer['type'];
                    $dataAnswer->answer = $answer['type'] == 4 ? $this->formatImage($answer['answer']) : $answer['answer'];
                    $objAnswer->type = $answer['type'];
                    array_push($objAnswer->list_answer, $dataAnswer);
                }
                array_push($json->answers, $objAnswer);
            }
        }
        return $json;
    }

    public function formatTeam($data, $type = 'list'){
        $json = (object)[];
        if ($type == 'list'){
            $json = [];
            foreach ($data as $team){
                $obj_team = (object)[];
                $obj_team->id = $team->id;
                $obj_team->name = $team->name;
                $obj_team->detail = $team->detail;
                $obj_team->thumbnail = $this->formatImage($team->thumbnail_url);
                array_push($json, $obj_team);
            }
        }
        if($type == 'detail'){
            $json->id = $data->id;
            $json->name = $data->name;
            $json->thumbnail = $this->formatImage($data->thumbnail_url);
            $json->detail = $data->detail;
            $json->program_id = $data->program_id;
            $json->program_name = $data->program_name;
            $json->program_detail = $data->program_detail;
            $json->is_edit = $data->is_edit;
        }
        return $json;
    }

    public function formatProgram($data, $type = 'list'){
        $json = (object)[];
        if ($type == 'list'){
            $json = [];
            foreach ($data as $program){
                $objProgram = (object)[];
                $objProgram->id = $program->id;
                $objProgram->name = $program->name;
                $objProgram->detail = $program->detail;
                $objProgram->thumbnail = $this->formatImage($program->thumbnail_url);
                array_push($json, $objProgram);
            }
        }

        if ($type == 'detail'){
            $json->id = $data->id;
            $json->name = $data->name;
            $json->detail = $data->detail;
            $json->thumbnail = $this->formatImage($data->thumbnail_url);
        }
        return $json;
    }

    public function formatMember($data, $type = 'list'){
        $json = (object)[];
        if ($type == 'list'){
            $json = [];
            foreach ($data as $member){
                $objMember = (object)[];
                if (isset($member->team_member_id)){
                    $objMember->id = $member->team_member_id;
                    $objMember->user_id = $member->id;
                } else{
                    $objMember->id = $member->id;
                }
                $objMember->name = $member->name_sei.$member->name_mei;
                $objMember->name_sei = $member->name_sei;
                $objMember->name_mei = $member->name_mei;
                $objMember->is_team_member = $member->is_team_member;
                $objMember->is_leader = $member->is_leader;
                $objMember->position = $member->is_team_member ? (($member->is_leader == 1) ? "Leader" : "Member") : '';
                $objMember->thumbnail = $this->formatImage($member->thumbnail_url, 'user');
                array_push($json, $objMember);
            }
        }

        if ($type == 'detail'){
            $json->id = $data->user_id;
            $json->name_sei = $data->name_sei;
            $json->name_mei = $data->name_mei;
            $json->name_sei_kana =$data->name_sei_kana;
            $json->name_mei_kana =$data->name_mei_kana;
            $json->name = $data->name_sei.$data->name_mei.'/'.$data->name_sei_kana.$data->name_mei_kana;
            $json->detail = $data->detail;
            $json->department = $data->department;
            $json->birthday = date('Y/m/d', strtotime($data->birthday));
            $json->thumbnail = $this->formatImage($data->thumbnail_url, 'user');
        }
        return $json;
    }

    function formatImage($thumbnail_url, $type = 'all')
    {
        if ($type == 'user'){
            $thumbnail_url = empty($thumbnail_url) ? asset('static/user/images/user_detail.png') : $thumbnail_url;
        }
        $json = (object)[];
        if (!empty($thumbnail_url)) {
            if (strtolower(env('ENVIRONMENT')) == 'local'){
                $json->url = 'https://missionimg.s3-ap-northeast-1.amazonaws.com/brand/1642759884.png';
            } else{
                $json->url = strpos($thumbnail_url, url('/')) >= 0 && is_int(strpos($thumbnail_url, url('/'))) ? $thumbnail_url : Helpers::getUrlImg($thumbnail_url);
            }
            try {
                $image = new FastImage($json->url);
                list( $width, $height) = $image->getSize();
                $json->height = $height;
                $json->width = $width;
                $json->ratio = $json->height / $json->width;
            } catch (\Exception $e){
                $image = getimagesize($json->url);
                $json->height = $image[1];
                $json->width = $image[0];
                $json->ratio = $json->height / $json->width;
            }

        }
        return $json;
    }

    function formatStatus($status){
        return $status ? true : false;
    }

    public function formatNotification($data ,$type = 'list'){
        $json = (object)[];
        if ($type == 'list'){
            $json->brand = [];
            $json->system = [];
            foreach ($data['brand'] as $brandNotify){
                $objNotify = (object)[];
                $objNotify->id = $brandNotify->id;
                $objNotify->title = $brandNotify->title;
                $objNotify->is_seen = $brandNotify->is_seen ? true : false;
                $objNotify->created_at = date('Y/m/d', strtotime($brandNotify->created_at));
                array_push($json->brand, $objNotify);
            }
            foreach ($data['system'] as $brandNotify){
                $objNotify = (object)[];
                $objNotify->id = $brandNotify->id;
                $objNotify->title = $brandNotify->title;
                $objNotify->is_seen = $brandNotify->is_seen ? true : false;
                $objNotify->created_at = date('Y/m/d', strtotime($brandNotify->created_at));
                array_push($json->system, $objNotify);
            }
        }
        if ($type == 'detail'){
            $json->id = $data->id;
            $json->title = $data->title;
            $json->description = $data->description;
            $json->url = $data->url;
        }
        if ($type == 'type'){
            $json = [];
            foreach ($data as $notify){
                $objNotify = (object)[];
                $objNotify->id = $notify->id;
                $objNotify->title = $notify->title;
                $objNotify->created_at = date('Y/m/d', strtotime($notify->created_at));
                $objNotify->is_seen = $notify->is_seen ? true : false;
                array_push($json, $objNotify);
            }
        }
        return $json;
    }
}