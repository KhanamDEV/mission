<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 19/05/2021
 * Time: 3:26 PM
 **/


namespace App\Repository\Manager\TeamMember;


interface TeamMemberRepositoryInterface
{
    public function getList($_data);

    public function getUserDownload($_data);

    public function getListByUser($_user_id);

    public function deleteByUserId($_user_id);
}