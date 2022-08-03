<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 20/05/2021
 * Time: 8:59 AM
 **/


namespace App\Repository\Manager\Program;


use Illuminate\Support\Facades\DB;

class ProgramRepository implements ProgramRepositoryInterface
{
    const TABLE = 'programs';

    public function store($_data)
    {
        return DB::table(self::TABLE)->insertGetId($_data);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }

    public function getList($_per_page)
    {
        return DB::table(self::TABLE)->orderBy('id', 'DESC')->paginate($_per_page);
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update($_data);
    }
}