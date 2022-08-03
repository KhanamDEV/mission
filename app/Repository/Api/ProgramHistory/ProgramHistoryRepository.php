<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 27/10/2021
 * Time: 13:34
 */

namespace App\Repository\Api\ProgramHistory;

use Illuminate\Support\Facades\DB;

class ProgramHistoryRepository implements ProgramHistoryRepositoryInterface
{

    const TABLE = 'program_histories';

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }
}