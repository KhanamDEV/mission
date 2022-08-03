<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 18/05/2021
 * Time: 9:02 AM
 **/


namespace App\Repository\Manager\User;


use Illuminate\Support\Facades\DB;
use App\Model\User;
class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(){
        $this->model = new User;
    }


    const TABLE = 'users';

    public function create($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function deleteByBrandId($_brand_id)
    {
        return DB::table(self::TABLE)->where('brand_id', $_brand_id)->delete();
    }

    public function getList($_data)
    {
        $data = DB::table(self::TABLE)
            ->when(isset($_data['brand_id']), function ($query) use ($_data){
                return $query->where('brand_id', $_data['brand_id']);
            });
        return isset($_data['perPage']) ? $data->paginate($_data['perPage']) : $data->get();
    }

    public function findById($_data)
    {
        return DB::table(self::TABLE)
            ->where('id', $_data['id'])
            ->when(isset($_data['brand_id']), function ($query) use ($_data){
                return $query->where('brand_id', $_data['brand_id']);

            })
            ->first();
    }

    public function updateByEmail($_email, $_data)
    {
        return DB::table(self::TABLE)->where('email', $_email)->update($_data);
    }

    public function checkEmptyUserByBrandId($_brand_id)
    {
        return DB::table(self::TABLE)->where('brand_id', $_brand_id)->count();
    }

    public function getListByTeam($data)
    {
        $query = $this->model->with(['brand'])->whereHas('teams', function($query) use($data){
            $query->where('teams.id', $data['team_id']);
        })
        ->where('brand_id', $data['brand_id']);
        
        if (isset($data['start_date'])) {
            $query = $query->whereDate('email_verified_at', '>=', $data['start_date']);
        }
        if (isset($data['end_date'])) {
            $query = $query->whereDate('email_verified_at', '<=', $data['end_date']);
        }
        return $query->get();
    }

    public function checkHasUserByEmail($_email)
    {
        return DB::table(self::TABLE)->where('email', '=', $_email)->count();
    }

    public function findByEmail($_email)
    {
        return DB::table(self::TABLE)->where('email', '=', $_email)->first();
    }


    public function upNumberNotification($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update(['number_notification' => DB::raw('number_notification + 1'), 'updated_at' => date('Y-m-d H:i:s')]);
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->count() ?
            DB::table(self::TABLE)->delete($_id) : true;
    }
}