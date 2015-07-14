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
            'title' => 'aneh',
            'slug' => 'aneh'
        ));
        Tag::create(array(
            'title' => 'biasa',
            'slug' => 'biasa'
        ));
        Tag::create(array(
            'title' => 'nevermind',
            'slug' => 'nevermind'
        ));
    }
}
