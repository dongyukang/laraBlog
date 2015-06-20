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
            ['id' => '1', 'user_id' => '1', 'title' => 'A brief lorem ipsum', 'slug' => 'lorem-article', 'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ac pellentesque diam. Vestibulum pharetra lorem turpis, mattis vulputate justo porttitor egestas. Nullam convallis neque sed lectus ullamcorper interdum. In rhoncus neque sed enim ultrices, nec dignissim odio facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu condimentum diam, at rhoncus ante. Duis tincidunt commodo egestas. Phasellus tempus suscipit massa, id molestie nisi maximus at. Phasellus et lorem ac nisi viverra interdum et vel elit. Sed auctor ultrices turpis gravida lacinia. Fusce ex lorem, elementum ac ultrices nec, bibendum eget diam. Duis gravida varius turpis eu rutrum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc tincidunt mattis faucibus. Phasellus eu dictum velit. Suspendisse sodales nulla eu consequat rhoncus. Phasellus mollis dui malesuada magna vestibulum laoreet. Phasellus gravida sit amet leo non tristique. Vivamus viverra arcu ex, ut convallis nunc tempus eu. Nulla ante libero, volutpat eu tempor venenatis, gravida ut neque. Sed commodo mauris ac consectetur congue. Nam ex ante, lobortis vel posuere eu, pulvinar at risus. Duis massa turpis, blandit vitae dui ac, laoreet sollicitudin sapien. Nunc et ex quis massa dictum tempus. Nam vulputate facilisis augue, vel aliquam libero maximus in. Donec blandit urna vitae neque egestas consequat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras vel faucibus justo. Sed in placerat sapien. Cras interdum ornare commodo. Nunc ac mauris massa. Cras dapibus imperdiet quam et vulputate. Mauris vitae vehicula quam. Donec eu massa eu massa placerat vestibulum. Donec volutpat orci ex, eu tincidunt augue finibus semper. Nunc at justo suscipit dolor tempor ultrices ut a nisl. Vestibulum leo erat, ornare quis lectus at, consectetur tristique odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi non dapibus ante. Curabitur dignissim.', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => '2', 'user_id' => '1', 'title' => 'This is a reall nice blog', 'slug' => 'articleAslug', 'body' => 'I just wanted to take a moment and talk how great this blog is. It has many neat features, but in order to test them I need to create some fake articles. I am creating this article for exactly that reason. ', 'created_at' => new DateTime, 'updated_at' => new DateTime]

        );

        DB::table('articles')->insert($articles);
    }
}
