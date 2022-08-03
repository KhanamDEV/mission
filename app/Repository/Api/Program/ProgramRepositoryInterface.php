<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 28/05/2021
 * Time: 10:10
 */

namespace App\Repository\Api\Program;


interface ProgramRepositoryInterface
{
    public function getList();

    public function findById($_id);
}