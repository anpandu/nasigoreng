<?php

use App\Models\ORM\Post;


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
		$obj = new Post;
		$obj->title = 'title';
		$obj->content = 'content';
		$obj->slug = 'slug';
		$obj->header_img = 'header_img';
		$saved = $obj->save();

		$this->assertTrue($saved);
		if ($saved) {
			$obj_2 = Post::find($obj->id);
			if ($obj_2 !== null) {
				$this->assertEquals($obj, $obj_2);
			}
		}
	}

	// /**
	//  * Tes menambahkan Post dan relasinya dengan User
	//  */
	// public function testUserRelation()
	// {
	// 	$users = [];

	// 	$obj = new User;
	// 	$obj->email = 'email';
	// 	$obj->username = 'username2';
	// 	$obj->password = 'password';
	// 	$obj->access_token = 'access_token';
	// 	$obj->refresh_token = 'refresh_token';
	// 	$obj->profile_picture = 'profile_picture';
	// 	$obj->full_name = 'full_name';
	// 	$obj->quote = 'quote';
	// 	$obj->location = 'location';
	// 	$obj->phone = 'phone';
	// 	$obj->education_id = '1';
		
	// 	$saved = $obj->save();

	// 	$users[] = $obj;

	// 	$obj = new Post;
	// 	$obj->title = 'title';
	// 	$saved = $obj->save();

	// 	$this->assertTrue($saved);
	// 	if ($saved) {
	// 		$ids = \Illuminate\Support\Collection::make($users)->map(function($user){ return $user->id;})->toArray();
	// 		$obj->users()->attach($ids);
	// 		$temp_users = $obj->users()->get();
	// 		$this->assertEquals(count($users), count($temp_users));
	// 		foreach ($temp_users as $key => $temp_user) {
	// 			$this->assertEquals($temp_user->attributesToArray(), $users[$key]->attributesToArray());
	// 		}
	// 	}
	// }

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
