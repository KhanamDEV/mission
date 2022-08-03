<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 20/05/2021
 * Time: 2:49 PM
 **/


namespace App\Repository\Manager\Program;


interface ProgramMissionRepositoryInterface
{
    public function store($_data);

    public function getListByProgramId($_program_id);

    public function delete($_id);

    public function deleteByProgram($_data);

    public function checkHas($_data);
}