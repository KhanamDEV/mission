<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 17/05/2021
 * Time: 1:57 PM
 **/


namespace App\Repository\Manager\Brand;
use App\Model\Brand;

use Illuminate\Support\Facades\DB;

class BrandRepository implements BrandRepositoryInterface
{

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    const TABLE = 'brands';

    public function getList($_per_page = null)
    {
        $data = DB::table(self::TABLE)
            ->orderBy('created_at', 'DESC');
        return isset($_per_page) ? $data->paginate($_per_page) : $data->get();
    }

    public function getListWithTeams()
    {
        return $this->brand->with('teams')->get();
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update($_data);
    }
}