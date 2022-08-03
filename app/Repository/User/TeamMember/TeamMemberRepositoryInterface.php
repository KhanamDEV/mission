<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 13:36
 */

namespace App\Repository\User\TeamMember;


interface TeamMemberRepositoryInterface
{
    public function getListByTeamId($_team_id);

    public function deleteByUserId($_user_id);
}