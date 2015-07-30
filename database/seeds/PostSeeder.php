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
            'title' => 'Postingan #0',
            'description' => '-',
            'category_id' => '1',
            'user_id' => '1'
        ));
        $p->tags()->attach([1,2,3]);

        $p = Post::create(array(
            'title' => 'Postingan #1',
            'description' => '-',
            'category_id' => '1',
            'user_id' => '1'
        ));
        $p->tags()->attach([1]);

        $p = Post::create(array(
            'title' => 'Postingan #2',
            'description' => '-',
            'category_id' => '2',
            'user_id' => '1'
        ));
        $p->tags()->attach([2]);

        $p = Post::create(array(
            'title' => 'Postingan #3',
            'description' => '-',
            'category_id' => '3',
            'user_id' => '1'
        ));
        $p->tags()->attach([3]);
    }
}
