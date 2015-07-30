<?php

use App\Models\ORM\Post;
use App\Models\ORM\Category;
use App\Models\ORM\Tag;
use App\Models\ORM\User;

use Illuminate\Support\Collection;

/**
 * Tes model Post
 */
class PostTest extends TestCase {

	/**
	 * Setup Environtment dan database.
	 */
	public function setUp()
	{
		parent::setUp();
	}

	/**
	 * Tes menambahkan Post
	 */
	public function testAdd()
	{
		$cat = Category::create(['title' => 'uncategorized']);
		$user = User::create(['name' => 'user', 'email' => 'user', 'password' => 'user', 'picture' => 'user']);

		$obj = new Post;
		$obj->title = 'Title Unimportant';
		$obj->content = 'content';
		$obj->description = 'description';
		$obj->header_image = 'header_image';
		$obj->category_id = $cat->id;
		$obj->user_id = $user->id;
		$saved = $obj->save();
		$this->assertTrue($saved);
		
		$obj_2 = Post::find($obj->id);
		if ($obj_2 !== null) {
			$this->assertEquals($obj, $obj_2);
		}
		
		$this->assertArrayHasKey('category', $obj_2->toArray());
		$this->assertArrayHasKey('tags', $obj_2->toArray());
		$this->assertEquals('title-unimportant', $obj_2->slug);

		$cat_2 = $obj_2->getCategory();
		$this->assertEquals($cat->id, $cat_2->id);
		$this->assertEquals(1, $cat_2->posts()->count());

		// testing slug already exist
		$obj_3 = new Post;
		$obj_3->title = 'Title Unimportant';
		$obj_3->category_id = $cat->id;
		$obj_3->user_id = $user->id;
		$saved = $obj_3->save();
		$this->assertTrue($saved);
		$this->assertEquals('title-unimportant-new', $obj_3->slug);

		// testing slug already exist #2
		$obj_3 = new Post;
		$obj_3->title = 'Title Unimportant';
		$obj_3->category_id = $cat->id;
		$obj_3->user_id = $user->id;
		$saved = $obj_3->save();
		$saved = $obj_3->save();
		$this->assertTrue($saved);
		$this->assertEquals('title-unimportant-new-new', $obj_3->slug);
	}

	/**
	 * Tes menambahkan Post dan relasinya dengan Tag
	 */
	public function testTagRelation()
	{
		$cat = Category::create(['title' => 'uncategorized']);
		$user = User::create(['name' => 'user', 'email' => 'user', 'password' => 'user', 'picture' => 'user']);

		$tags = [];
		$tags[] = Tag::create(['title' => 'title']);

		$obj = new Post;
		$obj->title = 'title';
		$obj->category_id = $cat->id;
		$obj->user_id = $user->id;
		$saved = $obj->save();

		$this->assertTrue($saved);
		if ($saved) {
			$ids = Collection::make($tags)->map(function($tag){ return $tag->id;})->toArray();
			$obj->tags()->attach($ids);
			$temp_tags = $obj->tags()->get();
			$this->assertEquals(count($tags), count($temp_tags));
			foreach ($temp_tags as $key => $temp_tag) {
				$this->assertEquals($temp_tag->id, $tags[$key]->id);
			}
		}
	}

}
