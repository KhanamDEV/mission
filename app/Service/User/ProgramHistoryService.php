<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 10/06/2021
 * Time: 10:18
 */

namespace App\Service\User;


use App\Repository\User\ProgramHistory\ProgramHistoryRepositoryInterface;

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