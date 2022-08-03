<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 28/05/2021
 * Time: 09:15
 */

namespace App\Service\Api;


use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Repository\Api\Feedback\FeedbackBaseRepositoryInterface;
use App\Repository\Api\Feedback\FeedbackRepositoryInterface;
use App\Repository\Api\Mission\MissionBaseRepositoryInterface;
use App\Repository\Api\Mission\MissionQuestionAnswerBaseRepositoryInterface;
use App\Repository\Api\Mission\MissionQuestionAnswerRepositoryInterface;
use App\Repository\Api\Mission\MissionRepositoryInterface;
use App\Repository\Api\MissionQuestion\MissionQuestionRepositoryInterface;
use App\Repository\Api\Notification\BrandNotificationRepositoryInterface;
use App\Repository\Api\Notification\SystemNotificationRepositoryInterface;
use App\Repository\Api\ProgramHistory\ProgramHistoryRepositoryInterface;
use App\Repository\Api\ProgramMission\ProgramMissionRepositoryInterface;
use App\Repository\Api\Team\TeamMemberRepositoryInterface;
use App\Repository\Api\Team\TeamRepositoryInterface;
use App\Repository\Api\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Auth;
use PHPUnit\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class TeamService
{
    private $teamRepository;
    private $teamMemberRepository;
    private $programMissionRepository;
    private $missionBaseRepository;
    private $missionRepository;
    private $feedbackRepository;
    private $feedbackBaseRepository;
    private $missionQuestionAnswerRepository;
    private $userRepository;
    private $programHistoryRepository;
    private $missionQuestionAnswerBaseRepository;
    private $missionQuestionRepository;
    private $brandNotificationRepository;
    private $systemNotificationRepository;

    public function __construct(TeamRepositoryInterface                  $teamRepository, TeamMemberRepositoryInterface $teamMemberRepository,
                                MissionService                           $missionService, ProgramMissionRepositoryInterface $programMissionRepository,
                                MissionBaseRepositoryInterface           $missionBaseRepository, MissionRepositoryInterface $missionRepository,
                                FeedbackRepositoryInterface              $feedbackRepository, FeedbackBaseRepositoryInterface $feedbackBaseRepository,
                                MissionQuestionAnswerRepositoryInterface $missionQuestionAnswerRepository, UserRepositoryInterface $userRepository,
                                ProgramHistoryRepositoryInterface        $programHistoryRepository, MissionQuestionAnswerBaseRepositoryInterface $missionQuestionAnswerBaseRepository,
                                MissionQuestionRepositoryInterface $missionQuestionRepository, BrandNotificationRepositoryInterface $brandNotificationRepository,
                                SystemNotificationRepositoryInterface $systemNotificationRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->programMissionRepository = $programMissionRepository;
        $this->missionBaseRepository = $missionBaseRepository;
        $this->missionRepository = $missionRepository;
        $this->feedbackRepository = $feedbackRepository;
        $this->feedbackBaseRepository = $feedbackBaseRepository;
        $this->missionQuestionAnswerRepository = $missionQuestionAnswerRepository;
        $this->userRepository = $userRepository;
        $this->programHistoryRepository = $programHistoryRepository;
        $this->missionQuestionAnswerBaseRepository = $missionQuestionAnswerBaseRepository;
        $this->missionQuestionRepository = $missionQuestionRepository;
        $this->brandNotificationRepository = $brandNotificationRepository;
        $this->systemNotificationRepository = $systemNotificationRepository;
    }

    public function checkIsLeader($team_id){
        $teamMember =  $this->teamMemberRepository->getListMemberByTeamId($team_id);
        $user = JWTAuth::user();
        if(!in_array($user->id, $teamMember->pluck('user_id')->toArray())) return false;
        $teamMember = $teamMember->toArray();
        for ($w = 0; $w < count($teamMember); $w++){
            if($teamMember[$w]->user_id == $user->id && !$teamMember[$w]->is_leader) return false;
        }
        return true;
    }

    public function checkIsMember($team_id){
        $teamMember =  $this->teamMemberRepository->getListMemberByTeamId($team_id);
        $user = JWTAuth::user();
        return in_array($user->id, $teamMember->pluck('user_id')->toArray());
    }

    public function getList()
    {
        $user = JWTAuth::user();
        return $this->teamRepository->getListByUser($user);
    }

    public function getListMemberByTeamId()
    {
        $teamId = request()->get('id');
        $userOfBrand = $this->userRepository->getListByBrandId(JWTAuth::user()->brand_id);
        $members = $this->teamMemberRepository->getListMemberByTeamId($teamId);
        $pluckLeaderMembers = $members->pluck('is_leader', 'user_id')->toArray();
        $pluckIdMember = $members->pluck('id', 'user_id')->toArray();
        $collectionMember = new Collection();
        foreach ($userOfBrand as $user) {
            if (!request()->has('type')) {
                if (in_array($user->id, array_keys($pluckLeaderMembers))) {
                    $user->is_team_member = in_array($user->id, array_keys($pluckLeaderMembers)) ? 1 : 0;
                    $user->is_leader = $user->is_team_member ? $pluckLeaderMembers[$user->id] : 0;
                    $user->team_member_id = $pluckIdMember[$user->id];
                    $collectionMember->push($user);
                }
            } else {
                $user->is_team_member = in_array($user->id, array_keys($pluckLeaderMembers)) ? 1 : 0;
                $user->is_leader = $user->is_team_member ? $pluckLeaderMembers[$user->id] : 0;
                $collectionMember->push($user);
            }

        }
        $arrMember = $collectionMember->toArray();
        usort($arrMember, function ($a, $b){return $a->is_leader < $b->is_leader || $a->is_team_member < $b->is_team_member || $a->id > $b->id;});
        return $arrMember;
    }

    public function detailMember()
    {
        $memberId = request()->get('id');
        return $this->teamMemberRepository->findById($memberId);
    }

    function getRandomUserIdTarget($arrUserId, $arrContain, $idUserCurrent)
    {
        $id = null;
        if (count($arrUserId) % 2 != 0 && $idUserCurrent == $arrUserId[0] ){
            unset($arrUserId[1]);
        }
        do {
            $id = $arrUserId[array_rand($arrUserId)];
        } while (in_array($id, $arrContain) || $id == $idUserCurrent);
        return $id;
    }

    public function store()
    {
        DB::beginTransaction();
        try {
//            ResponseHelpers::messageSlack(request()->get('data'));
            $data = json_decode(request()->get('data'));
            $collectUser = collect($data->users);
            if ($collectUser->count() < 2) return ['status' => false, 'message' => __('api::message.team.error_more_two_people')];
            if (!$collectUser->where('is_leader', true)->count()) return ['status' => false, 'message' => __('api::message.team.error_require_leader')];
//            if ($collectUser->where('is_leader', true)->count() > 1) return ['status' => false, 'message' => __('api::message.team.error_only_leader')];
            $currentUser = JWTAuth::user();
            $brandId = $currentUser->brand_id;
            $dataInsertTeam = [
                'name' => $data->team->name,
                'thumbnail_url' => str_replace(env("AWS_URL"), "", $data->team->thumbnail_url),
                'program_id' => $data->program_id,
                'brand_id' => $brandId,
                'program_started_at' => date('Y/m/d H:i:s'),
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            $teamId = $this->teamRepository->store($dataInsertTeam);
            if (!$teamId) {
                DB::rollBack();
                return ['status' => false, 'message' => __('api::message.team.create_failed')];
            }
            foreach ($data->users as $user) {
                $dataInsertTeamMember = [
                    'user_id' => $user->id,
                    'is_leader' => $user->is_leader,
                    'team_id' => $teamId,
                    'brand_id' => $brandId,
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s')
                ];
                if (!$this->teamMemberRepository->store($dataInsertTeamMember)) {
                    DB::rollBack();
                    return ['status' => false, 'message' => __('api::message.team.create_failed')];
                }
            }

            $programMissions = $this->programMissionRepository->getListByProgramId($data->program_id);
            $arrDataMission = [];
            foreach ($programMissions as $programMission) {
                $missionBase = $this->missionBaseRepository->findById($programMission->mission_id);
                if (empty($missionBase)) return false;
                $arrRandomId = [];
                foreach ($data->users as $user) {
                    $userRandom = null;
                    if ($missionBase->is_target) {
                        $userId = (new Collection($data->users))->pluck('id')->toArray();
                        $userRandom = $this->getRandomUserIdTarget($userId, $arrRandomId, $user->id);
                        array_push($arrRandomId, $userRandom);
                    }
                    $dataMission = [
                        'target_user_id' => $missionBase->is_target ? $userRandom : null,
                        'user_id' => $user->id,
                        'team_id' => $teamId,
                        'program_id' => $data->program_id,
                        'mission_base_id' => $programMission->mission_id,
                        'name' => $missionBase->name,
                        'detail' => $missionBase->detail,
                        'thumbnail_url' => $missionBase->thumbnail_url,
                        'delivery_order_date' => date('Y-m-d', strtotime("+" . ($programMission->delivery_date_number - 1) . " days", strtotime(date('Y-m-d')))),
                        'created_at' => date('Y-m-d H:i:s'),
                        'time_required' => $missionBase->time_required,
                        'is_anonymous' => $missionBase->is_anonymous
                    ];
                    array_push($arrDataMission, $dataMission);
                    $missionId = $this->missionRepository->store($dataMission);
                    if (!$missionId) {
                        DB::rollBack();
                        return ['status' => false, 'message' => __('api::message.team.create_failed')];
                    }
                    $feedbackBase = $this->feedbackBaseRepository->findByMissionBaseId($programMission->mission_id);
                    $dataFeedback = [
                        'mission_id' => $missionId,
                        'user_id' => $user->id,
                        'title' => $feedbackBase->title,
                        'detail' => $feedbackBase->detail,
                        'thumbnail_url' => $feedbackBase->thumbnail_url,
                        'hint_title' => $feedbackBase->hint_title,
                        'hint_detail' => $feedbackBase->hint_detail,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    if (!$this->feedbackRepository->store($dataFeedback)) {
                        DB::rollBack();
                        return ['status' => false, 'message' => __('api::message.team.create_failed')];
                    }
                    $missionQuestionAnswerBase = $this->missionQuestionAnswerBaseRepository->getByMissionBaseId($missionBase->id);
                    $dataMissionQuestion = [];
                    foreach ($missionQuestionAnswerBase as $question){
                        array_push($dataMissionQuestion, [
                            'mission_id' => $missionId,
                            'mission_question_answer_base_id' => $question->id,
                            'title' => $question->title,
                            'type' => $question->type,
                            'choice' => $question->choice,
                            'delivery_order_number' => $question->delivery_order_number,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    }
                    if (!empty($dataMissionQuestion)){
                        if (!$this->missionQuestionRepository->store($dataMissionQuestion)) {
                            DB::rollBack();
                            ResponseHelpers::messageSlack([
                                'mission_base_id' => $missionBase->id,
                                'program_id' => $data->program_id
                            ]);
                            return ['status' => false, 'message' => __('api::message.team.create_failed')];
                        }
                    } else{
                        ResponseHelpers::messageSlack([
                            'mission_base_id' => $missionBase->id,
                            'program_id' => $data->program_id
                        ]);
                    }
                }
            }
            DB::commit();
            return ['status' => true, 'id' => $teamId];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'message' => __('api::message.team.create_failed')];
        }
    }

    public function update()
    {
        $teamId = request()->get('team_id');
        $dataUpdateTeam = [
            'name' => Helpers::getParamRequest('name'),
            'thumbnail_url' => str_replace(env("AWS_URL"), "", Helpers::getParamRequest('thumbnail_url')),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        return $this->teamRepository->update($teamId, $dataUpdateTeam);
    }

    public function detail()
    {
        $id = request()->has('team_id') ? request()->get('team_id') : request()->get('id');
        $team = $this->teamRepository->findById($id);
        if (empty($team)) return null;
        if (!$this->checkIsMember($id)) return false;
        $team->is_edit  = $this->checkIsLeader($id);
        return $team;
    }

    public function updateProgram()
    {
        DB::beginTransaction();
        try {
            $teamId = request()->get('team_id');
            $programId = request()->get('program_id');
            $team = $this->teamRepository->findById($teamId);
            $missions = $this->missionRepository->getListByTeam(['team_id' => $team->id, 'program_id' => $team->program_id]);
            foreach ($missions as $mission) {
                $feedback = $this->feedbackRepository->getByMission($mission->id);
                if (!empty($feedback)) {
                    if (!$this->feedbackRepository->delete($feedback->id)) {
                        DB::rollBack();
                        return false;
                    }
                }
                if (!$this->missionRepository->delete($mission->id)) {
                    DB::rollBack();
                    return false;
                }
                if (!$this->missionQuestionRepository->deleteByMissionId($mission->id)){
                    DB::rollBack();
                    return false;
                }
                if (!$this->missionQuestionAnswerRepository->deleteByMissionId($mission->id)){
                    DB::rollBack();
                    return false;
                }
            }
            $members = $this->teamMemberRepository->getListMemberByTeamId($teamId);
            $programMissions = $this->programMissionRepository->getListByProgramId($programId);
            foreach ($programMissions as $programMission) {
                $missionBase = $this->missionBaseRepository->findById($programMission->mission_id);
                if (empty($missionBase)) return false;
                $arrRandomId = [];
                foreach ($members as $user) {
                    $userRandom = null;
                    if ($missionBase->is_target) {
                        $userId = $members->pluck('user_id')->toArray();
                        $userRandom = $this->getRandomUserIdTarget($userId, $arrRandomId, $user->user_id);
                        array_push($arrRandomId, $userRandom);
                    }
                    $dataMission = [
                        'target_user_id' => $missionBase->is_target ? $userRandom : null,
                        'user_id' => $user->user_id,
                        'team_id' => $teamId,
                        'program_id' => $programId,
                        'mission_base_id' => $programMission->mission_id,
                        'name' => $missionBase->name,
                        'detail' => $missionBase->detail,
                        'thumbnail_url' => $missionBase->thumbnail_url,
                        'delivery_order_date' => date('Y-m-d', strtotime("+" . ($programMission->delivery_date_number - 1) . " days", strtotime(date('Y-m-d')))),
                        'created_at' => date('Y-m-d H:i:s'),
                        'time_required' => $missionBase->time_required,
                        'is_anonymous' => $missionBase->is_anonymous
                    ];
                    $missionId = $this->missionRepository->store($dataMission);
                    if (!$missionId) {
                        DB::rollBack();
                        return false;
                    }
                    $feedbackBase = $this->feedbackBaseRepository->findByMissionBaseId($programMission->mission_id);
                    $dataFeedback = [
                        'mission_id' => $missionId,
                        'user_id' => $user->user_id,
                        'title' => $feedbackBase->title,
                        'detail' => $feedbackBase->detail,
                        'thumbnail_url' => $feedbackBase->thumbnail_url,
                        'hint_title' => $feedbackBase->hint_title,
                        'hint_detail' => $feedbackBase->hint_detail,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    if (!$this->feedbackRepository->store($dataFeedback)) {
                        DB::rollBack();
                        return false;
                    }
                    $missionQuestionAnswerBase = $this->missionQuestionAnswerBaseRepository->getByMissionBaseId($missionBase->id);
                    $dataMissionQuestion = [];
                    foreach ($missionQuestionAnswerBase as $question){
                        array_push($dataMissionQuestion, [
                            'mission_id' => $missionId,
                            'mission_question_answer_base_id' => $question->id,
                            'title' => $question->title,
                            'type' => $question->type,
                            'choice' => $question->choice,
                            'delivery_order_number' => $question->delivery_order_number,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    }
                    if (!empty($dataMissionQuestion)){
                        if (!$this->missionQuestionRepository->store($dataMissionQuestion)) {
                            DB::rollBack();
                            return  false;
                        }
                    }
                }
            }
            $dataUpdate = [
                'program_id' => $programId,
                'updated_at' => date('Y/m/d H:i:s')
            ];
            if (!$this->teamRepository->update(request()->get('team_id'), $dataUpdate)) {
                DB::rollBack();
                return false;
            }
            $dataProgramHistory = [
                'team_id' => $teamId,
                'program_id' => $programId,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if (!$this->programHistoryRepository->store($dataProgramHistory)) {
                DB::rollBack();
                return false;
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }

    }

    public function updateMember()
    {
        DB::beginTransaction();
        try {
            $teamId = request()->get('team_id');
            $team = $this->teamRepository->findById($teamId);
            if (empty($team)) return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
            $programId = $team->program_id;
            $brandId = $team->brand_id;
            $members = json_decode(request()->get('members'));
            $collectUser = collect($members);
            if ($collectUser->count() < 2) return ['status' => false, 'message' => __('api::message.team.error_more_two_people')];
            if (!$collectUser->where('is_leader', true)->count()) return ['status' => false, 'message' => __('api::message.team.error_require_leader')];
//            if ($collectUser->where('is_leader', true)->count() > 1) return ['status' => false, 'message' => __('api::message.team.error_only_leader')];
            $arrUserIdFromInput = $collectUser->pluck('id')->toArray();
            $arrUserIdCurrent = $this->teamMemberRepository->getListMemberByTeamId($teamId)->pluck('user_id')->toArray();
            $arrMemberNew = array_diff($arrUserIdFromInput, $arrUserIdCurrent);
            $arrMemberDelete = array_diff($arrUserIdCurrent, $arrUserIdFromInput);
            //case 1: No member delete, only change leader
            if(empty($arrMemberNew) && empty($arrMemberDelete)){
                $teamMembers = $this->teamMemberRepository->getListMemberByTeamId($teamId);
                foreach ($teamMembers as $member){
                    $dataUpdateMember = [
                        'is_leader' => $collectUser->where('id', $member->user_id)->first()->is_leader,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    if(!$this->teamMemberRepository->update($member->id ,$dataUpdateMember)){
                        DB::rollBack();
                        return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
                    }
                }
            } else{
                //delete members
                if (!empty($arrMemberDelete)){
                    foreach ($arrMemberDelete as $userId){
                        if (!$this->teamMemberRepository->deleteByUserIdAndTeamId($userId, $teamId)){
                            DB::rollBack();
                            return false;
                        }
                    }
                    $missionDelete = $this->missionRepository->getListByUserAndTeamId($arrMemberDelete, $teamId);
                    foreach ($missionDelete as $mission) {
                        $feedback = $this->feedbackRepository->getByMission($mission->id);
                        if (!empty($feedback)) {
                            if (!$this->feedbackRepository->delete($feedback->id)) {
                                DB::rollBack();
                                return false;
                            }
                        }
                        if (!$this->missionRepository->delete($mission->id)) {
                            DB::rollBack();
                            return false;
                        }
                        if (!$this->missionQuestionRepository->deleteByMissionId($mission->id)){
                            DB::rollBack();
                            return false;
                        }
                        if (!$this->missionQuestionAnswerRepository->deleteByMissionId($mission->id)){
                            DB::rollBack();
                            return false;
                        }
                    }
                }
                $teamMembers = $this->teamMemberRepository->getListMemberByTeamId($teamId);
                $missions = $this->missionRepository->getListByTeam(['team_id' => $teamId, 'program_id' => $programId]);
                $arrMissionBaseOfProgram = [];
                $setOfQuestionsByMissionBaseNotTarget = [];
                $setOfQuestionsByMissionBaseHasTarget = [];
                $arrMissionBaseHasTarget = [];
                $arrMissionBaseNotTarget = [];
                $listFirstMissionEachMissionBaseNotTarget = [];
                $listFirstMissionEachMissionBaseHasTarget = [];
                $listFirstFeedbackEachMissionBaseNotTarget = [];
                $listFirstFeedbackEachMissionBaseHasTarget = [];
                $totalMember = count($members);
                foreach ($missions as $mission){
                    if (!in_array($mission->mission_base_id, $arrMissionBaseOfProgram)){
                        if (!is_null($mission->target_user_id) && strtotime($mission->delivery_order_date) > strtotime(date('Y-m-d'))){
                            array_push($arrMissionBaseHasTarget, $mission);
                            array_push($listFirstMissionEachMissionBaseHasTarget, $mission);
                            array_push($listFirstFeedbackEachMissionBaseHasTarget, $this->feedbackRepository->getByMission($mission->id));
                            $setOfQuestionsByMissionBaseHasTarget[$mission->mission_base_id] = $this->missionQuestionRepository->getListByMissionId($mission->id)->toArray();
                            array_push($arrMissionBaseOfProgram, $mission->mission_base_id);
                        }
                        if (is_null($mission->target_user_id) && strtotime($mission->delivery_order_date) > strtotime(date('Y-m-d'))){
                            array_push($arrMissionBaseNotTarget, $mission);
                            array_push($listFirstMissionEachMissionBaseNotTarget, $mission);
                            array_push($listFirstFeedbackEachMissionBaseNotTarget, $this->feedbackRepository->getByMission($mission->id));
                            $setOfQuestionsByMissionBaseNotTarget[$mission->mission_base_id] = $this->missionQuestionRepository->getListByMissionId($mission->id)->toArray();
                            array_push($arrMissionBaseOfProgram, $mission->mission_base_id);
                        }
                    }
                }
                if (!empty($arrMemberNew)){
                    $dataInsertMembers = [];
                    foreach ($arrMemberNew as $userId){
                        array_push($dataInsertMembers, [
                            'user_id' => $userId,
                            'is_leader' => $collectUser->where('id', $userId)->first()->is_leader,
                            'team_id' => $teamId,
                            'brand_id' => $brandId,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                    if (!$this->teamMemberRepository->store($dataInsertMembers)){
                        DB::rollBack();
                        return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
                    }
                    //case:  mission is target
                    if(!empty($arrMissionBaseHasTarget)){
                        $listFirstMissionEachMissionBase = collect($listFirstMissionEachMissionBaseHasTarget);
                        $listFirstFeedbackEachMissionBase = collect($listFirstFeedbackEachMissionBaseHasTarget);
                        foreach ($listFirstMissionEachMissionBaseHasTarget as $mission){
                            $feedbackSample = $listFirstFeedbackEachMissionBase->where('mission_id', $mission->id)->first();
                            foreach ($arrMemberNew as $userId){
                                $dataInsertMission = [
                                    'target_user_id' => null,
                                    'user_id' => $userId,
                                    'team_id' => $teamId,
                                    'program_id' => $programId,
                                    'mission_base_id' => $mission->mission_base_id,
                                    'name' => $mission->name,
                                    'detail' => $mission->detail,
                                    'thumbnail_url' => $mission->thumbnail_url,
                                    'delivery_order_date' => $mission->delivery_order_date,
                                    'time_required' => $mission->time_required,
                                    'is_anonymous' => $mission->is_anonymous,
                                    'created_at' => date('Y-m-d H:i:s')
                                ];
                                $missionId = $this->missionRepository->store($dataInsertMission);
                                if (!$missionId){
                                    DB::rollBack();
                                    return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
                                }
                                // insert feedback
                                $dataInsertFeedback = [
                                    'mission_id' => $missionId,
                                    'user_id' => $userId,
                                    'title' => $feedbackSample->title,
                                    'detail' => $feedbackSample->detail,
                                    'thumbnail_url' => $feedbackSample->thumbnail_url,
                                    'hint_title' => $feedbackSample->hint_title,
                                    'hint_detail' => $feedbackSample->hint_detail,
                                    'percent' => 0,
                                    'created_at' => date('Y-m-d H:i:s')
                                ];
                                if (!$this->feedbackRepository->store($dataInsertFeedback)){
                                    DB::rollBack();
                                    return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
                                }
                                // insert question
                                $arrDataInsertQuestion = [];
                                foreach ($setOfQuestionsByMissionBaseHasTarget[$mission->mission_base_id] as $question){
                                    array_push($arrDataInsertQuestion, [
                                        'mission_id' => $missionId,
                                        'mission_question_answer_base_id' => $question->id,
                                        'title' => $question->title,
                                        'type' => $question->type,
                                        'choice' => $question->choice,
                                        'delivery_order_number' => $question->delivery_order_number,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                                }
                                if (!empty($arrDataInsertQuestion)){
                                    if (!$this->missionQuestionRepository->store($arrDataInsertQuestion)) {
                                        DB::rollBack();
                                        return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
                                    }
                                }
                            }
                            $missionSame = $this->missionRepository->getMissionSame(['team_id' => $teamId, 'mission_base_id' => $mission->mission_base_id, 'program_id' => $programId]);
                            $arrRandomId = [];
                            $arrUserId = (new Collection($members))->pluck('id')->toArray();
                            foreach ($missionSame as $missionSameItem) {
                                $userRandom = null;
                                $userRandom = $this->getRandomUserIdTarget($arrUserId, $arrRandomId, $missionSameItem->user_id);
                                array_push($arrRandomId, $userRandom);
                                if (!$this->missionRepository->update($missionSameItem->id, ['target_user_id' => $userRandom, 'updated_at' =>date('Y-m-d H:i:s')])){
                                    DB::rollBack();
                                    return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
                                }
                            }
                        }

                    }
                    //case 2.2:  mission not target
                    if (!empty($arrMissionBaseNotTarget)){
                        // add new mission and team member
                        $listFirstFeedbackEachMissionBase = collect($listFirstFeedbackEachMissionBaseNotTarget);
                        foreach ($listFirstMissionEachMissionBaseNotTarget as $mission){
                            $feedbackSample = $listFirstFeedbackEachMissionBase->where('mission_id', $mission->id)->first();
                            foreach ($arrMemberNew as $userId){
                                $dataInsertMission = [
                                    'target_user_id' => null,
                                    'user_id' => $userId,
                                    'team_id' => $teamId,
                                    'program_id' => $programId,
                                    'mission_base_id' => $mission->mission_base_id,
                                    'name' => $mission->name,
                                    'detail' => $mission->detail,
                                    'thumbnail_url' => $mission->thumbnail_url,
                                    'delivery_order_date' => $mission->delivery_order_date,
                                    'time_required' => $mission->time_required,
                                    'is_anonymous' => $mission->is_anonymous,
                                    'created_at' => date('Y-m-d H:i:s')
                                ];
                                $missionId = $this->missionRepository->store($dataInsertMission);
                                if (!$missionId){
                                    DB::rollBack();
                                    return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
                                }
                                // insert feedback
                                $dataInsertFeedback = [
                                    'mission_id' => $missionId,
                                    'user_id' => $userId,
                                    'title' => $feedbackSample->title,
                                    'detail' => $feedbackSample->detail,
                                    'thumbnail_url' => $feedbackSample->thumbnail_url,
                                    'hint_title' => $feedbackSample->hint_title,
                                    'hint_detail' => $feedbackSample->hint_detail,
                                    'percent' => 0,
                                    'created_at' => date('Y-m-d H:i:s')
                                ];
                                if (!$this->feedbackRepository->store($dataInsertFeedback)){
                                    DB::rollBack();
                                    return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
                                }
                                // insert question
                                $arrDataInsertQuestion = [];
                                foreach ($setOfQuestionsByMissionBaseNotTarget[$mission->mission_base_id] as $question){
                                    array_push($arrDataInsertQuestion, [
                                        'mission_id' => $missionId,
                                        'mission_question_answer_base_id' => $question->id,
                                        'title' => $question->title,
                                        'type' => $question->type,
                                        'choice' => $question->choice,
                                        'delivery_order_number' => $question->delivery_order_number,
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                                }
                                if (!empty($arrDataInsertQuestion)){
                                    if (!$this->missionQuestionRepository->store($arrDataInsertQuestion)) {
                                        DB::rollBack();
                                        return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
                                    }
                                }
                            }
                        }
                    }
                }
            }
            DB::commit();
            return ['status' => true];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'message' => __('api::message.team.edit_member_failed')];
        }
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $teamId = request()->get('team_id');
            $team = $this->teamRepository->findById($teamId);
            $brandNotification = $this->brandNotificationRepository->getList(['brand_id' => $team->brand_id]);
            foreach ($brandNotification as $notify){
                if ($notify->type == 'team'){
                    $option = @json_decode($notify->option);
                    if ($option->team_id == $teamId){
                        if (!$this->brandNotificationRepository->delete($notify->id)){
                            DB::rollBack();
                            return  false;
                        }
                    }
                }
            }
            $systemNotification = $this->systemNotificationRepository->getList([]);
            foreach ($systemNotification as $notify){
                if ($notify->type == 'team'){
                    $option = @json_decode($notify->option);
                    if ($option->team_id == $teamId){
                        if (!$this->systemNotificationRepository->delete($notify->id)){
                            DB::rollBack();
                            return  false;
                        }
                    }
                }
            }
            if (!$this->teamRepository->delete($teamId)) return false;
            if (!$this->teamMemberRepository->deleteByTeamId($teamId)) {
                DB::rollBack();
                return false;
            }
            $missions = $this->missionRepository->getListByTeam(['team_id' => $teamId, 'program_id' => $team->program_id]);
            foreach ($missions as $mission) {
                if (!$this->missionRepository->delete($mission->id) || !$this->feedbackRepository->deleteByMissionId($mission->id) ||
                    !$this->missionQuestionAnswerRepository->deleteByMissionId($mission->id) || !$this->missionQuestionRepository->deleteByMissionId($mission->id)) {
                    DB::rollBack();
                    return false;
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}