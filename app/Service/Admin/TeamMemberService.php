<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 14/05/2021
 * Time: 9:36 AM
 **/


namespace App\Service\Admin;


use App\Repository\Admin\Mission\MissionRepositoryInterface;
use App\Repository\Admin\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface;
use App\Repository\Admin\Team\TeamMemberRepositoryInterface;

class TeamMemberService
{
    private $teamMemberRepository;
    private $missionRepository;
    private $missionQuestionAnswerRepository;

    public function __construct(TeamMemberRepositoryInterface $teamMemberRepository, MissionRepositoryInterface $missionRepository,
                                MissionQuestionAnswerRepositoryInterface $missionQuestionAnswerRepository)
    {
        $this->teamMemberRepository = $teamMemberRepository;
        $this->missionRepository = $missionRepository;
        $this->missionQuestionAnswerRepository = $missionQuestionAnswerRepository;
    }

    public function getListByTeamId($teamId){
        $users = $this->teamMemberRepository->getListByTeamId($teamId);
        foreach ($users as $user){
            $missions = $this->missionRepository->getListByUserAndTeamId(['user_id' => $user->id, 'team_id' => $teamId]);
            $user->quantity = $missions->count();
            $user->answered = $this->missionQuestionAnswerRepository->getListAnsweredByUserAndTeam(['mission_id' => $missions->pluck('id'), 'user_id' => $user->id, 'team_id' => $teamId])->count();
        }
        return $users;
    }
}