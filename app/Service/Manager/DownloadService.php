<?php

namespace App\Service\Manager;


use App\Helpers\Helpers;
use App\Repository\Manager\Brand\BrandRepositoryInterface;
use App\Repository\Manager\Feedback\FeedbackRepositoryInterface;
use App\Repository\Manager\Mission\MissionBaseRepositoryInterface;
use App\Repository\Manager\Feedback\FeedbackBaseRepositoryInterface;
use App\Repository\Manager\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface;
use App\Repository\Manager\Program\ProgramRepositoryInterface;
use App\Repository\Manager\Question\QuestionBaseRepositoryInterface;
use App\Repository\Manager\LoginHistory\LoginHistoryRepositoryInterface;
use App\Repository\Manager\Mission\MissionRepositoryInterface;


use App\Exports\UsersExport;
use App\Exports\LoginHistoryExport;
use App\Exports\MissionExport;
use App\Repository\Manager\Team\TeamRepositoryInterface;
use App\Repository\Manager\TeamMember\TeamMemberRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Repository\Manager\User\UserRepositoryInterface;

class DownloadService
{
    private $mission_base_repository;
    private $quesion_base_repository;
    private $feedback_base_repository;
    private $user_repository;
    private $mission_repository;
    private $login_history_repository;
    private $team_member_repository;
    private $team_repository;
    private $brand_repository;
    private $feedback_repository;
    private $missionQuestionAnswerRepository;
    private $programRepository;


    public function __construct(
        MissionBaseRepositoryInterface           $mission_base_repository,
        QuestionBaseRepositoryInterface          $quesion_base_repository,
        FeedBackBaseRepositoryInterface          $feedback_base_repository,
        LoginHistoryRepositoryInterface          $login_history_repository,
        MissionRepositoryInterface               $mission_repository,
        UserRepositoryInterface                  $user_repository,
        TeamMemberRepositoryInterface            $teamMemberRepository,
        BrandRepositoryInterface                 $brandRepository,
        TeamRepositoryInterface                  $teamRepository,
        FeedbackRepositoryInterface              $feedbackRepository,
        MissionQuestionAnswerRepositoryInterface $missionQuestionAnswerRepository,
        ProgramRepositoryInterface               $programRepository
    )
    {
        $this->mission_base_repository = $mission_base_repository;
        $this->quesion_base_repository = $quesion_base_repository;
        $this->feedback_base_repository = $feedback_base_repository;
        $this->user_repository = $user_repository;
        $this->mission_repository = $mission_repository;
        $this->login_history_repository = $login_history_repository;
        $this->team_member_repository = $teamMemberRepository;
        $this->team_repository = $teamRepository;
        $this->brand_repository = $brandRepository;
        $this->feedback_repository = $feedbackRepository;
        $this->missionQuestionAnswerRepository = $missionQuestionAnswerRepository;
        $this->programRepository = $programRepository;
    }

    public function getCSVMenber($data)
    {
        $users = $this->team_member_repository->getUserDownload($data);
        $team = $this->team_repository->findById($data['team_id']);
        $brand = $this->brand_repository->findById($data['brand_id']);
        $filename = 'members_' . $brand->name . '_' . $team->name . '_' . date('Y_m_d_H:i') . '.csv';
        $filename = str_replace("/", "-", $filename);

        return Excel::download(new UsersExport($users), $filename);


    }

    public function getCSVLoginHistory($data)
    {
        $teamMembers = $this->team_member_repository->getList($data)->pluck('id')->toArray();
        $data['team_member'] = $teamMembers;
        $users = $this->login_history_repository->getUserDownload($data);
        $team = $this->team_repository->findById($data['team_id']);
        $brand = $this->brand_repository->findById($data['brand_id']);
        $filename = 'login_histories_' . $brand->name . '_' . $team->name . '_' . date('Y_m_d_H:i') . '.csv';
        $filename = str_replace("/", "-", $filename);

        return Excel::download(new LoginHistoryExport($users), $filename);
    }

    public function getCSVMissions($data)
    {
        $teamMembers = $this->team_member_repository->getList($data)->pluck('id')->toArray();
        $data['team_member'] = $teamMembers;
        $missions = $this->mission_repository->getListDownload($data);
        foreach ($missions as $mission) {
            $mission->team = $this->team_repository->findById($mission->team_id);
            $mission->feedback = $this->feedback_repository->findByMissionId($mission->id);
            $mission->user = $this->user_repository->findById(['id' => $mission->user_id, 'brand_id' => $data['brand_id']]);
            $mission->user_target = $mission->target_user_id == null ? null : $this->user_repository->findById(['id' => $mission->target_user_id, 'brand_id' => $data['brand_id']]);
            $mission->program = $this->programRepository->findById($mission->program_id);
            $answers = $this->missionQuestionAnswerRepository->getListDownload($mission->id)->toArray();
            foreach ($answers as $answer) {
                $answer->mission_type = Helpers::renderTypeQuestion((int)$answer->mission_type);
            }
            $mission->answers = @json_encode($answers);
        }
        $team = $this->team_repository->findById($data['team_id']);
        $brand = $this->brand_repository->findById($data['brand_id']);
        $filename = 'mission_histories_' . $brand->name . '_' . $team->name . '_' . date('Y_m_d_H:i') . '.csv';
        $filename = str_replace("/", "-", $filename);
        return Excel::download(new MissionExport($missions), $filename);

    }
}