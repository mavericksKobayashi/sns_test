<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$param = [
            'parent' => '1',
    		'name' => '北海道',
    		'name_en' => 'Hokkaido',
    	];
    	DB::table('category')->insert($param);

    	$param = [
            'parent' => '1',
    		'name' => '東北',
        'name_en' => 'Tohoku',
    	];
    	DB::table('category')->insert($param);

    	$param = [
            'parent' => '1',
    		'name' => '関東',
        'name_en' => 'Kanto',
    	];
    	DB::table('category')->insert($param);

    	$param = [
            'parent' => '1',
    		'name' => '中部',
        'name_en' => 'Chubu',
    	];
    	DB::table('category')->insert($param);

    	$param = [
            'parent' => '1',
    		'name' => '近畿',
        'name_en' => 'Kinki',
    	];
    	DB::table('category')->insert($param);

        $param = [
            'parent' => '1',
            'name' => '中国',
            'name_en' => 'Chugoku',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '1',
            'name' => '四国',
            'name_en' => 'Shikoku',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '1',
            'name' => '九州・沖縄',
            'name_en' => 'Kyushu-Okinawa',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '2',
            'name' => 'ヨーロッパ',
            'name_en' => 'Europe',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '2',
            'name' => '北アメリカ',
            'name_en' => 'North America',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '2',
            'name' => '中央アメリカ',
            'name_en' => 'Central America',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '2',
            'name' => '南アメリカ',
            'name_en' => 'South America',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '2',
            'name' => 'アジア',
            'name_en' => 'Asia',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '2',
            'name' => 'オセアニア',
            'name_en' => 'Oceania',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '2',
            'name' => 'アフリカ',
            'name_en' => 'Africa',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '2',
            'name' => '南極大陸',
            'name_en' => 'Antarctica',
        ];
        DB::table('category')->insert($param);

        $param = [
            'parent' => '2',
            'name' => 'その他',
            'name_en' => 'Others',
        ];
        DB::table('category')->insert($param);

    }
}
