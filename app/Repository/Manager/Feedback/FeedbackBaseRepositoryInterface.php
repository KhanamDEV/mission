<?php

namespace App\Repository\Manager\Feedback;


interface FeedbackBaseRepositoryInterface
{
    public function getList();

    public function findById($id);

    public function store($data);

    public function update($id, $data);

    public function destroy($id);

    public function findByMissionBaseId($id);
}