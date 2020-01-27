<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
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
    		'message_user_id' => '2',
    		'message_cont' => 'ご飯',
        'message_group' => '12',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('message')->insert($param);

      $param = [
    		'user_id' => '2',
    		'message_user_id' => '1',
    		'message_cont' => '飯',
        'message_group' => '21',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('message')->insert($param);

      $param = [
    		'user_id' => '1',
    		'message_user_id' => '2',
    		'message_cont' => 'パン',
        'message_group' => '12',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('message')->insert($param);

      $param = [
    		'user_id' => '1',
    		'message_user_id' => '4',
    		'message_cont' => 'パン',
        'message_group' => '14',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('message')->insert($param);

      $param = [
    		'user_id' => '1',
    		'message_user_id' => '5',
    		'message_cont' => 'パン',
        'message_group' => '15',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('message')->insert($param);

      $param = [
    		'user_id' => '3',
    		'message_user_id' => '1',
    		'message_cont' => 'パンチ',
        'message_group' => '31',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('message')->insert($param);

      $param = [
    		'user_id' => '6',
    		'message_user_id' => '1',
    		'message_cont' => 'パンチ',
        'message_group' => '61',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('message')->insert($param);

    }
}
