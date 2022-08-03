<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 15:12
 */

namespace App\Service\User;


use App\Repository\User\MissionQuestionAnswer\MissionQuestionAnswerBaseRepositoryInterface;
use App\Repository\User\Program\ProgramRepositoryInterface;
use App\Repository\User\ProgramMission\ProgramMissionRepositoryInterface;

class ProgramService
{
    private $programRepository;
    private $programMissionRepository;
    private $missionQuestionAnswerBaseRepository;

    public function __construct(ProgramRepositoryInterface $programRepository, ProgramMissionRepositoryInterface $programMissionRepository,
                                MissionQuestionAnswerBaseRepositoryInterface $missionQuestionAnswerBaseRepository)
    {
        $this->programRepository = $programRepository;
        $this->programMissionRepository = $programMissionRepository;
        $this->missionQuestionAnswerBaseRepository = $missionQuestionAnswerBaseRepository;
    }

    public function getList($perPage = 10){
        return $this->programRepository->getAll([], $perPage);
    }

    public function findById($id){
        $missionBase = $this->programMissionRepository->getListByProgramId($id);
        foreach ($missionBase as $mission){
            $mission->answers = $this->missionQuestionAnswerBaseRepository->getByMissionBaseId($mission->mission_id);
        }
        return [
            'info' => $this->programRepository->findById($id),
            'mission_base' => $missionBase
        ];
    }
}