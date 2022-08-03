<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 16/06/2021
 * Time: 13:45
 */

namespace App\Service\Manager;


use App\Repository\Manager\Program\ProgramHistoryRepositoryInterface;

class ProgramHistoryService
{
    private $programHistoryRepository;

    public function __construct(ProgramHistoryRepositoryInterface $programHistoryRepository)
    {
        $this->programHistoryRepository = $programHistoryRepository;
    }

    public function getListByTeamId($teamId){
        $programHistory = $this->programHistoryRepository->getListByTeamId($teamId);
        $programHistory->shift();
        return $programHistory;
    }
}