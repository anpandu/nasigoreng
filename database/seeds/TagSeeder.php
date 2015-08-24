<?php

use Illuminate\Database\Seeder;
use App\Models\ORM\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(array(
            'title' => 'funny',
            'slug' => 'funny'
        ));
        Tag::create(array(
            'title' => 'sad',
            'slug' => 'sad'
        ));
        Tag::create(array(
            'title' => 'heartwarming',
            'slug' => 'heartwarming'
        ));
    }
}
