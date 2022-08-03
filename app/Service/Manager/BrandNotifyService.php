<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 17/11/2021
 * Time: 10:00
 */

namespace App\Service\Manager;

use App\Helpers\ResponseHelpers;
use App\Jobs\SendNotificationBrand;
use App\Notifications\SlackNotification;
use App\Repository\Manager\BrandNotify\BrandNotifyRepositoryInterface;
use App\Repository\Manager\SystemNotify\SystemNotifyRepositoryInterface;
use App\Repository\Manager\Team\TeamRepositoryInterface;
use App\Repository\Manager\TeamMember\TeamMemberRepositoryInterface;
use App\Repository\Manager\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Http\Auth;

class BrandNotifyService
{
    private $brandNotifyRepository;
    private $userRepository;
    private $teamRepository;
    private $teamMemberRepository;
    private $systemNotifyRepository;

    public function __construct(BrandNotifyRepositoryInterface $brandNotifyRepository, UserRepositoryInterface $userRepository,
                                TeamRepositoryInterface        $teamRepository, TeamMemberRepositoryInterface $teamMemberRepository,
                                SystemNotifyRepositoryInterface $systemNotifyRepository)
    {
        $this->brandNotifyRepository = $brandNotifyRepository;
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->systemNotifyRepository = $systemNotifyRepository;
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $brandId = request()->route('brand_id');
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
            $notifiesSystem = $this->systemNotifyRepository->getList([]);
            $users = [];
            if ($data['type'] == 'all') $users = $this->userRepository->getList(['brand_id' => $brandId]);
            else if ($data['type'] == 'team') $users = $this->teamMemberRepository->getList(['team_id' => $data['team_id'], 'brand_id' => $brandId]);
            else $users = [$this->userRepository->findById(['id' => $data['user_id'], 'brand_id' => $brandId])];
            foreach ($users as $user){
                if (!$this->userRepository->upNumberNotification($user->id)){
                    DB::rollBack();
                    return  false;
                }
                $user->badge = $this->userRepository->findById(['brand_id' => $user->brand_id, 'id' => $user->id])->number_notification;
            }
            if (!empty($users)) {
                $jobSendNotificationBrand = new SendNotificationBrand($users, $data);
                dispatch($jobSendNotificationBrand)->delay(now());
            }
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }

    }

    public function getList()
    {
        return $this->brandNotifyRepository->getList(['brand_id' => request()->route('brand_id'), 'perPage' => 10]);
    }

    public function findById($id)
    {
            $notify = $this->brandNotifyRepository->findById($id);
            if (!is_null($notify->option)){
                $option = @json_decode($notify->option);
                if (isset($option->team_id)) $option->team = $this->teamRepository->findById($option->team_id);
                if (isset($option->user_id)) $option->user = $this->userRepository->findById(['id' => $option->user_id, 'brand_id' => request()->route('brand_id')]);
                $notify->option = $option;
            }
            return $notify;
    }

    public function update($id, $data)
    {
        $brandId = request()->route('brand_id');
        $dataUpdate = [
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
            $dataUpdate['option'] = @json_encode(["$type" => $data[$type]]);
        }
        return $this->brandNotifyRepository->edit($dataUpdate, $id);
    }

    public function delete($id){
        return $this->brandNotifyRepository->destroy($id);
    }

    public function getListByUser($userId, $brandId, $limit = null){
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