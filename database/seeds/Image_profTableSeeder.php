<?php

use Illuminate\Database\Seeder;

class Image_profTableSeeder extends Seeder
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
    		'type' => 'image/jpeg',
    		'size' => '298835',
    		'mimetype' => 'image/jpeg',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('image_prof')->insert($param);

        $param = [
            'user_id' => '2',
            'type' => 'image/jpeg',
            'size' => '642921',
            'mimetype' => 'image/jpeg',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('image_prof')->insert($param);

    }
}
