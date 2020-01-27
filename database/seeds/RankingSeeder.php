<?php

use Illuminate\Database\Seeder;

class RankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$param = [
    		'post_id' => '1',
    		'count' => '6',
    		'date' => '20190930',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking')->insert($param);

    	$param = [
    		'post_id' => '2',
    		'count' => '12',
    		'date' => '20190930',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking')->insert($param);

    	$param = [
    		'post_id' => '3',
    		'count' => '2',
    		'date' => '20190930',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking')->insert($param);

    	$param = [
    		'post_id' => '1',
    		'count' => '10',
    		'date' => '20191007',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking')->insert($param);

    	$param = [
    		'post_id' => '2',
    		'count' => '28',
    		'date' => '20191007',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking')->insert($param);

    }
}
