<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 13/05/2021
 * Time: 4:14 PM
 **/


namespace App\Service\Admin;


use App\Repository\Admin\LogUpdateUser\LogUpdateUserRepositoryInterface;

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