<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 08/06/2021
 * Time: 10:15
 */

namespace App\Service\Admin;


use App\Repository\Admin\Program\ProgramHistoryRepositoryInterface;

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