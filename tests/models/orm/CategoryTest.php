<?php

use App\Models\ORM\Category;


/**
 * Tes model Category
 */
class CategoryTest extends TestCase {

	/**
	 * Setup Environtment dan database.
	 */
	public function setUp()
	{
		parent::setUp();
	}

	/**
	 * Tes menambahkan Category
	 */
	public function testAdd()
	{
		$obj = new Category;
		$obj->title = 'Title Unimportant';
		$saved = $obj->save();

		$this->assertTrue($saved);

		$obj_2 = Category::find($obj->id);
		if ($obj_2 !== null) {
			$this->assertEquals($obj, $obj_2);
		}

		// testing slug already exist
		$obj_3 = new Category;
		$obj_3->title = 'Title Unimportant';
		$saved = $obj_3->save();
		$this->assertTrue($saved);
		$this->assertEquals('title-unimportant-new', $obj_3->slug);

		// testing slug already exist #2
		$obj_3 = new Category;
		$obj_3->title = 'Title Unimportant';
		$saved = $obj_3->save();
		$this->assertTrue($saved);
		$this->assertEquals('title-unimportant-new-new', $obj_3->slug);
	}
}
