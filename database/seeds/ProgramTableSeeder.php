<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            [
                'name' => "テストプログラム１",
                'Detail' => "テスト用のプログラムです！",
                'thumbnail_url' => 'brand/1632969417.jpeg',
                'status' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ],
            [
                'name' => "テストプログラム2",
                'Detail' => "テスト用のプログラムです！",
                'thumbnail_url' => 'brand/1632969497.jpeg',
                'status' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ],
            [
                'name' => "テストプログラム3",
                'Detail' => "テスト用のプログラムです！",
                'thumbnail_url' => 'brand/1632969554.jpeg',
                'status' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ]
        ];

        DB::table('programs')->insert($programs);
    }
}
