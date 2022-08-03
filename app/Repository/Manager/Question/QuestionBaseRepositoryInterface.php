<?php

namespace App\Repository\Manager\Question;


interface QuestionBaseRepositoryInterface
{
    public function getList();

    public function findById($id);

    public function store($data);

    public function update($id, $data);

    public function destroy($id);

}