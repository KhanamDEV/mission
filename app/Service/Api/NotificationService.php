<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 22/11/2021
 * Time: 09:47
 */

namespace App\Service\Api;

use App\Repository\Api\Notification\BrandNotificationRepositoryInterface;
use App\Repository\Api\Notification\SystemNotificationRepositoryInterface;
use App\Repository\Api\Team\TeamMemberRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;


class NotificationService
{
    private $brandNotificationRepository;
    private $systemNotificationRepository;
    private $teamMemberRepository;

    public function __construct(BrandNotificationRepositoryInterface $brandNotificationRepository,
                                SystemNotificationRepositoryInterface $systemNotificationRepository,
                                TeamMemberRepositoryInterface $teamMemberRepository)
    {
        $this->brandNotificationRepository = $brandNotificationRepository;
        $this->systemNotificationRepository = $systemNotificationRepository;
        $this->teamMemberRepository = $teamMemberRepository;
    }

    public function getListByType($type){
        $user = JWTAuth::user();
        $arrNotify = [];
        $teamOfUser = $this->teamMemberRepository->getListByUserId($user->id)->pluck('team_id')->toArray();
        if ($type == 'brand'){
            $notifies = $this->brandNotificationRepository->getList(['brand_id' => $user->brand_id]);
            foreach ($notifies as $notify){
                if (!is_null($notify->seen_users)){
                    $notify->is_seen = in_array($user->id, @json_decode($notify->seen_users));
                } else{
                    $notify->is_seen = false;
                }
                if ($notify->type == 'all') array_push($arrNotify, $notify);
                if ($notify->type == 'user'){
                    $option = @json_decode($notify->option);
                    if ($option->user_id == $user->id) array_push($arrNotify, $notify);
                }
                if ($notify->type == 'team'){
                    $option = @json_decode($notify->option);
                    if (in_array((int) $option->team_id, $teamOfUser)) array_push($arrNotify, $notify);
                }


            }
        }
        if ($type == 'system'){
            $notifies = $this->systemNotificationRepository->getList([]);
            foreach ($notifies as $notify){
                if (!is_null($notify->seen_users)){
                    $notify->is_seen = in_array($user->id, @json_decode($notify->seen_users));
                } else{
                    $notify->is_seen = false;
                }
                if ($notify->type == 'all') array_push($arrNotify, $notify);
                if ($notify->type == 'user'){
                    $option = @json_decode($notify->option);
                    if ($option->brand_id == $user->brand_id){
                        if ($option->user_id == $user->id) array_push($arrNotify, $notify);
                    }
                }
                if ($notify->type == 'team'){
                    $option = @json_decode($notify->option);
                    if ($option->brand_id == $user->brand_id){
                        if (in_array((int) $option->team_id, $teamOfUser)) array_push($arrNotify, $notify);
                    }
                }

            }
        }
        return $arrNotify;
    }

    public function getList(){
        $user = JWTAuth::user();
        $brandNotify = $this->brandNotificationRepository->getList(['brand_id' => $user->brand_id]);
        $teamOfUser = $this->teamMemberRepository->getListByUserId($user->id)->pluck('team_id')->toArray();
        $systemNotify = $this->systemNotificationRepository->getList([]);
        $arrNotifyBrandFilter = [];
        $arrNotifySystemFilter = [];
        foreach ($brandNotify as $notify){
            if (!is_null($notify->seen_users)){
                $notify->is_seen = in_array($user->id, @json_decode($notify->seen_users));
            } else{
                $notify->is_seen = false;
            }
            if ($notify->type == 'all') array_push($arrNotifyBrandFilter, $notify);
            if ($notify->type == 'user'){
                $option = @json_decode($notify->option);
                if ($option->user_id == $user->id) array_push($arrNotifyBrandFilter, $notify);
            }
            if ($notify->type == 'team'){
                $option = @json_decode($notify->option);
                if (in_array((int) $option->team_id, $teamOfUser)) array_push($arrNotifyBrandFilter, $notify);
            }
        }

        foreach ($systemNotify as $notify){
            if (!is_null($notify->seen_users)){
                $notify->is_seen = in_array($user->id, @json_decode($notify->seen_users));
            } else{
                $notify->is_seen = false;
            }
            if ($notify->type == 'all') array_push($arrNotifySystemFilter, $notify);
            if ($notify->type == 'user'){
                $option = @json_decode($notify->option);
                if ($option->brand_id == $user->brand_id){
                    if ($option->user_id == $user->id) array_push($arrNotifySystemFilter, $notify);
                }
            }
            if ($notify->type == 'team'){
                $option = @json_decode($notify->option);
                if ($option->brand_id == $user->brand_id){
                    if (in_array((int) $option->team_id, $teamOfUser)) array_push($arrNotifySystemFilter, $notify);
                }
            }
        }
        return [
            'brand' => array_slice($arrNotifyBrandFilter, 0, 2),
            'system' => array_slice($arrNotifySystemFilter, 0, 2)
        ];
    }

    public function findById($id, $type){
        DB::beginTransaction();
        try {
            $user = JWTAuth::user();
            if ($type == 'system'){
                $notify = $this->systemNotificationRepository->findById($id);
                $userSeen = is_null($notify->seen_users) ? [] : @json_decode($notify->seen_users);
                if (!in_array($user->id, $userSeen)) array_push($userSeen, $user->id);
                $dataUpdate = [
                    'seen_users' => @json_encode($userSeen),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                if (!$this->systemNotificationRepository->update($id, $dataUpdate)){
                    DB::rollBack();
                    return false;
                }
                DB::commit();
                return $notify;
            }
            if ($type == 'brand'){
                $notify = $this->brandNotificationRepository->findById($id);
                $userSeen = is_null($notify->seen_users) ? [] : @json_decode($notify->seen_users);
                if (!in_array($user->id, $userSeen)) array_push($userSeen, $user->id);
                $dataUpdate = [
                    'seen_users' => @json_encode($userSeen),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                if (!$this->brandNotificationRepository->update($id, $dataUpdate)){
                    DB::rollBack();
                    return false;
                }
                DB::commit();
                return $notify;
            }
            return  null;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }
}