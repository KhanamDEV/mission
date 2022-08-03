<?php

namespace App\Repository\Manager\Feedback;


use Illuminate\Support\Facades\DB;
use App\Repository\Manager\Feedback\FeedbackBaseRepositoryInterface;

class FeedbackBaseRepository implements FeedbackBaseRepositoryInterface
{

    const TABLE = 'feedback_bases';

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

    public function findByMissionBaseId($id)
    {
        return DB::table(self::TABLE)->where('mission_base_id', $id)->first();
    }
}