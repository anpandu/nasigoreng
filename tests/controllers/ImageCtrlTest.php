<?php

use App\Models\ORM\Image;

class ImageCtrlTest extends TestCase {

	private $obj;
	private static $endpoint = 'api/image';

	public function setUp() 
	{
		parent::setUp();
		$this->obj = $this->setUpObj();
	}

	public function tearDown() 
	{
		$this->obj->delete();
		parent::tearDown();
	}

	private function setUpObj() 
	{
		$obj = new Image;
		$obj->title = 'title';
		$obj->slug = 'slug';
		$obj->filename = 'filename';
		$obj->description = 'description';
		$obj->save();
		return $obj;
	}

	private function setUpParams() 
	{
		$params = [];
		foreach ($this->obj->attributesToArray() as $attr => $attr_val)
			if ($attr!='id')
				$params[$attr] = $attr_val;
		return $params;
	}

	public function testIndex()
	{
		// tes pemanggilan index sukses
		$response = $this->call('GET', '/'.self::$endpoint);
		$this->assertEquals(200, $response->getStatusCode());
		$result = $response->getOriginalContent()->toArray();
		$this->assertTrue(is_array($result));
		$this->assertTrue(count($result)>0);

		// tes apakah hasil return adalah yang sesuai
		foreach ($this->obj->attributesToArray() as $attr => $attr_val)
			$this->assertArrayHasKey($attr, $result[0]);
	}

	public function testShow()
	{
		// tes pemanggilan show sukses
		$response = $this->call('GET', '/'.self::$endpoint.'/'.$this->obj->id);
		$this->assertEquals(200, $response->getStatusCode());
		$result = $response->getOriginalContent()->toArray();

		// tes apakah hasil return adalah yang sesuai
		foreach ($this->obj->attributesToArray() as $attr => $attr_val)
			$this->assertArrayHasKey($attr, $result);

		// tes tak ada yang dicari
		$response = $this->call('GET', '/'.self::$endpoint.'/696969');
		$this->assertEquals(500, $response->getStatusCode());
	}

	public function testStore()
	{
		// // tes pemanggilan store sukses
		// $params = $this->setUpParams();
		// $uploadedFile1 = Mockery::mock(
	 //        '\Symfony\Component\HttpFoundation\File\UploadedFile',
	 //        [
	 //            'getClientOriginalName'      => 'image-1.jpg',
	 //            'getClientOriginalExtension' => 'jpg',
	 //        ]
	 //    );
		// $response = $this->call('POST', '/'.self::$endpoint, $params, [], ['image' => $uploadedFile1]);
		// dd($response);
		// $this->assertEquals(200, $response->getStatusCode());
		// $result = $response->getOriginalContent()->toArray();

		// foreach ($params as $key => $val) {
		// 	$this->assertArrayHasKey($key, $result);
		// 	if (isset($result[$key])&&($key!='created_at')&&($key!='updated_at'))
		// 		$this->assertEquals($val, $result[$key]);
		// }
	}

	public function testUpdate()
	{
		// tes pemanggilan update sukses
		$params = $this->setUpParams();
		$params['id'] = $this->obj->id.'000';
		$response = $this->call('PUT', '/'.self::$endpoint.'/'.$this->obj->id, $params);
		$this->assertEquals(200, $response->getStatusCode());
		$result = $response->getOriginalContent()->toArray();

		// tes apakah hasil return adalah yang sesuai
		foreach ($params as $key => $val) {
			$this->assertArrayHasKey($key, $result);
			if (isset($result[$key])&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $result[$key]);
		}

		// tes tak ada yang dicari
		$response = $this->call('GET', '/'.self::$endpoint.'/696969', $params);
		$this->assertEquals(500, $response->getStatusCode());
	}

	public function testDelete()
	{
		// tes pemanggilan delete sukses
		$obj2 = $this->setUpObj();
		$response = $this->call('DELETE', '/'.self::$endpoint.'/'.$obj2->id);
		$this->assertEquals(200, $response->getStatusCode());
		$result = $response->getOriginalContent()->toArray();

		// tes apakah sudah terdelete
		$response = $this->call('GET', '/'.self::$endpoint.'/'.$obj2->id);
		$this->assertEquals(500, $response->getStatusCode());

		// tes apakah hasil return adalah yang sesuai
		foreach ($obj2->attributesToArray() as $key => $val) {
			$this->assertArrayHasKey($key, $result);
			if (isset($result[$key])&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $result[$key]);
		}
	}

}
