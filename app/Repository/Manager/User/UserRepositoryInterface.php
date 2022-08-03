<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 18/05/2021
 * Time: 9:02 AM
 **/


namespace App\Repository\Manager\User;


interface UserRepositoryInterface
{
    public function create($_data);

    public function deleteByBrandId($_brand_id);

    public function getList($_data);

    public function findById($_data);

    public function updateByEmail($_email, $_data);

    public function checkEmptyUserByBrandId($_brand_id);

    public function checkHasUserByEmail($_email);

    public function findByEmail($_email);

    public function upNumberNotification($_id);

    public function delete($_id);

}