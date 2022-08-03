<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')
            ->insert([
                [
                    'email' => 'naoyahanai@techasia.biz',
                    'password' => Hash::make('12345678'),
                    'name' => '田中商事',
                    'verification_code' => '0b7b693608626a2893db497f606aa50b4566d4a4',
                    'verified' => 1,
                    'email_verified_at' => date('Y/m/d H:i:s'),
                    'thumbnail_url' => 'brand/1632966646.png',
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s')
                ],
                [
                    'email' => 'khanam@techasia.biz',
                    'password' => Hash::make('12345678'),
                    'name' => '田中商事',
                    'verification_code' => '0b7b693608626a2893db497f606aa50b4566d4a4',
                    'verified' => 1,
                    'thumbnail_url' => 'brand/1632970167.png',
                    'email_verified_at' => date('Y/m/d H:i:s'),
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s')
                ],
            ]);
    }
}
