<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 17/11/2021
 * Time: 09:52
 */

namespace App\Repository\Manager\BrandNotify;

interface BrandNotifyRepositoryInterface
{
    public function store($_data);

    public function edit($_data, $_id);

    public function findById($_id);

    public function getList($_data);

    public function destroy($_id);
}