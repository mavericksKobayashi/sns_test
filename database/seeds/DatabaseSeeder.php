<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(FollowTableSeeder::class);
        $this->call(Image_profTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(BookmarkSeeder::class);
        $this->call(Image_PostSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(RankingSeeder::class);
        $this->call(Ranking_mSeeder::class);
        $this->call(Ranking_ySeeder::class);
        $this->call(LikeSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(Message_blockSeeder::class);
        $this->call(NewsSeeder::class);

    }
}
