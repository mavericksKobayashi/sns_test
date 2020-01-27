<?php

use Illuminate\Database\Seeder;

class Ranking_mSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$param = [
    		'post_id' => '5',
    		'count' => '6',
    		'date' => '201910',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_m')->insert($param);

    	$param = [
    		'post_id' => '4',
    		'count' => '12',
    		'date' => '201910',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_m')->insert($param);

    	$param = [
    		'post_id' => '2',
    		'count' => '2',
    		'date' => '201910',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_m')->insert($param);

    	$param = [
    		'post_id' => '1',
    		'count' => '10',
    		'date' => '201910',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_m')->insert($param);

    	$param = [
    		'post_id' => '2',
    		'count' => '28',
    		'date' => '201909',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_m')->insert($param);

    }
}
