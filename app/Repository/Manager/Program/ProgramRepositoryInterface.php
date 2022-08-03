<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 20/05/2021
 * Time: 8:54 AM
 **/


namespace App\Repository\Manager\Program;


interface ProgramRepositoryInterface
{
    public function store($_data);

    public function findById($_id);

    public function getList($_per_page);

    public function update($_id, $_data);
}