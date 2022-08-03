<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 17/05/2021
 * Time: 1:56 PM
 **/


namespace App\Service\Manager;


use App\Helpers\Helpers;
use App\Repository\Manager\Brand\BrandRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class BrandService
{
    private $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function store($data){
        $dataInsert = [
            'name' => $data['name'],
            'detail' => $data['detail'],
            'email' => $data['email'],
            'verified' => true,
            'password' => Hash::make($data['password']),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        if (request()->file('thumbnail_url') != null){
            $upload = Helpers::upLoadFile(request()->file('thumbnail_url'), 'brand');
            if ($upload['meta']['status'] == 200) {
                $dataInsert['thumbnail_url'] = $upload['response'];
            } else{
                return false;
            }
        }
        return $this->brandRepository->store($dataInsert);
    }

    public function getList($perPage = 10){
        return $this->brandRepository->getList($perPage);
    }

    public function getAll(){
        return $this->brandRepository->getList();
    }

    public function findById($id){
        return $this->brandRepository->findById($id);
    }

    public function update($id, $data){
        $dataUpdate = [
            'name' => $data['name'],
            'detail' => $data['detail'],
            'email' => $data['email'],
            'updated_at' => date('Y/m/d H:i:s')
        ];
        if (request()->file('thumbnail_url') != null){
            $upload = Helpers::upLoadFile(request()->file('thumbnail_url'), 'brand');
            if ($upload['meta']['status'] == 200) {
                $dataUpdate['thumbnail_url'] = $upload['response'];
            } else{
                return false;
            }
        }
        return $this->brandRepository->update($id, $dataUpdate);
    }

    public function getListWithTeams()
    {
        return $this->brandRepository->getListWithTeams();
    }
}