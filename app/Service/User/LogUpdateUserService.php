<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 17/06/2021
 * Time: 09:29
 */

namespace App\Service\User;


use App\Repository\User\LogUpdateUser\LogUpdateUserRepositoryInterface;

class LogUpdateUserService
{
    private $logUpdateUserRepository;

    public function __construct(LogUpdateUserRepositoryInterface $logUpdateUserRepository)
    {
        $this->logUpdateUserRepository = $logUpdateUserRepository;
    }

    public function create($data){
        return $this->logUpdateUserRepository->create($data);
    }

    public function getList(){
        return $this->logUpdateUserRepository->getList();
    }
}