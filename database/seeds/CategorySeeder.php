<?php

use Illuminate\Database\Seeder;
use App\Models\ORM\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(array(
            'title' => 'uncategorized',
            'slug' => 'uncategorized'
        ));
        Category::create(array(
            'title' => 'story',
            'slug' => 'story'
        ));
        Category::create(array(
            'title' => 'geeks',
            'slug' => 'geeks'
        ));
    }
}
