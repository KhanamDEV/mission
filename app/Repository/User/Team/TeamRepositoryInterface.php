<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 10:39
 */

namespace App\Repository\User\Team;


interface TeamRepositoryInterface
{
    public function getListByBrandId($_brand_id, $_per_page);

    public function findById($_id);

    public function getListByUserId($_user_id);

    public function getProgramByTeamId($_team_id);

}