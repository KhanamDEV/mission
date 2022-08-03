<?php

namespace App\Repository\Manager\Question;


use Illuminate\Support\Facades\DB;
use App\Repository\Manager\Question\QuestionBaseRepositoryInterface;

class QuestionBaseRepository implements QuestionBaseRepositoryInterface
{

    const TABLE = 'mission_question_answer_bases';

    public function getList()
    {
        return DB::table(self::TABLE)->get();
    }

    public function findById($id)
    {
        return DB::table(self::TABLE)->where('id', $id)->first();
    }

    public function store($data){
        return DB::table(self::TABLE)->insertGetId($data);
    }

    public function update($id, $data)
    {
        return DB::table(self::TABLE)->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return DB::table(self::TABLE)->where('id', $id)->delete();
    }
}