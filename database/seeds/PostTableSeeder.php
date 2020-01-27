<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$param = [
    		'user_id' => '1',
    		'place' => '株式会社 マーベリックス',
    		'map' => '35.310075,139.484107',
    		'contents' => 'コンテンツ内容、テキスト',
    		'category' => '2',
    		'rating' => '5',
            'pickup' => '1',
            'like' => '30',
    		'publish' => '1',
    		'freeze' => '1',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('post')->insert($param);

        $param = [
            'user_id' => '2',
            'place' => '株式会社 マーベリックス',
            'map' => '35.310075,139.484107',
            'contents' => 'コンテンツ内容、テキスト',
            'category' => '1',
            'date' => '1569888000',
            'rating' => '2',
            'pickup' => '1',
            'like' => '22',
            'publish' => '1',
            'freeze' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('post')->insert($param);

        $param = [
            'user_id' => '2',
            'place' => '株式会社 マーベリックス',
            'map' => '35.310075,139.484107',
            'contents' => 'コンテンツ内容、テキスト',
            'category' => '0',
            'date' => '1569888000',
            'rating' => '4',
            'pickup' => '0',
            'like' => '0',
            'publish' => '1',
            'freeze' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('post')->insert($param);

        $param = [
            'user_id' => '4',
            'place' => '株式会社 マーベリックス',
            'map' => '35.310075,139.484107',
            'contents' => 'コンテンツ内容、テキスト',
            'category' => '2',
            'date' => '1569888000',
            'rating' => '3',
            'pickup' => '0',
            'like' => '16',
            'publish' => '1',
            'freeze' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('post')->insert($param);

        $param = [
            'user_id' => '4',
            'place' => '株式会社 マーベリックス',
            'map' => '35.310075,139.484107',
            'contents' => 'コンテンツ内容、テキスト',
            'category' => '10',
            'date' => '1569888000',
            'rating' => '4',
            'pickup' => '1',
            'like' => '20',
            'publish' => '1',
            'freeze' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('post')->insert($param);

        $param = [
            'user_id' => '5',
            'place' => '株式会社 マーベリックス',
            'map' => '35.310075,139.484107',
            'contents' => '鍵付きアカウントテスト',
            'category' => '10',
            'date' => '1569888000',
            'rating' => '1',
            'pickup' => '0',
            'like' => '0',
            'publish' => '1',
            'freeze' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('post')->insert($param);

    }
}
