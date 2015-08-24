<?php

use Illuminate\Database\Seeder;
use App\Models\ORM\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->command->info(Post::all()->count());

        $p = Post::create(array(
            'title' => 'This is My First Post',
            'description' => 'This is my first post yo.',
            'category_id' => '2',
            'user_id' => '1',
            'content' => 'Hello, this is my first post. So long and good night.',
            'header_image' => 'blog/img/post-sample-image.jpg'
        ));
        $p->tags()->attach([1,2,3]);
    }
}
