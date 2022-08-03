<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiV1Controller extends Controller
{
    /**
     * @group V1/Mission
     * api/v1/mission
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "answered": [
     *              {
     *                  "id": 1,
     *                  "name": "Mission 1",
     *                  "team_name": "Team 1",
     *                  "delivery_order_date": "30-09-2021",
     *                  "thumbnail": {
     *                      "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                      "height": 1356,
     *                      "width": 2048,
     *                      "ratio": 0.75
     *                  },
     *                  "is_target": true,
     *                  "user_target": {
     *                      "name": "abc/xyz",
     *                      "id" : 1
     *                  }
     *              }
     *          ],
     *          "not_answered": [
     *              {
     *                  "id": 2,
     *                  "name": "Mission 2",
     *                  "team_name": "Team 2",
     *                  "delivery_order_date": "2021-09-30",
     *                  "thumbnail": {
     *                      "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                      "height": 1356,
     *                      "width": 2048,
     *                      "ratio": 0.75
     *                  },
     *                  "is_target": true,
     *                  "user_target": {
     *                      "name": "abc/xyz",
     *                      "id" : 1
     *                  }
     *              },
     *              {
     *                  "id": 2,
     *                  "name": "Mission 2",
     *                  "team_name": "Team 2",
     *                  "delivery_order_date": "2021-09-30",
     *                  "thumbnail": {
     *                      "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                      "height": 1356,
     *                      "width": 2048,
     *                      "ratio": 0.75
     *                  },
     *                  "is_target": false,
     *                  "user_target": {}
     *              }
     *          ]
     *      }
     * }
     */
    public function missionIndex(){}

    /**
     * @group V1/Mission
     * api/v1/mission/question
     * type: 1 => checkbox, 2 => select, 3 => text, 4 => image
     * @bodyParam id numeric required The mission id contain question
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "mission": {
     *              "id": 1,
     *              "name": "Mission 1",
     *              "is_target": "true",
     *              "user_target": {
     *                  "id" : 1,
     *                  "name": "abc/xyz"
     *              }
     *          },
     *          "questions": [
     *              {
     *                  "id": 1,
     *                  "title": "What your name ?",
     *                  "type": 1,
     *                  "choice": [
     *                      "Nam",
     *                      "Cuong"
     *                  ]
     *              }
     *          ]
     *      }
     * }
     */
    public function missionQuestion(){}

    /**
     * @group V1/Mission
     * api/v1/mission/question
     *
     * @bodyParam answers json required The json array contain answer ( [{"id":1,"title":"What is your favorite fruit?","type": 1,"choice":["A","B","C","D"],"answer":["A","B"]}] )
     * @bodyParam mission_id numeric required The id mission of question
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function missionStoreAnswerQuestion(){}

    /**
     * @group V1/Mission
     * api/v1/mission/question-answered
     *
     * @bodyParam mission_id numeric required The mission base id contain question
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "mission": {
     *              "id": 1,
     *              "name": "Mission 1",
     *              "delivery_order_date": "2021-06-28"
     *          },
     *          "questions": [
     *              {
     *                  "id": 1,
     *                  "title": "What your name ?",
     *                  "type": "1",
     *                  "choice": [
     *                      "Nam",
     *                      "Cuong"
     *                  ]
     *              },
     *              {
     *                  "id": 2,
     *                  "title": "How old are u ?",
     *                  "type": "3",
     *                  "choice": "21"
     *              }
     *          ]
     *      }
     * }
     */
    public function missionShowQuestionAnswered(){}

    /**
     * @group V1/Mission
     * api/v1/mission/edit-question-answered
     *
     * @bodyParam answers json required The json array contain answer ( [{"id":1,"question_id": 1,"title":"What is your favorite fruit?","type": 1,"choice":["A","B","C","D"],"answer":["A","B"]}] )
     * @bodyParam mission_id The id of mission contain answers
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function missionUpdateQuestionAnswered(){}

    /**
     * @group V1/Feedback
     * api/v1/feedback
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "title": "Mission 1",
     *              "detail": "Detail mission",
     *              "thumbnail": {
     *                  "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                  "height": 1536,
     *                  "width": 2048,
     *                  "ratio": 0.75
     *              }
     *          }
     *      ]
     * }
     */
    public function feedbackIndex(){}

    /**
     * @group V1/Feedback
     * api/v1/feedback/detail
     *
     * @bodyParam id numeric required The id of feedback
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "feedback": {
     *              "title": "Mission 1",
     *              "thumbnail": {
     *                  "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                  "height": 1536,
     *                  "width": 2048,
     *                  "ratio": 0.75
     *              }
     *          },
     *          "answers": [
     *              {
     *                  "title": "What is your favorite fruit?",
     *                  "list_answer": [
     *                      {
     *                          "user" : "田中圭/タナカケイ",
     *                          "type": 1,
     *                          "answer": ["Ex1","Ex2"]
     *                      },
     *                      {
     *                          "user": "田中圭/タナカケイ111",
     *                          "type": 3,
     *                          "answer": "abcd"
     *                      }
     *                  ]
     *              }
     *          ]
     *      }
     * }
     */
    public function feedbackShow(){}

    /**
     * @group V1/Team
     * api/v1/team
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "name": "Team 1",
     *              "detail": "Detail team 1",
     *              "thumbnail": {
     *                  "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                  "height": 1536,
     *                  "width": 2048,
     *                  "ratio": 0.75
     *              }
     *          }
     *      ]
     * }
     */
    public function teamIndex(){}

    /**
     * @group V1/Team
     * api/v1/team/create
     *
     * @bodyParam data json required The data create team ({"team":{"thumbnail_url":"url image","name":"Team 1"},"users":[{"id":1,"is_leader":true}],"program_id":1})
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function teamStore(){}

    /**
     * @group V1/Team
     * api/v1/team/edit
     *
     * @bodyParam team_id numeric required The team id
     * @bodyParam name string required The name of team
     * @bodyParam thumbnail_url string The url image thumbnail team
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function teamUpdate(){}

    /**
     * @group V1/Team
     * api/v1/team/member
     *
     * @bodyParam id numeric required The id of team
     * @bodyParam type string  The type get member (get for show, get for edit) Ex:  edit
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "name": "KhaNam/KhaNam",
     *              "name_sei": "Kha",
     *              "name_mei": "Nam",
     *              "is_team_member": 1,
     *              "is_leader": 1,
     *              "position": "member",
     *              "thumbnail": {
     *                  "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                  "height": 1536,
     *                  "width": 2048,
     *                  "ratio": 0.75
     *              }
     *          }
     *      ]
     * }
     */
    public function teamMember(){}

    /**
     * @group V1/Team
     * api/v1/team/member/detail
     *
     * @bodyParam id numeric required The id of member
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "id": 1,
     *          "name_sei": "Kha",
     *          "name_mei": "Nam",
     *          "name_sei_kana": "Kha",
     *          "name_mei_kana": "Nam",
     *          "name": "Kha Nam / Kha Nam",
     *          "department": "department",
     *          "detail": "This is detail",
     *          "thumbnail": {
     *              "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *              "height": 1536,
     *              "width": 2048,
     *              "ratio": 0.75
     *          }
     *      }
     * }
     */
    public function teamShowMember(){}

    /**
     * @group V1/Team
     * api/v1/team/detail
     *
     * @bodyParam id numeric required The id of team
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "id": 1,
     *          "name": "Team 1",
     *          "program_id": 1,
     *          "program_name": "Program 1",
     *          "thumbnail": {
     *              "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *              "height": 1536,
     *              "width": 2048,
     *              "ratio": 0.75
     *          }
     *      }
     * }
     */
    public function teamDetail(){}

    /**
     * @group V1/Team
     * api/v1/team/edit-program
     *
     * @bodyParam team_id numeric required The team id
     * @bodyParam program_id numeric required The program id
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function teamUpdateProgram(){}

    /**
     * @group V1/Team
     * api/v1/team/edit-member
     *
     * @bodyParam team_id numeric required The team id
     * @bodyParam members json required The data user ( [{"id":1,"is_leader":true}] )
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function teamUpdateMember(){}

    /**
     * @group V1/Team
     * api/v1/team/delete
     *
     * @bodyParam team_id numeric required The team id
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function teamDestroy(){}

    /**
     * @group V1/Program
     * api/v1/program
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "name": "Program 1",
     *              "detail": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure molestiae voluptate at ab quae, maiores assumenda sapiente accusamus repellendus ea sint. Corporis laborum deleniti dolor doloribus a molestias esse nostrum?",
     *              "thumbnail": {
     *                  "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                  "height": 1536,
     *                  "width": 2048,
     *                  "ratio": 0.75
     *              }
     *          }
     *      ]
     * }
     */
    public function programIndex(){}

    /**
     * @group V1/Program
     * api/v1/program/detail
     *
     * @bodyParam id numeric required The id of program
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "id": 1,
     *          "name": "Program 1",
     *          "detail": "Detail program 1",
     *          "thumbnail": {
     *              "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *              "height": 1536,
     *              "width": 2048,
     *              "ratio": 0.75
     *          }
     *      }
     * }
     */
    public function programShow(){}

    /**
     * @group V1/User
     * api/v1/user/detail
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "name_sei": "Kha",
     *          "name_mei": "Nam",
     *          "name_sei_kana": "Kha kana",
     *          "name_mei_kana": "Nam kana",
     *          "detail": "Detail",
     *          "thumbnail": {
     *              "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *              "height": 1536,
     *              "width": 2048,
     *              "ratio": 0.75
     *          }
     *      }
     * }
     */
    public function userDetail(){}

    /**
     * @group V1/User
     * api/v1/user/edit
     *
     * @bodyParam name_sei string
     * @bodyParam name_mei string
     * @bodyParam name_sei_kana string
     * @bodyParam name_mei_kana string
     * @bodyParam detail string
     * @bodyParam thumbnail_url string
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function userUpdate(){}

    /**
     * @group V1/User
     * api/v1/user/upload-avatar
     * @bodyParam thumbnail_url string required The image of user
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function userUpdateAvatar(){}

    /**
     * @group V1/User
     * api/v1/user
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "name_sei": "name sei",
     *              "name_mei": "name mei",
     *              "name_sei_kana": "name sei kana",
     *              "name_mei_kana": "name mei kana",
     *              "thumbnail": {
     *                  "url": "url image",
     *                  "height": 1365,
     *                  "width": 720,
     *                  "ratio": 2
     *              }
     *          }
     *      ]
     * }
     */
    public function userIndex(){}

    /**
     * @group V1/User
     * api/v1/user/update-push-notification-token
     * @bodyParam token string required
     * @bodyParam device string required Ex: android, iOS
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function userUpdatePushNotificationToken(){}

    /**
     * @group V1/User
     * api/v1/user/remove-push-notification-token
     * @bodyParam token string required
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function userRemovePushNotificationToken(){}

    /**
     * @group V1/User
     * api/v1/user/send-notification
     * @bodyParam user_id int id of user receive notify
     * @bodyParam type string Ex: beer
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     */
    public function userSend(){}

    /**
     * @group V1/Upload
     * api/v1/upload-image
     * @bodyParam image base64 required The image
     * @bodyParam type string required The type of image Ex: question, team,...
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "url": "url image"
     *      }
     * }
     */
    public function upload(){}

    /**
     * @group V1/ForgetPassword
     * api/v1/forget-password
     * @bodyParam email string required The email of brand account
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 401{
     *      "meta": {
     *          "status": 401,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function passwordConfirmMail(){}

    /**
     * @group V1/ForgetPassword
     * api/v1/forget-password/confirm
     * @bodyParam email string required The email of brand account
     * @bodyParam token string required The token send to mail
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function passwordConfirmToken(){}

    /**
     * @group V1/ForgetPassword
     * api/v1/forget-password/change
     * @bodyParam email string required The email of brand account
     * @bodyParam password string required The new password of brand account
     * @bodyParam token string required The token send to mail
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function passwordChangePassword(){}

    /**
     * @group V1/SignIn
     * api/v1/sign-in
     * @bodyParam email string required The email of brand account
     * @bodyParam password string required The password of brand account
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "id": 1,
     *          "email": "khanam@techasia.biz",
     *          "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvc2lnbi1pbiIsImlhdCI6MTYyMTU2OTA2NiwiZXhwIjoxNjIxNTcyNjY2LCJuYmYiOjE2MjE1NjkwNjYsImp0aSI6IjEyZEVkdGdFTnUweHZnd24iLCJzdWIiOjEsInBydiI6IjIzOWNmMmI3ZDU4MjI2ZTgyMWMxMjQxMDAyMzBkZWU5ZmE4ZWQ2NzkifQ.b0R2TRZxGyBq9JUMCjgt-fjFieNEd5Ywo1jD9u_WPZA"
     *      }
     * }
     *
     * @response 401{
     *      "meta": {
     *          "status": 401,
     *          "message": "メールアドレスとパスワードが不一致"
     *      },
     *      "response": null
     * }
     *
     */
    public function postSignIn(){}

    /**
     * @group V1/SinglePage
     * api/v1/single-page
     *
     * @bodyParam page string The page get content Ex: api/v1/single-page/company, api/v1/single-page/term_privacy
     *
     * @response 200{
     *      "response" : "html content"
     * }
     *
     * @response 500{
     *      "response" : ""
     * }
     */
    public function getContentPage($page){}
}
