<?php

namespace App\Repository\Manager\LoginHistory;


interface LoginHistoryRepositoryInterface
{
    public function getUserDownload($_data);

    public function deleteByUserId($_user_id);
}