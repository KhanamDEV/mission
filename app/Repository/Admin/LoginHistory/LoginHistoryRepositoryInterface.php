<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 10:37
 */

namespace App\Repository\Admin\LoginHistory;

interface LoginHistoryRepositoryInterface
{
    public function deleteByUserId($_user_id);
}