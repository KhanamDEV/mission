<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackBaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedback_bases')->insert([
            [
                'title' => 'メンバーの出身地と地元のオススメお土産',
                'mission_base_id' => 1,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ],
            [
                'title' => 'メンバーの部活動',
                'mission_base_id' => 2,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ],
            [
                'title' => 'チームメンバーから見た第一印象',
                'mission_base_id' => 3,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ],
            [
                'title' => '好きな画像',
                'mission_base_id' => 4,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ],
            [
                'title' => 'メンバーの苦手なこと',
                'mission_base_id' => 5,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ],
            [
                'title' => 'メンバーが考えるチームの目標',
                'mission_base_id' => 6,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ],
            [
                'title' => '仕事で大変なこと',
                'mission_base_id' => 7,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ],
            [
                'title' => 'メンバーのチーム満足度',
                'mission_base_id' => 8,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ],
            [
                'title' => '学級委員の経験',
                'mission_base_id' => 9,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ],
            [
                'title' => 'チームの心理的安全スコア',
                'mission_base_id' => 10,
                'detail' => 'feedback details',
                'thumbnail_url' => 'brand/1632969136.png',
                'percent' => 0,
                'hint_title' => 'タイトル詳細',
                'hint_detail' => 'タイトル詳細'
            ]
        ]);
    }
}
