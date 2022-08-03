<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 14/05/2021
 * Time: 9:28 AM
 **/


namespace App\Repository\Admin\Team;


interface TeamMemberRepositoryInterface
{
    public function getListByTeamId($_team_id);

    public function getListByUser($_user_id);

    public function deleteByUserId($_user_id);
}