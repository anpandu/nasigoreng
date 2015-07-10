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
		$obj->title = 'title';
		$obj->slug = 'slug';
		$saved = $obj->save();

		$this->assertTrue($saved);

		$obj_2 = Category::find($obj->id);
		if ($obj_2 !== null) {
			$this->assertEquals($obj, $obj_2);
		}
	}
}
