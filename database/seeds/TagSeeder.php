<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$param = [
    		'post_id' => '2',
    		'name' => '海外旅行',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('tag')->insert($param);

    	$param = [
    		'post_id' => '2',
    		'name' => '山歩き',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('tag')->insert($param);

    	$param = [
    		'post_id' => '3',
    		'name' => '海外旅行',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('tag')->insert($param);

    	$param = [
    		'post_id' => '3',
    		'name' => '山歩き',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('tag')->insert($param);

    	$param = [
    		'post_id' => '4',
    		'name' => '国内旅行',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('tag')->insert($param);

    	$param = [
    		'post_id' => '5',
    		'name' => '海外旅行',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('tag')->insert($param);

    	$param = [
    		'post_id' => '5',
    		'name' => 'ロンドン',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('tag')->insert($param);

    }
}
