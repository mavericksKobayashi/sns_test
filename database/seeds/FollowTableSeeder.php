<?php

use Illuminate\Database\Seeder;

class FollowTableSeeder extends Seeder
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
    		'follow_id' => '2',
    		'muted' => '0',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('follow')->insert($param);

    	$param = [
    		'user_id' => '1',
    		'follow_id' => '3',
    		'muted' => '0',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('follow')->insert($param);

    	$param = [
    		'user_id' => '1',
    		'follow_id' => '4',
    		'muted' => '0',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('follow')->insert($param);

    	$param = [
    		'user_id' => '2',
    		'follow_id' => '1',
    		'muted' => '0',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('follow')->insert($param);

        $param = [
            'user_id' => '2',
            'follow_id' => '4',
            'muted' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('follow')->insert($param);

        $param = [
            'user_id' => '2',
            'follow_id' => '5',
            'muted' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('follow')->insert($param);

        $param = [
            'user_id' => '3',
            'follow_id' => '2',
            'muted' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('follow')->insert($param);

        $param = [
            'user_id' => '4',
            'follow_id' => '2',
            'muted' => '0',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('follow')->insert($param);

    }
}
