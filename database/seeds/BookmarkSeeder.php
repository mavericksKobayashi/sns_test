<?php

use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
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
    		'post_id' => '2',
    		'created_at' => '1572508694',
    		'updated_at' => '1572508694',
    	];
    	DB::table('bookmark')->insert($param);

        $param = [
            'user_id' => '1',
            'post_id' => '3',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('bookmark')->insert($param);

    	$param = [
    		'user_id' => '2',
    		'post_id' => '1',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('bookmark')->insert($param);

        $param = [
            'user_id' => '2',
            'post_id' => '4',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('bookmark')->insert($param);

    	$param = [
    		'user_id' => '3',
    		'post_id' => '1',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('bookmark')->insert($param);

    	$param = [
    		'user_id' => '3',
    		'post_id' => '2',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('bookmark')->insert($param);

    	$param = [
    		'user_id' => '4',
    		'post_id' => '2',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('bookmark')->insert($param);


    }
}
