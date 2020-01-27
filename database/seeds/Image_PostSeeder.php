<?php

use Illuminate\Database\Seeder;

class Image_PostSeeder extends Seeder
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
    		'order_num' => '1',
    		'type' => 'image/jpeg',
    		'size' => '4104192',
    		'mimetype' => 'image/jpeg',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('image_post')->insert($param);

    	$param = [
    		'post_id' => '1',
    		'order_num' => '2',
    		'type' => 'image/jpeg',
    		'size' => '643072',
    		'mimetype' => 'image/jpeg',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('image_post')->insert($param);

    	$param = [
    		'post_id' => '2',
    		'order_num' => '1',
    		'type' => 'image/jpeg',
    		'size' => '643072',
    		'mimetype' => 'image/jpeg',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('image_post')->insert($param);

        $param = [
            'post_id' => '4',
            'order_num' => '1',
            'type' => 'image/jpeg',
            'size' => '643072',
            'mimetype' => 'image/jpeg',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('image_post')->insert($param);

        $param = [
            'post_id' => '5',
            'order_num' => '1',
            'type' => 'image/jpeg',
            'size' => '643072',
            'mimetype' => 'image/jpeg',
            'created_at' => '1572508694',
            'updated_at' => '1572508694',
        ];
        DB::table('image_post')->insert($param);

    }
}
