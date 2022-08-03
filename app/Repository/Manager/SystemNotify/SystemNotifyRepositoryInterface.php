<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/11/2021
 * Time: 09:16
 */

namespace App\Repository\Manager\SystemNotify;

interface SystemNotifyRepositoryInterface
{
    public function store($_data);

    public function findById($_id);

    public function update($_id, $_data);

    public function delete($_id);

    public function getList($_data);
}