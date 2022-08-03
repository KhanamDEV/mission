<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 28/05/2021
 * Time: 10:09
 */

namespace App\Service\Api;


use App\Repository\Api\Program\ProgramRepositoryInterface;

class ProgramService
{
    private $programRepository;

    public function __construct(ProgramRepositoryInterface $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    public function getList(){
        return $this->programRepository->getList();
    }

    public function findById(){
        $programId = request()->get('id');
        return $this->programRepository->findById($programId);
    }
}