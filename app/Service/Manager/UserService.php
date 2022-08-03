<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 18/05/2021
 * Time: 8:59 AM
 **/


namespace App\Service\Manager;


use App\Helpers\Helpers;
use App\Imports\UsersImport;
use App\Repository\Manager\BrandNotify\BrandNotifyRepositoryInterface;
use App\Repository\Manager\Feedback\FeedbackRepositoryInterface;
use App\Repository\Manager\LoginHistory\LoginHistoryRepositoryInterface;
use App\Repository\Manager\Mission\MissionRepositoryInterface;
use App\Repository\Manager\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface;
use App\Repository\Manager\Question\MissionQuestionRepositoryInterface;
use App\Repository\Manager\SystemNotify\SystemNotifyRepositoryInterface;
use App\Repository\Manager\TeamMember\TeamMemberRepositoryInterface;
use App\Repository\Manager\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserService
{
    private $userRepository;
    private $logUpdateUserService;
    private $teamMemberRepository;
    private $missionRepository;
    private $feedbackRepository;
    private $missionQuestionAnswerRepository;
    private $brandNotifyRepository;
    private $systemNotifyRepository;
    private $loginHistoryRepository;
    private $missionQuestionRepository;

    public function __construct(UserRepositoryInterface $userRepository, LogUpdateUserService $logUpdateUserService,
                                TeamMemberRepositoryInterface $teamMemberRepository, MissionRepositoryInterface $missionRepository,
                                FeedbackRepositoryInterface $feedbackRepository, MissionQuestionAnswerRepositoryInterface $missionQuestionAnswerRepository,
                                BrandNotifyRepositoryInterface $brandNotifyRepository, SystemNotifyRepositoryInterface $systemNotifyRepository,
                                LoginHistoryRepositoryInterface  $loginHistoryRepository, MissionQuestionRepositoryInterface $missionQuestionRepository)
    {
        $this->userRepository = $userRepository;
        $this->logUpdateUserService = $logUpdateUserService;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->missionRepository = $missionRepository;
        $this->feedbackRepository = $feedbackRepository;
        $this->missionQuestionAnswerRepository = $missionQuestionAnswerRepository;
        $this->brandNotifyRepository = $brandNotifyRepository;
        $this->systemNotifyRepository = $systemNotifyRepository;
        $this->loginHistoryRepository = $loginHistoryRepository;
        $this->missionQuestionRepository = $missionQuestionRepository;
    }

    public function getList()
    {
        $data = [
            'perPage' => 10,
            'brand_id' => request()->route('brand_id')
        ];
        return $this->userRepository->getList($data);
    }

    public function getAll($data){
        return $this->userRepository->getList(['brand_id' => $data['brand_id']]);
    }

    public function findById($id){
        $data = [
            'brand_id' => request()->route('brand_id'),
            'id' => $id
        ];
        return $this->userRepository->findById($data);
    }

    public function update($data)
    {
        DB::beginTransaction();
        try {
            $users = json_decode($data['users']);
            foreach ($users as $key => $value){
                if (!Helpers::validateUser($value)){
                    DB::rollBack();
                    return false;
                }
                $user = [
                    'name_sei' => $value->sei,
                    'name_mei' => $value->mei,
                    'name_sei_kana' => $value->sei_kana,
                    'name_mei_kana' => $value->mei_kana,
                    'detail' => $value->details,
                    'email' => $value->mailaddress,
                    'birthday' => date('Y/m/d', strtotime(Helpers::formatDateImportFile($value->birthday))),
                    'gender' => $value->gender,
                    'employment_status' => $value->employment_status,
                    'is_active' => strtolower($value->is_active) == 'true',
                    'department' => $value->department_name,
                    'verified' => 1,
                    'is_admin' => strtolower($value->is_admin) == 'true',
                    'updated_at' => date('Y/m/d H:i:s')
                ];
                if(!empty($this->userRepository->findByEmail($user['email'])) && $this->userRepository->findByEmail($user['email'])->brand_id != request()->route('brand_id')){
                    DB::rollBack();
                    return  false;
                }
                if ($this->userRepository->checkHasUserByEmail($user['email'])) {
                    if (!$this->userRepository->updateByEmail($user['email'], $user)) {
                        DB::rollBack();
                        return false;
                    }
                } else {
                    $user['created_at'] = date('Y/m/d H:i:s');
                    $user['brand_id'] = request()->route('brand_id');
                    $user['password'] = Hash::make($value->password);
                    if (!$this->userRepository->create($user)) {
                        DB::rollBack();
                        return false;
                    }
                }
            }
            $upload = Helpers::upLoadFile($data['file'], 'user/update', 'data_user');
            if ($upload['meta']['status'] != 200) {
                DB::rollBack();
                return false;
            }
            $path = $upload['response'];
            $dataLog = [
                'file_name' => $data['file']->getClientOriginalName(),
                'brand_id' => request()->route('brand_id'),
                'file_url' => $path,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            if (!$this->logUpdateUserService->create($dataLog)) {
                DB::rollBack();
                return false;
            }
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $users = json_decode($data['users']);
            $dataInsert = [];
            foreach ($users as $key => $value){
                if (!Helpers::validateUser($value)){
                    DB::rollBack();
                    return false;
                }
                $user = [
                    'name_sei' => $value->sei,
                    'name_mei' => $value->mei,
                    'name_sei_kana' => $value->sei_kana,
                    'name_mei_kana' => $value->mei_kana,
                    'detail' => $value->details,
                    'email' => $value->mailaddress,
                    'birthday' => date('Y/m/d', strtotime(Helpers::formatDateImportFile($value->birthday))),
                    'gender' => $value->gender,
                    'employment_status' => $value->employment_status,
                    'is_active' => strtolower($value->is_active) == 'true',
                    'department' => $value->department_name,
                    'is_admin' => strtolower($value->is_admin) == 'true',
                    'password' => Hash::make($value->password),
                    'brand_id' => request()->route('brand_id'),
                    'verified' => 1,
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s')
                ];
                array_push($dataInsert, $user);
            }
            $upload = Helpers::upLoadFile($data['file'], 'user/new', 'data_user');
            if (!$this->userRepository->create($dataInsert) || $upload['meta']['status'] != 200){
                DB::rollBack();
                return false;
            }

            $dataLog = [
                'file_name' => $data['file']->getClientOriginalName(),
                'brand_id' => request()->route('brand_id'),
                'file_url' => $upload['response'],
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];

            if (!$this->logUpdateUserService->create($dataLog)){
                DB::rollBack();
                return  false;
            }
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $user = $this->userRepository->findById(['id' => $id]);
            if (!$this->teamMemberRepository->deleteByUserId($id)){
                return false;
            }
            $missions = $this->missionRepository->getListByUserId($id);
            $missionTarget = $this->missionRepository->getListByTarget($id);
            if (!empty($missionTarget)){
                foreach ($missionTarget as $mission){
                    if (!$this->feedbackRepository->deleteByMissionId($mission->id)){
                        DB::rollBack();
                        return  false;
                    }
                    if (!$this->missionQuestionAnswerRepository->deleteByMissionId($mission->id)){
                        DB::rollBack();
                        return false;
                    }
                    if (!$this->missionQuestionRepository->deleteByMissionId($mission->id)){
                        DB::rollBack();
                        return  false;
                    }
                    if (!$this->missionRepository->delete($mission->id)){
                        DB::rollBack();
                        return  false;
                    }
                }
            }
            if (!empty($missions)){
                foreach ($missions as $mission){
                    if (!$this->feedbackRepository->deleteByMissionId($mission->id)){
                        DB::rollBack();
                        return  false;
                    }
                    if (!$this->missionQuestionAnswerRepository->deleteByMissionId($mission->id)){
                        DB::rollBack();
                        return false;
                    }
                    if (!$this->missionQuestionRepository->deleteByMissionId($mission->id)){
                        DB::rollBack();
                        return  false;
                    }
                    if (!$this->missionRepository->delete($mission->id)){
                        DB::rollBack();
                        return  false;
                    }
                }
            }
            $brandNotifies = $this->brandNotifyRepository->getList(['brand_id' => $user->brand_id]);
            foreach ($brandNotifies as $brandNotify){
                if (!is_null($brandNotify->option)){
                    $option = @json_decode($brandNotify->option);
                    if (isset($option->user_id) && $option->user_id == $id){
                        if (!$this->brandNotifyRepository->destroy($brandNotify->id)){
                            DB::rollBack();
                            return false;
                        }
                    }
                }
            }
            $systemNotifies = $this->systemNotifyRepository->getList([]);
            foreach ($systemNotifies as $systemNotify){
                if (!is_null($systemNotify->option)){
                    $option = @json_decode($systemNotify->option);
                    if (isset($option->user_id) && $option->user_id == $id){
                        if (!$this->systemNotifyRepository->delete($systemNotify->id)){
                            DB::rollBack();
                            return false;
                        }
                    }
                }
            }
            if (!$this->loginHistoryRepository->deleteByUserId($id)){
                DB::rollBack();
                return false;
            }
            if (!$this->userRepository->delete($id)){
                DB::rollBack();
                return false;
            }
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }
}