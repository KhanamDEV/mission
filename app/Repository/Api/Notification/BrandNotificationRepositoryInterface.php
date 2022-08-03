<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 22/11/2021
 * Time: 09:56
 */

namespace App\Repository\Api\Notification;

interface BrandNotificationRepositoryInterface
{
    public function getList($_data);

    public function findById($_id);

    public function update($_id, $_data);

    public function delete($_id);

}