<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = array(
            ['id' => '1', 'user_id' => '1', 'title' => 'Article A', 'slug' => 'articleAslug', 'body' => 'Article A Body', 'created_at' => new DateTime, 'updated_at' => new DateTime]
        );

        DB::table('articles')->insert($articles);
    }
}
