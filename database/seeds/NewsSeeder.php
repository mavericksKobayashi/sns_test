<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $param = [
        'writer' => '運営者',
        'title' => '機能追加のお知らせ',
        'contents' => 'お知らせ',
        'publish' => '1',
        'release_date' => '20191101',
        'created_at' => '1572508694',
        'updated_at' => '1572508694',
      ];
      DB::table('news')->insert($param);

      $param = [
        'writer' => '運営者',
        'title' => '機能追加のお知らせ非公開',
        'contents' => 'お知らせ',
        'publish' => '0',
        'release_date' => '20191110',
        'created_at' => '1572808694',
        'updated_at' => '1572808694',
      ];
      DB::table('news')->insert($param);

    }
}
