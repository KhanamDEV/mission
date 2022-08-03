<?php

namespace App\Service\Admin;

use App\Jobs\SendNotificationBrand;
use App\Repository\Admin\BrandNotify\BrandNotifyRepositoryInterface;
use App\Repository\Admin\SystemNotify\SystemNotificationRepositoryInterface;
use App\Repository\Admin\Team\TeamMemberRepositoryInterface;
use App\Repository\Admin\Team\TeamRepositoryInterface;
use App\Repository\Admin\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandNotifyService
{
    private $brandNotifyRepository;
    private $userRepository;
    private $teamMemberRepository;
    private $teamRepository;
    private $systemRepository;

    public function __construct(BrandNotifyRepositoryInterface $brandNotifyRepository, TeamRepositoryInterface $teamRepository,
                                UserRepositoryInterface $userRepository, TeamMemberRepositoryInterface $teamMemberRepository,
                                SystemNotificationRepositoryInterface $systemRepository)
    {
        $this->brandNotifyRepository = $brandNotifyRepository;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->systemRepository = $systemRepository;
    }

    public function getList()
    {
        $data = [
            'perPage' => 10,
            'brand_id' => Auth::guard('admin')->user()->id
        ];
        return $this->brandNotifyRepository->getList($data);
    }

    public function findById($id){
        $data = [
            'id' => $id,
            'brand_id' => Auth::guard('admin')->user()->id
        ];
        $notify =  $this->brandNotifyRepository->findById($data);
        if (!is_null($notify->option)){
            $option = @json_decode($notify->option);
            if (isset($option->team_id)) $option->team = $this->teamRepository->findById($option->team_id);
            if (isset($option->user_id)) $option->user = $this->userRepository->findById($option->user_id);
            $notify->option = $option;
        }
        return $notify;
    }

    public function update($id, $data)
    {
        $dataUpdate = [
            'title' => $data['title'],
            'brand_id' => Auth::guard('admin')->user()->id,
            'description' => $data['description'],
            'type' => $data['type'],
            'url' => $data['url'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        if ($data['type'] == 'team' || $data['type'] == 'user') {
            $type = $data['type'] . '_id';
            $dataUpdate['option'] = @json_encode(["$type" => $data[$type]]);
        }
        return $this->brandNotifyRepository->update($id,$dataUpdate );
    }

    public function delete($id){
        return $this->brandNotifyRepository->delete($id);
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $brandId = Auth::guard('admin')->user()->id;
            $dataInsert = [
                'title' => $data['title'],
                'brand_id' => $brandId,
                'description' => $data['description'],
                'type' => $data['type'],
                'url' => $data['url'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if ($data['type'] == 'team' || $data['type'] == 'user') {
                $type = $data['type'] . '_id';
                $dataInsert['option'] = @json_encode(["$type" => $data[$type]]);
            }
            if (!$this->brandNotifyRepository->store($dataInsert)) return false;

            $notifiesBrand = $this->brandNotifyRepository->getList(['brand_id' => $brandId]);
            $notifiesSystem = $this->systemRepository->getList([]);
            $users = [];
            if ($data['type'] == 'all') $users = $this->userRepository->getAll($brandId);
            else if ($data['type'] == 'team') $users = $this->teamMemberRepository->getListByTeamId($brandId);
            else $users = [$this->userRepository->findById($data['user_id'])];
            foreach ($users as $user){
                if (!$this->userRepository->upNumberNotification($user->id)){
                    DB::rollBack();
                    return  false;
                }
                $user->badge = $this->userRepository->findById($user->id)->number_notification;
            }
            if (!empty($users)) {
                $jobSendNotificationBrand = new SendNotificationBrand($users, $data);
                dispatch($jobSendNotificationBrand)->delay(now());
            }
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            return  false;
        }
    }

    public function getListByUser($userId, $limit = null){
            $brandId = Auth::guard('admin')->user()->id;
            $teamOfUser = $this->teamMemberRepository->getListByUser($userId)->pluck('team_id')->toArray();
            $notifies = $this->brandNotifyRepository->getList(['brand_id' => $brandId]);
            $notifyOfUser = [];
            foreach ($notifies as $notify){
                if ($notify->type == 'all') array_push($notifyOfUser, $notify);
                if ($notify->type == 'user'){
                    $option = @json_decode($notify->option);
                    if ($option->user_id == $userId) array_push($notifyOfUser, $notify);
                }
                if ($notify->type == 'team'){
                    $option = @json_decode($notify->option);
                    if (in_array((int) $option->team_id, $teamOfUser)) array_push($notifyOfUser, $notify);
                }
            }
            return is_null($limit) ? $notifyOfUser : collect($notifyOfUser)->take($limit);
    }
}