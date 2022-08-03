<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //type = 1 : Checkbox
        //type = 2 : Select
        //type = 3 : Text
        //type = 4 : Image
        if (env('ENVIRONMENT') == 'production') {
            $dataInsert = [];
            for ($i = 1; $i <= 10; $i++) {
                $arrDemo = [
                    [
                        'mission_base_id' => $i,
                        'title' => "チーム内でミスを起こすと、よく批判をされる",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 1,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チームのメンバー内で、課題やネガティブなことを言い合うことができる",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 2,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チーム内のメンバーは、異質なものを受け入れない傾向にある",
                        'type' => 2,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 3,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チームに対して、リスクが考えられるアクションを取っても安心感がある",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 4,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チーム内のメンバーにヘルプを出しづらい",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 5,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チーム内で自分を騙すようなメンバーはいない",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 6,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "現在のチームで業務を進める際、自分のスキルが発揮されていると感じる",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 7,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ]
                ];
                foreach ($arrDemo as $item) {
                    array_push($dataInsert, $item);
                }
            }

        } else {
            $dataInsert = [];
            for ($i = 1; $i <= 10; $i++) {
                $arrDemo = [
                    [
                        'mission_base_id' => $i,
                        'title' => "チーム内でミスを起こすと、よく批判をされる",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 1,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チームのメンバー内で、課題やネガティブなことを言い合うことができる",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 2,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チーム内のメンバーは、異質なものを受け入れない傾向にある",
                        'type' => 2,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 3,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チームに対して、リスクが考えられるアクションを取っても安心感がある",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 4,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チーム内のメンバーにヘルプを出しづらい",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 5,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "チーム内で自分を騙すようなメンバーはいない",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 6,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ],
                    [
                        'mission_base_id' => $i,
                        'title' => "現在のチームで業務を進める際、自分のスキルが発揮されていると感じる",
                        'type' => 1,
                        'choice' => '当てはまらない, やや当てはまらない, どちらでもない, やや当てはまる, 当てはまる, かなり当てはまる',
                        'delivery_order_number' => 7,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ]
                ];
                foreach ($arrDemo as $item) {
                    array_push($dataInsert, $item);
                }
            }
        }
        DB::table('mission_question_answer_bases')->insert($dataInsert);
    }

}
