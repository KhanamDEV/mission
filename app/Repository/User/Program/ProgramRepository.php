<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 15:15
 */

namespace App\Repository\User\Program;


use App\Model\Program;

class ProgramRepository implements ProgramRepositoryInterface
{
    const TABLE = 'programs';


    public function getAll($_with, $_per_page)
    {
        return Program::with($_with)->orderByDesc('id')->paginate($_per_page);
    }

    public function findById($_id, $with = [])
    {
        return Program::with('missions', 'missions.answers')->where('id', $_id)->first();
    }
}