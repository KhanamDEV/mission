<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 28/05/2021
 * Time: 10:12
 */

namespace App\Repository\Api\Program;


use Illuminate\Support\Facades\DB;

class ProgramRepository implements ProgramRepositoryInterface
{

    const TABLE = 'programs';

    public function getList()
    {
        return DB::table(self::TABLE)
            ->select('id', 'name', 'detail', 'thumbnail_url')
            ->where('status' , '=', 1)
            ->orderByDesc('created_at')
            ->get();
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)
            ->select('id', 'name', 'detail', 'thumbnail_url')
            ->where('id', $_id)
            ->first();
    }
}