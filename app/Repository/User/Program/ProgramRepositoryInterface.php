<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 15:15
 */

namespace App\Repository\User\Program;


interface ProgramRepositoryInterface
{
    public function getAll($_with, $_per_page);

    public function findById($_id);
}