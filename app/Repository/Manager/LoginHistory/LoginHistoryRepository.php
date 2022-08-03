<?php

namespace App\Repository\Manager\LoginHistory;


use Illuminate\Support\Facades\DB;

class LoginHistoryRepository implements LoginHistoryRepositoryInterface
{

    const TABLE = 'user_logins';

    public function getListByUserList($data)
    {
        $query =  DB::table(self::TABLE)
            ->join('users', 'users.id', '=', self::TABLE . '.user_id')
            ->whereDate('logined_at', '>=', $data['start_date'])
            ->whereDate('logined_at', '<=', $data['end_date']);

        if (isset($data['user_list'])) {
            $query = $query->whereIn('users.id', $data['user_list']);
        }
        
        return $query->select(['logined_at', 'users.id', 'users.name_mei', 'users.name_sei'])->get();
    }

    public function getUserDownload($_data)
    {
        return DB::table(self::TABLE)
            ->select('users.*', self::TABLE.'.logined_at')
            ->rightJoin('users', self::TABLE.'.user_id', '=', 'users.id')
            ->whereDate(self::TABLE.'.logined_at', '>=', $_data['start_date'])
            ->whereDate(self::TABLE.'.logined_at', '<=', $_data['end_date'])
            ->where(self::TABLE.'.device', '=', 'mobile')
            ->whereIn(self::TABLE.'.user_id', $_data['team_member'])
            ->get();
    }

    public function deleteByUserId($_user_id)
    {
        return DB::table(self::TABLE)->where('user_id', $_user_id)->count() ?
            DB::table(self::TABLE)->where('user_id', $_user_id)->delete() : true;
    }
}