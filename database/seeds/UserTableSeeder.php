<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'naoyahanai@techasia.biz',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 1,
                'name_sei' => "田中",
                "name_mei" => '圭',
                'name_sei_kana' => "タナカ",
                "name_mei_kana" => 'ケイ',
                'birthday' => '1984/01/01',
                'gender' => 'man',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => '正社員',
                'is_active' => 1,
                'department' => '営業部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => null
            ],
            [
                'email' => 'sample@techasia.biz',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 1,
                'name_sei' => "花井",
                "name_mei" => '直哉',
                'name_sei_kana' => "サトウ",
                "name_mei_kana" => 'タロウ',
                'birthday' => '1984/01/01',
                'gender' => 'man',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => '正社員',
                'is_active' => 1,
                'department' => '企画部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => 'brand/1634028736.jpeg'
            ],
            [
                'email' => 'yuriatakahashi@techasia.biz',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 1,
                'name_sei' => "高橋",
                "name_mei" => 'ゆりあ',
                'name_sei_kana' => "タカハシ",
                "name_mei_kana" => 'ユリア',
                'birthday' => '2000/01/01',
                'gender' => 'woman',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => 'アルバイト',
                'is_active' => 1,
                'department' => '営業部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => 'brand/1634028736.jpeg'
            ],
            [
                'email' => 'rentakawakami@techasia.biz',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 1,
                'name_sei' => "川上",
                "name_mei" => '蓮汰',
                'name_sei_kana' => "カワカミ",
                "name_mei_kana" => 'レンタ',
                'birthday' => '1999/01/01',
                'gender' => 'man',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => 'アルバイト',
                'is_active' => 1,
                'department' => '企画部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => 'brand/1634028736.jpeg'
            ],
            [
                'email' => 'sato@techasia.biz',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 2,
                'name_sei' => "佐藤",
                "name_mei" => '太郎',
                'name_sei_kana' => "サトウ",
                "name_mei_kana" => 'タロウ',
                'birthday' => '1999/01/01',
                'gender' => 'man',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => '正社員',
                'is_active' => 1,
                'department' => '営業部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => 'brand/1634028736.jpeg'
            ],
            [
                'email' => 'kato@techasia.biz',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 2,
                'name_sei' => "加藤",
                "name_mei" => '五郎',
                'name_sei_kana' => "カトウ",
                "name_mei_kana" => 'ゴロウ',
                'birthday' => '1999/01/01',
                'gender' => 'man',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => '正社員',
                'is_active' => 1,
                'department' => '企画部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => 'brand/1634028736.jpeg'
            ],
            [
                'email' => 'morimoto@techasia.biz',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 2,
                'name_sei' => "森本",
                "name_mei" => '花子',
                'name_sei_kana' => "モリモト",
                "name_mei_kana" => 'ハナコ',
                'birthday' => '1999/01/01',
                'gender' => 'woman',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => 'アルバイト',
                'is_active' => 1,
                'department' => '営業部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => 'brand/1634028736.jpeg'
            ],
            [
                'email' => 'kaneko@techasia.biz ',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 2,
                'name_sei' => "金子",
                "name_mei" => '真紀',
                'name_sei_kana' => "カネコ",
                "name_mei_kana" => 'マキ',
                'birthday' => '1999/01/01',
                'gender' => 'woman',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => 'アルバイト',
                'is_active' => 1,
                'department' => '企画部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => 'brand/1634028736.jpeg'
            ],
            [
                'email' => 'khanam@techasia.biz',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 2,
                'name_sei' => "Kha",
                "name_mei" => 'Nam',
                'name_sei_kana' => "Kha",
                "name_mei_kana" => 'Nam',
                'birthday' => '2000/09/30',
                'gender' => 'man',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => '正社員',
                'is_active' => 1,
                'department' => '営業部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => 'brand/1634028736.jpeg'
            ],
            [
                'email' => 'nguyenduycuong@techasia.biz',
                'password' => Hash::make('12345678'),
                'detail' => '詳細',
                'brand_id' => 2,
                'name_sei' => "Duy",
                "name_mei" => 'Cuong',
                'name_sei_kana' => "Duy",
                "name_mei_kana" => 'Cuong',
                'birthday' => '1991/01/01',
                'gender' => 'man',
                'verified' => 1,
                'email_verified_at' => '2021-01-01',
                'employment_status' => '正社員',
                'is_active' => 1,
                'department' => '営業部',
                'is_admin' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'thumbnail_url' => 'brand/1634028736.jpeg'
            ]
        ]);
    }
}
