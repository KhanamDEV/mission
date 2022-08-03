<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 13/05/2021
 * Time: 4:09 PM
 **/


namespace App\Repository\Admin\LogUpdateUser;


interface LogUpdateUserRepositoryInterface
{
    public function create($_data);

    public function getList();
}