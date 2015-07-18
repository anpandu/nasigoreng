<?php

use App\Models\ORM\Image;

use Illuminate\Support\Collection;

/**
 * Tes model Image
 */
class ImageTest extends TestCase {

	/**
	 * Setup Environtment dan database.
	 */
	public function setUp()
	{
		parent::setUp();
	}

	/**
	 * Tes menambahkan Image
	 */
	public function testAdd()
	{
		$obj = new Image;
		$obj->title = 'title';
		$obj->slug = 'slug';
		$obj->filename = 'filename';
		$obj->description = 'description';
		$saved = $obj->save();

		$this->assertTrue($saved);
		
		$obj_2 = Image::find($obj->id);
		if ($obj_2 !== null) {
			$this->assertEquals($obj, $obj_2);
		}
	}
}
