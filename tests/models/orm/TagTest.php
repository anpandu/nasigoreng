<?php

use App\Models\ORM\Tag;
use App\Models\ORM\Post;
use App\Models\ORM\Category;
use App\Models\ORM\User;

use Illuminate\Support\Collection;

/**
 * Tes model Tag
 */
class TagTest extends TestCase {

	/**
	 * Setup Environtment dan database.
	 */
	public function setUp()
	{
		parent::setUp();
	}

	/**
	 * Tes menambahkan Tag
	 */
	public function testAdd()
	{
		$obj = new Tag;
		$obj->title = 'title';
		$obj->slug = 'slug';
		$saved = $obj->save();

		$this->assertTrue($saved);
		
		$obj_2 = Tag::find($obj->id);
		if ($obj_2 !== null) {
			$this->assertEquals($obj, $obj_2);
		}
	}

	/**
	 * Tes menambahkan Tag dan relasinya dengan Post
	 */
	public function testPostRelation()
	{
		$cat = Category::create(['title' => 'uncategorized']);
		$user = User::create(['name' => 'user', 'email' => 'user', 'password' => 'user', 'picture' => 'user']);

		$posts = [];
		$posts[] = Post::create(['title' => 'title', 'category_id' => $cat->id, 'user_id' => $user->id]);

		$obj = new Tag;
		$obj->title = 'title';
		$saved = $obj->save();

		$this->assertTrue($saved);
		if ($saved) {
			$ids = Collection::make($posts)->map(function($post){ return $post->id;})->toArray();
			$obj->posts()->attach($ids);
			$temp_posts = $obj->posts()->get();
			$this->assertEquals(count($posts), count($temp_posts));
			foreach ($temp_posts as $key => $temp_post) {
				$this->assertEquals($temp_post->id, $posts[$key]->id);
			}
		}
	}

}
