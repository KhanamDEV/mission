<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 17/05/2021
 * Time: 1:56 PM
 **/


namespace App\Repository\Manager\Brand;


interface BrandRepositoryInterface
{
    public function getList($_per_page = null);

    public function findById($_id);

    public function store($_data);

    public function update($_id, $_data);
}