<?php

use Illuminate\Database\Seeder;

class Ranking_ySeeder extends Seeder
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
    		'date' => '2019',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_y')->insert($param);

    	$param = [
    		'post_id' => '2',
    		'count' => '12',
    		'date' => '2019',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_y')->insert($param);

    	$param = [
    		'post_id' => '3',
    		'count' => '2',
    		'date' => '2019',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_y')->insert($param);

    	$param = [
    		'post_id' => '1',
    		'count' => '10',
    		'date' => '2019',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_y')->insert($param);

    	$param = [
    		'post_id' => '2',
    		'count' => '28',
    		'date' => '2018',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('ranking_y')->insert($param);

    }
}
