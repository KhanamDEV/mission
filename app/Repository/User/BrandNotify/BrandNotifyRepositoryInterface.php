<?php

namespace App\Repository\User\BrandNotify;

interface BrandNotifyRepositoryInterface
{
    public function getList($_data);

    public function findById($_data);

    public function update($_id, $_data);

    public function delete($_id);

    public function store($_data);

    public function destroy($_id);
}