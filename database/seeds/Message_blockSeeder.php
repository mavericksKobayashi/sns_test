<?php

use Illuminate\Database\Seeder;

class Message_blockSeeder extends Seeder
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
    		'block_id' => '2',
    	];
    	DB::table('message_block')->insert($param);

    }
}
