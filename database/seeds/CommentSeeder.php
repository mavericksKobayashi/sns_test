<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
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
    		'user_id' => '1',
    		'comment' => '私はPVにいるたびにAcquaint Spaに戻ります。私は決して失望しません。清潔で広々とした素敵なマッサージルームとシャワー付きのロッカールームがあります。私は常に優れたプロのマッサージを受けています。PVには多くのいわゆるマッサージ師がいます。Acquaには、最高の訓練を受けた最もプロフェッショナルな人材がいます。',
        'created_at' => '1572508694',
    		'updated_at' => '1572508694',
    	];
    	DB::table('comment')->insert($param);

    	$param = [
    		'post_id' => '2',
    		'user_id' => '2',
    		'comment' => '&gt;らっこさん
Acquaには、最高の訓練を受けた最もプロフェッショナルな人材がいます。',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
    	];
    	DB::table('comment')->insert($param);


    }
}
