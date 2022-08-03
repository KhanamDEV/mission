<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 18/05/2021
 * Time: 11:39 AM
 **/


namespace App\Repository\Manager\LogUpdateUser;


interface LogUpdateUserRepositoryInterface
{
    public function create($_data);

    public function getList($_data);
}