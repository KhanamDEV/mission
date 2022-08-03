<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 22/06/2021
 * Time: 10:23
 */

namespace App\Service\Api;


use App\Helpers\ResponseHelpers;
use App\Jobs\SendNotificationNewFeedback;
use App\Repository\Api\Feedback\FeedbackBaseRepository;
use App\Repository\Api\Feedback\FeedbackRepositoryInterface;
use App\Repository\Api\Mission\MissionQuestionAnswerBaseRepositoryInterface;
use App\Repository\Api\Mission\MissionQuestionAnswerRepositoryInterface;
use App\Repository\Api\Mission\MissionRepositoryInterface;
use App\Repository\Api\MissionQuestion\MissionQuestionRepositoryInterface;
use App\Repository\Api\ProgramMission\ProgramMissionRepositoryInterface;
use App\Repository\Api\Team\TeamMemberRepositoryInterface;
use App\Repository\Api\Team\TeamRepositoryInterface;
use App\Repository\Api\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class MissionService
{
    private $missionRepository;
    private $missionQuestionAnswerRepository;
    private $teamMemberRepository;
    private $feedbackRepository;
    private $userRepository;
    private $feedbackBaseRepository;
    private $missionQuestionAnswerBaseRepository;
    private $missionQuestionRepository;

    public function __construct(MissionRepositoryInterface $missionRepository, MissionQuestionAnswerRepositoryInterface $missionQuestionAnswerRepository,
                                TeamMemberRepositoryInterface $teamMemberRepository, FeedbackBaseRepository $feedbackBaseRepository,
                                FeedbackRepositoryInterface $feedbackRepository, UserRepository $userRepository, MissionQuestionAnswerBaseRepositoryInterface  $missionQuestionAnswerBaseRepository,
                                MissionQuestionRepositoryInterface $missionQuestionRepository)
    {
        $this->missionRepository = $missionRepository;
        $this->missionQuestionAnswerRepository = $missionQuestionAnswerRepository;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->feedbackRepository = $feedbackRepository;
        $this->userRepository = $userRepository;
        $this->feedbackBaseRepository = $feedbackBaseRepository;
        $this->missionQuestionAnswerBaseRepository = $missionQuestionAnswerBaseRepository;
        $this->missionQuestionRepository = $missionQuestionRepository;
    }

    public function getListByUserId(){
            $user = JWTAuth::user();
            $dataFind = [
                'user_id' => $user->id,
            ];
            if (request()->has('team_id')){
                $dataFind['team_id'] = request()->get('team_id');
            }
            $answered = $this->missionQuestionAnswerRepository->getListMissionByUserId($dataFind)->toArray();
            $notAnsweredByUser = $this->missionRepository->getListNotAnswerByUserId($dataFind);
            $notAnsweredUserTarget = $this->missionRepository->getListNotAnswerByUserTargetId($dataFind);
            $notAnswered = $notAnsweredByUser->merge($notAnsweredUserTarget)->toArray();
            usort($notAnswered , function ($a, $b){ return  strtotime($a->delivery_order_date) < strtotime($b->delivery_order_date)  ; });
              usort($answered, function ($a, $b){return  strtotime($a->delivery_order_date) < strtotime($b->delivery_order_date)  ;});
            $arrNotAnswered = [];
            foreach ($notAnswered as $mission){
                if ($mission->is_target){
                    if ($mission->target_user_id == $user->id){
                        $mission->user_target = $this->userRepository->findById($mission->target_user_id);
                        array_push($arrNotAnswered, $mission);
                    }
                } else{
                    $mission->user_target = null;
                    array_push($arrNotAnswered, $mission);
                }
            }
            foreach ($answered as $mission){
                if ($mission->target_user_id == $user->id){
                    $mission->user_target = $this->userRepository->findById($mission->target_user_id);
                } else {
                    $mission->user_target = null;
                }
            }
            return [
                'answered' => $answered,
                'not_answered' => $arrNotAnswered
            ];

    }

    public function getListQuestion(){
        $data = [
            'mission_id' => request()->get('id'),
            'user_id' => JWTAuth::user()->id
        ];
        $mission = $this->missionRepository->findById($data['mission_id']);
        if ($mission->target_user_id != null){
            $mission->user_target = $this->userRepository->findById($mission->user_id);
        }
        if (!$this->missionRepository->update($data['mission_id'], ['user_look_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')])) return false;
        $data['mission_created_at'] = $mission->created_at;
        return[
            'questions' => $this->missionQuestionRepository->getListByMissionId($data['mission_id']),
            'mission' => $mission
        ];
    }

    public function storeAnswerQuestion(){
        DB::beginTransaction();
        try {
            $user = JWTAuth::user();
            $missionId = request()->get('mission_id');
            $mission = $this->missionRepository->findById(request()->get('mission_id'));
            if (empty($mission)) return false;
            $answers = is_array(request()->get('answers')) ? request()->get('answers') : json_decode(request()->get('answers'));
            $numberQuestion = $this->missionQuestionRepository->getListByMissionId($missionId)->count();
            if(count($answers)  < $numberQuestion)  return ['status' => false, 'message' => __('api::message.mission.store_answer_not_enough')];
            foreach ($answers as $key => $answer){
                $answer = (object) $answer;
                $answer->delivery_order_number = $this->missionQuestionRepository->findByMissionQuestionBaseId(['mission_question_answer_base_id' => $answer->id, 'mission_id' => $missionId])->delivery_order_number;
                $answers[$key] = $answer;
            }
            usort($answers, function ($a, $b){ return $a->delivery_order_number > $b->delivery_order_number ? 1 : -1; });
            $is_anonymous = $mission->is_anonymous;
            foreach ($answers as $value){
                if(empty($value->answer)) {
                    DB::rollBack();
                    return ['status' => false, 'message' => __('api::message.mission.store_answer_not_enough')];
                }
                $answer = $value->answer;
                if ($value->type == 1 || $value->type == 2){
                    $choiceCopy = $value->choice;
                    foreach ($choiceCopy as $key => $choice){
                        if (!in_array($choice, $value->answer)) unset($choiceCopy[$key]);
                    }
                    $answer = implode(",", $choiceCopy);
                }
                if($value->type == 4) $answer = str_replace(env("AWS_URL"), "", $answer);
                $dataAnswer = [
                    'user_id' => $user->id,
                    'team_id' => $mission->team_id,
                    'program_id' => $mission->program_id,
                    'mission_id' => $mission->id,
                    'title' => $value->title,
                    'type' => $value->type,
                    'choice' => is_array($value->choice) ?  implode(",", $value->choice) : '',
                    'answer' => $answer,
                    'question_id' => $value->id,
                    'is_anonymous' => $is_anonymous,
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s')
                ];
                if (!$this->missionQuestionAnswerRepository->store($dataAnswer)) {
                    DB::rollBack();
                    return false;
                }
            }
            $missionSame = $this->missionRepository->getMissionSame(['team_id' => $mission->team_id, 'program_id'=> $mission->program_id, 'mission_base_id'=> $mission->mission_base_id, 'target_user_id' => null]);
            $userAnswered =$this->missionQuestionAnswerRepository->countUserAnswerQuestion(['mission_id' => $missionSame->pluck('id')->toArray(), 'team_id' => $mission->team_id]);
            $numberMissionSame = $missionSame->count();
            $percent = round(count($userAnswered)/$numberMissionSame, 1);
            if($mission->user_id != $user->id){
                $dataFeedback = ['mission_id' => $mission->id, 'user_id' => $mission->user_id];
                if (!$this->feedbackRepository->updateByUserTarget($dataFeedback)){
                    DB::rollBack();
                    return false;
                }
//                $feedback = $this->feedbackRepository->findByMissionIdAndUserId($dataFeedback);
//                $userOwnerMission = $this->userRepository->findById($mission->user_id);
//                $pushNotificationToken = $userOwnerMission->push_notification_token == null ? null : @json_decode($userOwnerMission->push_notification_token);
//                if (!is_null($pushNotificationToken)){
//                    if (!$this->userRepository->upNumberNotification($userOwnerMission->id)){
//                        DB::rollBack();
//                        return false;
//                    }
//                    $badge = $this->userRepository->findById($userOwnerMission->id)->number_notification;
//                    foreach ($pushNotificationToken as $objToken){
//                        $objToken->badge = $badge;
//                        $job = new SendNotificationNewFeedback($feedback, $objToken);
//                        dispatch($job)->delay(now()->addSeconds(2));
//                    }
//                }
            } else{
//                $teamMembers = $this->teamMemberRepository->getListMemberByTeamId($mission->team_id);
                $allMission = $this->missionRepository->getMissionSame(['team_id' => $mission->team_id, 'program_id'=> $mission->program_id, 'mission_base_id'=> $mission->mission_base_id]);
//                $usedToNotificationFeedback = [];
                foreach ($allMission as $item){
                    $dataUpdate = ['percent' => $percent, 'updated_at' => date('Y-m-d H:i:s')];
                    if ($percent > 0) $dataUpdate['public_time'] = date('Y-m-d H:i:s');
//                    $usedToNotificationFeedback[$item->user_id] = $this->feedbackRepository->findByMissionIdAndUserId(['mission_id' => $item->id, 'user_id' => $item->user_id])->percent >= 0.5;
                    if (!$this->feedbackRepository->updateByMission($dataUpdate , $item->id)){
                        DB::rollBack();
                        return false;
                    }
                }
//                if ($percent >= 0.5){
//                    foreach ($teamMembers as $member){
//                        if (!$usedToNotificationFeedback[$member->user_id]){
//                            $feedback = $this->feedbackRepository->findByMissionIdAndUserId(['mission_id' => $mission->id, 'user_id' => $mission->user_id]);
//                            $pushNotificationToken = $member->push_notification_token == null ? null : @json_decode($member->push_notification_token);
//                            if (!is_null($pushNotificationToken)){
//                                if (!$this->userRepository->upNumberNotification($member->user_id)){
//                                    DB::rollBack();
//                                    return false;
//                                }
//                                $badge = $this->userRepository->findById($member->user_id)->number_notification;
//                                foreach ($pushNotificationToken as $objToken){
//                                    $objToken->badge = $badge;
//                                    $job = new SendNotificationNewFeedback($feedback, $objToken);
//                                    dispatch($job)->delay(now()->addSeconds(2));
//                                }
//                            }
//                        }
//                    }
//                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            ResponseHelpers::messageSlack(['position' => 'store-answer', 'message' => $e->getMessage(), 'mission_id' => request()->get('mission_id')]);
            return false;
        }

    }

    public function getQuestionAnswered(){
            $mission = $this->missionRepository->findById(request()->get('mission_id'));
            if ($mission->target_user_id != null){
                $mission->user_target = $this->userRepository->findById($mission->user_id);
            }
            $questionAnswers = $this->missionQuestionAnswerRepository->getByMissionId(request()->get('mission_id'))->toArray();
            foreach ($questionAnswers as $answer){
                $answer->delivery_order_number = $this->missionQuestionRepository->findByMissionQuestionBaseId(['mission_question_answer_base_id' => $answer->question_id, 'mission_id' => $answer->mission_id])->delivery_order_number;
            }
            usort($questionAnswers, function ($a, $b){ return $a->delivery_order_number > $b->delivery_order_number ? 1 : -1; });
            return [
                'questions' => $questionAnswers,
                'mission' => $mission
            ] ;
    }

    public function updateQuestionAnswered(){
        DB::beginTransaction();
        try {
            $user = JWTAuth::user();
            $answers = is_array(request()->get('answers')) ? request()->get('answers') :  json_decode(request()->get('answers'));
            if(count($answers)  < $this->missionQuestionRepository->getListByMissionId(request()->get('mission_id'))->count())  return ['status' => false, 'message' => __('api::message.mission.store_answer_not_enough')];
            $mission = $this->missionRepository->findById(request()->get('mission_id'));
            $is_anonymous = $mission->is_anonymous;
            if (empty($mission)) return false;
            if (!$this->missionQuestionAnswerRepository->deleteByMissionId($mission->id)) return false;
            foreach ($answers as $key => $answer){
                $answer = (object) $answer;
                $answer->delivery_order_number = $this->missionQuestionRepository->findByMissionQuestionBaseId(['mission_question_answer_base_id' => $answer->question_id, 'mission_id' => $mission->id])->delivery_order_number;
                $answers[$key] = $answer;
            }
            usort($answers, function ($a, $b){ return $a->delivery_order_number > $b->delivery_order_number ? 1 : -1; });
            foreach ($answers as $value){
                if(empty($value->answer)) {
                    DB::rollBack();
                    return ['status' => false, 'message' => __('api::message.mission.store_answer_not_enough')];
                }
                $answer = $value->answer;
                if ($value->type == 1 || $value->type == 2){
                    $choiceCopy = $value->choice;
                    foreach ($choiceCopy as $key => $choice){
                        if (!in_array($choice, $value->answer)) unset($choiceCopy[$key]);
                    }
                    $answer = implode(",", $choiceCopy);
                }
                if($value->type == 4) $answer = str_replace(env("AWS_URL"), "", $answer);
                $dataAnswer = [
                    'user_id' => $user->id,
                    'team_id' => $mission->team_id,
                    'program_id' => $mission->program_id,
                    'mission_id' => $mission->id,
                    'title' => $value->title,
                    'type' => $value->type,
                    'choice' => is_array($value->choice) ?  implode(",", $value->choice) : '',
                    'answer' => $answer,
                    'question_id' => $value->question_id,
                    'is_anonymous' => $is_anonymous,
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s')
                ];
                if (!$this->missionQuestionAnswerRepository->store($dataAnswer)) {
                    DB::rollBack();
                    return false;
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function getMissionDaily(){
        $missions = $this->missionRepository->getList();
        $missionDaily = [];
        foreach ($missions as $mission){
            if (strtotime(date('Y-m-d')) == strtotime($mission->delivery_order_date) && $mission->user_look_at == null){
                $objMission = (object)[];
                $objMission->mission_id = $mission->id;
                $objMission->team_id = $mission->team_id;
                $objMission->name = $mission->name;
                $objMission->detail = $mission->detail;
                $objMission->thumbnail_url = $mission->thumbnail_url;
                $objMission->user_push_notification = [];
                $objMission->user_id = $mission->user_id;
                $user = $this->userRepository->findById($mission->user_id);
                if($user->push_notification_token != null){
                    foreach (@json_decode($user->push_notification_token) as $item){
                       array_push($objMission->user_push_notification, $item);
                    }
                }
                array_push($missionDaily, $objMission);
            }
        }
        return $missionDaily;
    }
}