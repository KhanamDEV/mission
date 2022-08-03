<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 22/11/2021
 * Time: 14:40
 */

namespace App\Repository\Admin\SystemNotify;

interface SystemNotificationRepositoryInterface
{
    public function findById($_id);

    public function getList($_data);

    public function delete($_id);
}