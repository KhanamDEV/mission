<?php


namespace App\Service\Api;


use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Jobs\SendNotificationCommon;
use App\Jobs\SendNotificationNewFeedback;
use App\Repository\Api\Team\TeamMemberRepositoryInterface;
use App\Repository\Api\User\UserRepositoryInterface;
use App\Service\Firebase\PushNotificationTokenTrait;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    use PushNotificationTokenTrait;

    private $userRepository;
    private $apiUploadService;
    private $teamMemberRepository;

    public function __construct(UserRepositoryInterface $userRepository, ApiUploadService $apiUploadService, TeamMemberRepositoryInterface $teamMemberRepository)
    {
        $this->userRepository = $userRepository;
        $this->apiUploadService = $apiUploadService;
        $this->teamMemberRepository = $teamMemberRepository;
    }

    public function detail()
    {
        return JWTAuth::user();
    }

    public function update($type = 'all')
    {
        if ($type == 'all') {
            $nameSeiKana = Helpers::getParamRequest('name_sei_kana');
            $nameMeiKana = Helpers::getParamRequest('name_mei_kana');
            $pattern = '/^[ア-ン゛゜ァ-ォャ-ョー ]+$/u';

            if (!preg_match($pattern, $nameSeiKana) || !preg_match($pattern, $nameMeiKana)) {
                return ['status' => false, 'message' => __('api::message.user.validate_kana_text')];
            }
            $dataUser = [
                'name_sei' => Helpers::getParamRequest('name_sei'),
                'name_mei' => Helpers::getParamRequest('name_mei'),
                'name_sei_kana' => Helpers::getParamRequest('name_sei_kana'),
                'name_mei_kana' => Helpers::getParamRequest('name_mei_kana'),
                'detail' => Helpers::getParamRequest('detail'),
                'updated_at' => date('Y/m/d H:i:s')
            ];

            if (!empty(Helpers::getParamRequest('thumbnail_url'))){
                $dataUser['thumbnail_url'] = str_replace(env("AWS_URL"), "", Helpers::getParamRequest('thumbnail_url'));
            }
        }
        if ($type == 'avatar') {
            $dataUser = [
                'thumbnail_url' => str_replace(env("AWS_URL"), "", Helpers::getParamRequest('thumbnail_url')),
                'updated_at' => date('Y/m/d H:i:s')
            ];
        }
        if ($type == 'push_notification_token') {
            $user = $this->userRepository->findById(JWTAuth::user()->id);
            $token = Helpers::getParamRequest('token');
            if (!is_string($token)) return false;
            if (!empty($user->push_notification_token)) {
                $data = @json_decode($user->push_notification_token, true);
                if (is_array($data)) {
                    foreach ($data as $row) {
                        if ($row["token"] == $token) return true;
                    }
                } else {
                    $data = [];
                }
            }
            $data[] = [
                'token' => $token,
                'device' => Helpers::getParamRequest('device')
            ];

            $dataUser = [
                'push_notification_token' => (!empty($data) ? @json_encode($data) : null),
                'updated_at' => date('Y-m-d H:i:s')
            ];

        }
        return $this->userRepository->updateByEmail(JWTAuth::user()->email, $dataUser);
    }

    public function getList()
    {
        $user = JWTAuth::user();
        return $this->userRepository->getListByBrandId($user->brand_id);
    }

    public function removePushNotificationToken()
    {
        $token = Helpers::getParamRequest('token');
        if (!is_string($token)) return false;
        $user = $this->userRepository->findById(JWTAuth::user()->id);

        $_data_map = [];
        if (!empty($user->push_notification_token)) {
            $data = @json_decode($user->push_notification_token, true);
            if (is_array($data)) {
                foreach ($data as $key => $row) {
                    if ($row["token"] != $token) {
                        $_data_map[] = $row;
                    }
                }
            }
        } else {
            return true;
        }

        $dataUser = [
            'push_notification_token' => (!empty($_data_map) ? @json_encode($_data_map) : null),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        return $this->userRepository->updateByEmail(JWTAuth::user()->email, $dataUser);
    }

    public function sendNotification()
    {
        DB::beginTransaction();
        try {
            $dataRequest = request()->all();
            $user = JWTAuth::user();
            $teamMember = $this->teamMemberRepository->findById($dataRequest['user_id']);
            $userReceive = $this->userRepository->findById($teamMember->user_id);
            if (is_null($userReceive)) return false;
            if (is_null($userReceive->push_notification_token)) return true;
            if (!$this->userRepository->upNumberNotification($userReceive->id)){
                DB::rollBack();
                return false;
            }
            foreach (@json_decode($userReceive->push_notification_token) as $objToken) {
                $objToken->badge = $userReceive->number_notification + 1;
                $jobSendNotification = new SendNotificationCommon($dataRequest, $objToken, $user);
                dispatch($jobSendNotification)->delay(now()->addSeconds(2));
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            ResponseHelpers::messageSlack(['position' => 'notification beer', 'message' => $e->getMessage()]);
            return false;
        }
    }

    public function resetNumberNotify(){
            if (JWTAuth::user()->number_notification){
                return $this->userRepository->update(['number_notification' => 0, 'updated_at' => date('Y-m-d H:i:s')], JWTAuth::user()->id);
            }
            return  true;
    }

}