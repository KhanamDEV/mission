<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 28/05/2021
 * Time: 09:16
 */

namespace App\Repository\Api\Team;


interface TeamRepositoryInterface
{
    public function getListByUser($_user);

    public function store($_data);

    public function update($_id, $_data);

    public function findById($_id);

    public function delete($_id);
}