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
        $p = Post::create(array(
            'title' => 'Postingan',
            'slug' => 'Postingan',
            'category_id' => '1'
        ));
        
        $p->tags()->attach([1,2,3]);
    }
}
