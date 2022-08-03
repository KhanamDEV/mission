<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 14/05/2021
 * Time: 9:27 AM
 **/


namespace App\Repository\Admin\Team;


interface TeamRepositoryInterface
{
    public function getList($_per_page);

    public function findById($_id);

    public function getListByUserId($_id);

    public function getProgramByTeamId($_team_id);

    public function getAll($_brand_id);
}