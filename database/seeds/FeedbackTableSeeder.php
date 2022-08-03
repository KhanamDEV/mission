<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedbacks')->insert([
            [
                'mission_id' => 1,
                'user_id' => 1,
                'title' => 'メンバーの出身地と地元のオススメお土産',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 2,
                'user_id' => 2,
                'title' => 'メンバーの出身地と地元のオススメお土産',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 3,
                'user_id' => 3,
                'title' => 'メンバーの出身地と地元のオススメお土産',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 4,
                'user_id' => 1,
                'title' => 'メンバーの部活動',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 5,
                'user_id' => 2,
                'title' => 'メンバーの部活動',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 6,
                'user_id' => 3,
                'title' => 'メンバーの部活動',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 7,
                'user_id' => 1,
                'title' => 'チームメンバーから見た第一印象',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 8,
                'user_id' => 2,
                'title' => 'チームメンバーから見た第一印象',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 9,
                'user_id' => 3,
                'title' => 'チームメンバーから見た第一印象',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 10,
                'user_id' => 1,
                'title' => '好きな画像',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 11,
                'user_id' => 4,
                'title' => '好きな画像',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 12,
                'user_id' => 1,
                'title' => 'メンバーの苦手なこと',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 13,
                'user_id' => 4,
                'title' => 'メンバーの苦手なこと',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 14,
                'user_id' => 1,
                'title' => 'メンバーが考えるチームの目標',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 15,
                'user_id' => 4,
                'title' => 'メンバーが考えるチームの目標',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 16,
                'user_id' => 5,
                'title' => '仕事で大変なこと',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 17,
                'user_id' => 6,
                'title' => '仕事で大変なこと',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 18,
                'user_id' => 5,
                'title' => 'メンバーのチーム満足度',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 19,
                'user_id' => 6,
                'title' => 'メンバーのチーム満足度',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 20,
                'user_id' => 5,
                'title' => '学級委員の経験',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 21,
                'user_id' => 6,
                'title' => '学級委員の経験',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 22,
                'user_id' => 5,
                'title' => 'チームの心理的安全スコア',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'mission_id' => 23,
                'user_id' => 6,
                'title' => 'チームの心理的安全スコア',
                'detail' => 'feedback details',
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細',
                'thumbnail_url' => 'brand/1632969136.png',
                'created_at' => date('Y-m-d H:i:s')
            ],



        ]);
    }
}
