<?php

namespace App\Repository\Admin\Program;


use Illuminate\Support\Facades\DB;
use App\Model\Program;
use App\Repository\Admin\Program\ProgramRepositoryInterface;
class ProgramRepository implements ProgramRepositoryInterface
{

    const TABLE = 'programs';


    public function getAll($with, $_per_page)
    {
        return Program::with($with)->orderBy('id', 'DESC')->paginate($_per_page);
    }

    public function findById($id, $with = [])
    {
        return Program::where('id', $id)->first();
    }

}