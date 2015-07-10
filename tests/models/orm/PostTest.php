<?php

use App\Models\ORM\Post;
use App\Models\ORM\Category;


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

		$obj = new Post;
		$obj->title = 'title';
		$obj->content = 'content';
		$obj->slug = 'slug';
		$obj->header_img = 'header_img';
		$obj->category_id = $cat->id;
		$saved = $obj->save();

		$this->assertTrue($saved);
		
		$obj_2 = Post::find($obj->id);
		if ($obj_2 !== null) {
			$this->assertEquals($obj, $obj_2);
		}

		$cat_2 = $obj_2->getCategory();
		$this->assertEquals($cat->id, $cat_2->id);
		$this->assertEquals(1, $cat_2->posts()->count());
	}

	// /**
	//  * Tes menambahkan Post dan relasinya dengan Permission
	//  */
	// public function testPermissionRelation()
	// {
	// 	$permissions = [];
	// 	$permissions[] = Permission::create(['name' => 'name']);

	// 	$obj = new Post;
	// 	$obj->title = 'title';
	// 	$saved = $obj->save();

	// 	$this->assertTrue($saved);
	// 	if ($saved) {
	// 		$ids = \Illuminate\Support\Collection::make($permissions)->map(function($permission){ return $permission->id;})->toArray();
	// 		$obj->permissions()->attach($ids);
	// 		$temp_permissions = $obj->permissions()->get();
	// 		$this->assertEquals(count($permissions), count($temp_permissions));
	// 		foreach ($temp_permissions as $key => $temp_permission) {
	// 			$this->assertEquals($temp_permission->attributesToArray(), $permissions[$key]->attributesToArray());
	// 		}
	// 	}
	// }

}
