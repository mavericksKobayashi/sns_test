<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$param = [
    		'flip_id' => 'mavericks',
    		'nickname' => 'マーベリックス',
    		'email' => 'onizuka@mavericks09.com',
    		'password' => '$2y$10$zQTVT//MK7J8917Fgc5J8e2iV.aE5L.d4z18u4y5CcmZBO2jsJzBe',
    		'place' => '日本',
    		'gender' => '男性',
    		'self_intro' => '',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('users')->insert($param);

    	$param = [
    		'flip_id' => 'c04212e543',
    		'nickname' => '鬼塚',
    		'email' => 'cafeoni@yahoo.co.jp',
    		'password' => '$2y$10$9yVAw0qL14iyb.so3pJ1iup.u1G4M4ws03lmy6xZGX87yS0Mt7WWC',
    		'place' => 'earth',
    		'gender' => '女性',
    		'self_intro' => '自己紹介',
            'locked' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
    	];
    	DB::table('users')->insert($param);

        $param = [
            'flip_id' => 'mavericks',
            'nickname' => 'ニックネーム',
            'email' => 'onizuka2@mavericks09.com',
            'password' => '$2y$10$zQTVT//MK7J8917Fgc5J8e2iV.aE5L.d4z18u4y5CcmZBO2jsJzBe',
            'place' => '',
            'gender' => '',
            'self_intro' => '',
            'block' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('users')->insert($param);

        $param = [
            'flip_id' => 'c04212e543',
            'nickname' => 'ニッキ',
            'email' => 'onizuka3@mavericks09.com',
            'password' => '$2y$10$9yVAw0qL14iyb.so3pJ1iup.u1G4M4ws03lmy6xZGX87yS0Mt7WWC',
            'place' => 'アジア',
            'gender' => '',
            'self_intro' => '自己紹介',
            'block' => '1',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('users')->insert($param);

        $param = [
            'flip_id' => 'mavericks',
            'nickname' => '鍵付きアカウント',
            'email' => 'onizuka4@mavericks09.com',
            'password' => '$2y$10$zQTVT//MK7J8917Fgc5J8e2iV.aE5L.d4z18u4y5CcmZBO2jsJzBe',
            'place' => '藤沢',
            'gender' => '男性',
            'self_intro' => '鍵付きアカウント鍵付きアカウント鍵付きアカウント',
            'locked' => '1',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('users')->insert($param);

        $param = [
            'flip_id' => 'c04212e543',
            'nickname' => '片瀬のサーファー',
            'email' => 'onizuka5@mavericks09.com',
            'password' => '$2y$10$9yVAw0qL14iyb.so3pJ1iup.u1G4M4ws03lmy6xZGX87yS0Mt7WWC',
            'place' => '片瀬海岸',
            'gender' => '女性',
            'self_intro' => '自己紹介ですわ',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('users')->insert($param);
    }
}
