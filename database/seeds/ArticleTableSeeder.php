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
            ['id' => '1', 'user_id' => '1', 'title' => 'Welcome to larablog', 'slug' => 'lorem-article', 'body' => 'Welcome to laraBlog! This is a simple blog written in laravel. If you are reading this, it means laraBlog is up and running! A few quick notes to get started:

* You should log in to the account master@gmail.com using the password password. Once you do that, you should delete this article using the button under the title. You wont see it if you arent logged in!
* All blog posts are written in markdown syntax. This makes it easy to make your posts look nice without needing to write any html.
* Users can post comments on the article below
* You can view any deleted articles or banned users in the admin control panel, located at the top of the screen.
* Enjoy!', 'created_at' => new DateTime, 'updated_at' => new DateTime],

        );

        DB::table('articles')->insert($articles);
    }
}
