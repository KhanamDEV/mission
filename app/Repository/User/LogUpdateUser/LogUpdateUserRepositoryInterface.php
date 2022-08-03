<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 17/06/2021
 * Time: 09:32
 */

namespace App\Repository\User\LogUpdateUser;


interface LogUpdateUserRepositoryInterface
{
    public function create($_data);

    public function getList();
}