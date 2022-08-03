<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 14/05/2021
 * Time: 11:22 AM
 **/


namespace App\Repository\Admin\User;


interface UserRepositoryInterface
{
    public function create($_data);

    public function deleteByBrandId();

    public function getList($_per_page);

    public function findById($_id);

    public function updateByEmail($_email, $_data);

    public function checkHasUserByEmail($_email);

    public function findByEmail($_email);

    public function getAll($_brand_id);

    public function upNumberNotification($_id);

    public function delete($_id);
}