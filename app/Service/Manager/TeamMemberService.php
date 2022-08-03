<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 27/10/2021
 * Time: 09:01
 */

namespace App\Service\Manager;

use App\Repository\Manager\Mission\MissionRepositoryInterface;
use App\Repository\Manager\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface;
use App\Repository\Manager\TeamMember\TeamMemberRepositoryInterface;

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

    public function getListByTeamId($brandId,$teamId){
        $users = $this->teamMemberRepository->getList(['team_id' => $teamId, 'brand_id' => $brandId]);
        foreach ($users as $user){
            $missions = $this->missionRepository->getListByUserAndTeamId(['user_id' => $user->id, 'team_id' => $teamId]);
            $user->quantity = $missions->count();
            $user->answered = $this->missionQuestionAnswerRepository->getListAnsweredByUserAndTeam(['mission_id' => $missions->pluck('id'), 'user_id' => $user->id, 'team_id' => $teamId])->count();
        }
        return $users;
    }
}