<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/11/2021
 * Time: 09:14
 */

namespace App\Service\Manager;

use App\Jobs\SendNotificationSystem;
use App\Repository\Manager\Brand\BrandRepositoryInterface;
use App\Repository\Manager\BrandNotify\BrandNotifyRepositoryInterface;
use App\Repository\Manager\TeamMember\TeamMemberRepositoryInterface;
use App\Repository\Manager\SystemNotify\SystemNotifyRepositoryInterface;
use App\Repository\Manager\Team\TeamRepositoryInterface;
use App\Repository\Manager\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SystemNotifyService
{
    private $systemNotifyRepository;
    private $userRepository;
    private $teamMemberRepository;
    private $teamRepository;
    private $brandRepository;
    private $brandNotifyRepository;

    public function __construct(SystemNotifyRepositoryInterface $systemNotifyRepository, TeamMemberRepositoryInterface $teamMemberRepository,
                                UserRepositoryInterface         $userRepository, TeamRepositoryInterface $teamRepository,
                                BrandRepositoryInterface $brandRepository, BrandNotifyRepositoryInterface $brandNotifyRepository)
    {
        $this->systemNotifyRepository = $systemNotifyRepository;
        $this->userRepository = $userRepository;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->teamRepository = $teamRepository;
        $this->brandRepository = $brandRepository;
        $this->brandNotifyRepository = $brandNotifyRepository;
    }

    public function getList()
    {
        return $this->systemNotifyRepository->getList(['perPage' => 10]);
    }

    public function store($data)
    {
        try {
            $dataInsert = [
                'admin_id' => Auth::guard('manager')->user()->id,
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => $data['type'],
                'url' => $data['url'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if ($data['type'] == 'team' || $data['type'] == 'user') {
                $type = $data['type'] . '_id';
                $options = [
                    $type => $data[$type],
                    'brand_id' => $data['brand_id']
                ];
                $dataInsert['option'] = @json_encode($options);
            }
            if (!$this->systemNotifyRepository->store($dataInsert)) return false;
            $notifiesBrand = $this->brandNotifyRepository->getList([]);
            $notifiesSystem = $this->systemNotifyRepository->getList([]);
            $users = [];
            if ($data['type'] == 'all') $users = $this->userRepository->getList([]);
            else if ($data['type'] == 'team') $users = $this->teamMemberRepository->getList(['team_id' => $data['team_id'], 'brand_id' => $data['brand_id']]);
            else $users = [$this->userRepository->findById(['id' => $data['user_id'], 'brand_id' => $data['brand_id']])];
            foreach ($users as $user){
                if (!$this->userRepository->upNumberNotification($user->id)){
                    DB::rollBack();
                    return  false;
                }
                $user->badge = $this->userRepository->findById(['brand_id' => $user->brand_id, 'id' => $user->id])->number_notification;
            }
            if (!empty($users)) {
                $jobSendNotificationSystem = new SendNotificationSystem($users, $data);
                dispatch($jobSendNotificationSystem)->delay(now());
            }
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }

    }

    public function findById($id){
        $notify = $this->systemNotifyRepository->findById($id);
        if (!is_null($notify->option)){
            $option = @json_decode($notify->option);
            if (isset($option->team_id)) $option->team = $this->teamRepository->findById($option->team_id);
            if (isset($option->brand_id)) $option->brand = $this->brandRepository->findById($option->brand_id);
            if (isset($option->user_id)) $option->user = $this->userRepository->findById(['id' => $option->user_id, 'brand_id' => $option->brand_id]);
            $notify->option = $option;
        }
        return $notify;
    }

    public function delete($id){
        return $this->systemNotifyRepository->delete($id);
    }

    public function update($id, $data){
            $dataUpdate = [
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => $data['type'],
                'url' => $data['url'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if ($data['type'] == 'team' || $data['type'] == 'user') {
                $type = $data['type'] . '_id';
                $options = [
                    $type => $data[$type],
                    'brand_id' => $data['brand_id']
                ];
                $dataUpdate['option'] = @json_encode($options);
            }
            return $this->systemNotifyRepository->update($id, $dataUpdate);
    }

    public function getListByUser($userId, $brandId, $limit = null){
        $teamOfUser = $this->teamMemberRepository->getListByUser($userId)->pluck('team_id')->toArray();
        $notifies = $this->systemNotifyRepository->getList([]);
        $notifyOfUser = [];
        foreach ($notifies as $notify){
            if ($notify->type == 'all') array_push($notifyOfUser, $notify);
            if ($notify->type == 'user'){
                $option = @json_decode($notify->option);
                if ($option->brand_id == $brandId){
                    if ($option->user_id == $userId) array_push($notifyOfUser, $notify);
                }
            }
            if ($notify->type == 'team'){
                $option = @json_decode($notify->option);
                if ($option->brand_id == $brandId){
                    if (in_array((int) $option->team_id, $teamOfUser)) array_push($notifyOfUser, $notify);
                }
            }
        }
        return is_null($limit) ? $notifyOfUser : collect($notifyOfUser)->take($limit);
    }
}