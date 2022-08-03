<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 22/06/2021
 * Time: 09:42
 */

namespace App\Repository\Api\User;


interface UserRepositoryInterface
{
    public function checkHasUserByEmail($_email);

    public function updateByEmail($_email, $_data);

    public function findById($_id);

    public function update($_data, $_id);

    public function getListByBrandId($_brand_id);

    public function upNumberNotification($_id);
}