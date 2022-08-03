<?php


namespace App\Service\Api;


use App\Repository\Api\Feedback\FeedbackRepositoryInterface;
use App\Repository\Api\Mission\MissionQuestionAnswerBaseRepositoryInterface;
use App\Repository\Api\Mission\MissionQuestionAnswerRepository;
use App\Repository\Api\Mission\MissionRepositoryInterface;
use App\Repository\Api\Team\TeamMemberRepositoryInterface;
use App\Repository\Api\User\UserRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class FeedbackService
{
    private $feedbackRepository;
    private $missionQuestionAnsweredRepository;
    private $userRepository;
    private $teamMemberRepository;
    private $missionRepository;

    public function __construct(FeedbackRepositoryInterface     $feedbackRepository, MissionRepositoryInterface $missionRepository,
                                MissionQuestionAnswerRepository $missionQuestionAnsweredRepository,
                                UserRepositoryInterface         $userRepository, TeamMemberRepositoryInterface $teamMemberRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
        $this->missionQuestionAnsweredRepository = $missionQuestionAnsweredRepository;
        $this->userRepository = $userRepository;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->missionRepository = $missionRepository;
    }

    public function getList()
    {
        $data = [
            'id' => JWTAuth::user()->id,
        ];
        if (request()->has('team_id')) {
            $data['team_id'] = request()->get('team_id');
        }
        $feedbacks = $this->feedbackRepository->getList($data);
        $feedbackFilter = [];
        foreach ($feedbacks as $feedback) {
            if($feedback->is_target){
                $mission = $this->missionRepository->findById($feedback->mission_id);
                if (empty($mission)) return false;
                $missionSame = $this->missionRepository->findMissionTarget(['team_id' => $mission->team_id, 'program_id' => $mission->program_id, 'user_id' => $feedback->user_id]);
                $feedback->answers = empty($missionSame) ? 0 : $this->missionQuestionAnsweredRepository->getByMissionId($missionSame->id)->count();
            } else{
                $feedback->answers = $this->missionQuestionAnsweredRepository->getByMissionId($feedback->mission_id)->count();
            }
            if ($feedback->percent > 0) array_push($feedbackFilter, $feedback);
        }
        return request()->header('api') == 'v3' ?  $feedbacks : $feedbackFilter;
    }

    public function findById()
    {
        $id = request()->get('id');
        $feedback = $this->feedbackRepository->findById($id);
        $mission = $this->missionRepository->findById($feedback->mission_id);
        if (!is_null($mission->target_user_id)) {
            $feedback->user_target = $this->userRepository->findById($mission->user_id);
        }
        $missionSame = $this->missionRepository->getMissionSame((array)$mission);
        $answers = $this->missionQuestionAnsweredRepository->getAllByMissionId($missionSame->pluck('id'));
        $groupAnswer = [];
        foreach ($answers as $value) {
            $groupAnswer[$value->question_id] = empty($groupAnswer[$value->question_id]) ? [] : $groupAnswer[$value->question_id];
            $groupAnswer[$value->question_id]['title'] = $value->title;
            $groupAnswer[$value->question_id]['list_answer'] = !empty($groupAnswer[$value->question_id]['list_answer']) ? $groupAnswer[$value->question_id]['list_answer'] : [];
            $user = $this->userRepository->findById($value->user_id);
            array_push($groupAnswer[$value->question_id]['list_answer'], [
                'user' => $value->is_anonymous ? __('api::message.user.anonymous') : $user->name_sei . $user->name_mei . '/' . $user->name_sei_kana . $user->name_mei_kana,
                'type' => $value->type,
                'answer' => ($value->type == 1) ? explode(",", $value->answer) : $value->answer
            ]);
        }

        if (!$this->feedbackRepository->update($id, ['updated_at' => date('Y-m-d H:i:s'), 'user_look_at' => date('Y-m-d H:i:s')])) return false;
        return [
            'feedback' => $feedback,
            'answers' => $groupAnswer
        ];
    }

    public function getFeedbackDaily()
    {
        $feedbacks = $this->feedbackRepository->getEligibleShow();
        $dateYesterday = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
        $feedbackDaily = [];
        foreach ($feedbacks as $feedback) {
            if ($feedback->updated_at != null) {
                if (strtotime(date('Y-m-d')) == strtotime(date('Y-m-d', strtotime($feedback->updated_at))) || strtotime($dateYesterday) == strtotime(date('Y-m-d', strtotime($feedback->updated_at)))) {
                    $objFeedback = (object)[];
                    $objFeedback->title = $feedback->title;
                    $objFeedback->detail = $feedback->detail;
                    $objFeedback->thumbnail_url = $feedback->thumbnail_url;
                    $objFeedback->user_push_notification = [];
                    $user_look_at = $feedback->user_look_at == null ? null : array_keys((array)@json_decode($feedback->user_look_at));
                    $teamMember = $this->teamMemberRepository->getListMemberByTeamId($feedback->team_id)->pluck('user_id');
                    foreach ($teamMember as $member) {
                        if ($user_look_at != null) {
                            if (!in_array($member, $user_look_at)) {
                                $token = $this->userRepository->findById($member)->push_notification_token;
                                if ($token != null) {
                                    foreach (@json_decode($token) as $item) {
                                        array_push($objFeedback->user_push_notification, $item);
                                    }
                                }
                            }
                        } else {
                            $token = $this->userRepository->findById($member)->push_notification_token;
                            if ($token != null) {
                                foreach (@json_decode($token) as $item) {
                                    array_push($objFeedback->user_push_notification, $item);
                                }

                            }
                        }
                    }
                    array_push($feedbackDaily, $objFeedback);
                }
            }
        }
        return $feedbackDaily;
    }
}