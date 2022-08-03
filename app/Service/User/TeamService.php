<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 10:56
 */

namespace App\Service\User;


use App\Repository\User\Mission\MissionRepositoryInterface;
use App\Repository\User\Team\TeamRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    private $teamRepository;
    private $missionRepository;

    public function __construct(TeamRepositoryInterface $teamRepository, MissionRepositoryInterface $missionRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->missionRepository = $missionRepository;
    }

    public function getListByBrandId($perPage = 10){
        $user = Auth::guard('user')->user();
        return $this->teamRepository->getListByBrandId($user->brand_id, $perPage);
    }

    public function findById($id){
        return $this->teamRepository->findById($id);
    }

    public function getByUserId($userId){
        $teams = $this->teamRepository->getListByUserId($userId);
        foreach ($teams as $team){
            $timeEndTeam = strtotime(date('Y/m/d H:i:s', strtotime('+1 month', strtotime($team->program_started_at))));
            $team->old = (strtotime(date('Y/m/d H:i:s')) > $timeEndTeam ) ? 1: 0;
        }
        return $teams;
    }

    public function getProgramByTeamId($teamId){
        return $this->teamRepository->getProgramByTeamId($teamId);
    }
}