<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 13:35
 */

namespace App\Service\User;


use App\Repository\User\Mission\MissionRepositoryInterface;
use App\Repository\User\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface;
use App\Repository\User\TeamMember\TeamMemberRepositoryInterface;

class TeamMemberService
{
    private $teamMemberRepository;
    private $missionRepository;
    private $missionQuestionAnswerRepository;

    public function __construct(TeamMemberRepositoryInterface  $teamMemberRepository, MissionRepositoryInterface $missionRepository,
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
            $user->missions = $missions;
            $user->quantity = $missions->count();
            $user->answered = $this->missionQuestionAnswerRepository->getListAnsweredByUserAndTeam(['mission_id' => $missions->pluck('id'), 'user_id' => $user->id, 'team_id' => $teamId])->count();
        }
        return $users;
    }
}