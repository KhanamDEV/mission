<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 28/05/2021
 * Time: 09:47
 */

namespace App\Repository\Api\Team;


interface TeamMemberRepositoryInterface
{
    public function store($_data);

    public function getListMemberByTeamId($_team_id);

    public function findById($_id);

    public function deleteByTeamId($_team_id);

    public function getListByUserId($_user_id);

    public function update($_id, $_data);

    public function deleteByUserIdAndTeamId($_user_id, $_team_id);
}