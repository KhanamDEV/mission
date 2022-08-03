<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MissionBaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataMissionBase = [
            [
                'name' => '出身地は？地元のオススメのお土産は？',
                'detail' => 'Detail mission',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => false,
                'time_required' => '30分',
                'is_anonymous' => false
            ],
            [
                'name' => '中学と高校の部活動それぞれ何部だった？',
                'detail' => 'test',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => false,
                'time_required' => '30分',
                'is_anonymous' => false
            ],
            [
                'name' => '田中さんの第一印象を一言で（20字以内）',
                'detail' => 'Detail mission',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => true,
                'time_required' => '30分',
                'is_anonymous' => false
            ],
            [
                'name' => '好きな画像をアップしてみよう',
                'detail' => 'Detail mission',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => false,
                'time_required' => '30分',
                'is_anonymous' => false
            ],
            [
                'name' => '自分の苦手なことを一つあげるとすると何だろう？（20字以内）',
                'detail' => 'Detail mission',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => false,
                'time_required' => '30分',
                'is_anonymous' => true
            ],
            [
                'name' => '今月のチームの目標は何ですか？（20字以内）',
                'detail' => 'Detail mission',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => false,
                'time_required' => '30分',
                'is_anonymous' => true
            ],
            [
                'name' => '今、仕事で一番大変なことは何ですか？（20字以内）',
                'detail' => 'Detail mission',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => false,
                'time_required' => '30分',
                'is_anonymous' => true
            ],
            [
                'name' => 'このチームの満足度は10段階中どれくらいですか？',
                'detail' => 'Detail mission',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => false,
                'time_required' => '30分',
                'is_anonymous' => false
            ],
            [
                'name' => '過去に学級委員をやったことはありますか？',
                'detail' => 'Detail mission',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => false,
                'time_required' => '30分',
                'is_anonymous' => true
            ],
            [
                'name' => '今のチームについて考えてみよう',
                'detail' => 'Detail mission',
                'thumbnail_url' => 'brand/1632966849.png',
                'is_target' => false,
                'time_required' => '30分',
                'is_anonymous' => false
            ]
        ];
        $dataMission = [];
        foreach ($dataMissionBase as $missionBase){
            array_push($dataMission, [
                'name' => $missionBase['name'],
                'detail' => $missionBase['detail'],
                'is_target' => $missionBase['is_target'],
                'thumbnail_url' => $missionBase['thumbnail_url'],
                'time_required' => $missionBase['time_required'],
                'is_anonymous' => $missionBase['is_anonymous'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        DB::table('mission_bases')->insert($dataMission);

    }
}
