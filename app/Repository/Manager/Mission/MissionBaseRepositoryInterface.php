<?php

namespace App\Repository\Manager\Mission;


interface MissionBaseRepositoryInterface
{
    public function getList($_per_page);

    public function findById($id);

    public function store($data);

    public function update($id, $data);

    public function destroy($id);

    public function checkUsed($id);

}