<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 18/05/2021
 * Time: 11:43 AM
 **/


namespace App\Service\Manager;


use App\Repository\Manager\LogUpdateUser\LogUpdateUserRepositoryInterface;

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
        $data = [
            'brand_id' => request()->route('brand_id')
        ];
        return $this->logUpdateUserRepository->getList($data);
    }
}