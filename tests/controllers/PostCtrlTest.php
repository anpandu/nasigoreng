<?php

use App\Models\ORM\Post;
use App\Models\ORM\Category;
use App\Models\ORM\Tag;
use App\Models\ORM\User;

class PostCtrlTest extends TestCase {

	private $obj;
	private static $endpoint = 'post';

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
		$slug = 'slug_' . rand(0,10000);
		$cat = Category::create(['title' => $slug, 'slug' => $slug]);
		$tag = Tag::create(['title' => $slug, 'slug' => $slug]);
		$user = User::create(['name' => 'user', 'email' => rand(0,10000), 'password' => 'user', 'picture' => 'user']);
		$obj = new Post;
		$obj->title = 'title';
		$obj->slug = 'slug';
		$obj->content = 'content';
		$obj->header_image = 'header_image';
		$obj->category_id = $cat->id;
		$obj->user_id = $user->id;
		$obj->save();
		$obj->tags()->attach($tag->id);
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
		// tes pemanggilan store sukses
		$params = $this->setUpParams();
		$response = $this->call('POST', '/'.self::$endpoint, $params);
		$this->assertEquals(200, $response->getStatusCode());
		$result = $response->getOriginalContent()->toArray();

		foreach ($params as $key => $val) {
			$this->assertArrayHasKey($key, $result);
			if (isset($result[$key])&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $result[$key]);
		}
	}

	public function testUpdate()
	{
		$tags[] = Tag::create(['title' => 'tagx']);
		$tags[] = Tag::create(['title' => 'tagy']);
		$tags[] = Tag::create(['title' => 'tagz']);

		// tes pemanggilan update sukses
		$params = $this->setUpParams();
		$params['id'] = $this->obj->id.'000';
		$params['tags'] = array_map(function($x){return $x->id;}, $tags);
		$response = $this->call('PUT', '/'.self::$endpoint.'/'.$this->obj->id, $params);
		$this->assertEquals(200, $response->getStatusCode());
		$result = $response->getOriginalContent()->toArray();

		// tes apakah hasil return adalah yang sesuai
		unset($params['tags']);
		foreach ($params as $key => $val) {
			$this->assertArrayHasKey($key, $result);
			if (isset($result[$key])&&($key!='created_at')&&($key!='updated_at'))
				$this->assertEquals($val, $result[$key]);
		}		
		$this->assertEquals(3, count($result['tags']));

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

	public function testCategory()
	{
		// tes pemanggilan category sukses
		$obj2 = $this->setUpObj();
		$slug = $this->obj->category()->first()->slug;
		$response = $this->call('GET', '/'.self::$endpoint.'/category/'.$slug);
		$this->assertEquals(200, $response->getStatusCode());
		$result = $response->getOriginalContent()->toArray();
		$this->assertTrue(is_array($result));
		$this->assertTrue(count($result)>0);

		// tes apakah hasil return adalah yang sesuai
		foreach ($this->obj->attributesToArray() as $attr => $attr_val)
			$this->assertArrayHasKey($attr, $result[0]);
		foreach ($result as $r)
			$this->assertEquals($slug, $r['category']['slug']);
	}

	public function testTag()
	{
		// tes pemanggilan category sukses
		$obj2 = $this->setUpObj();
		$slug = $this->obj->tags()->first()->slug;
		$response = $this->call('GET', '/'.self::$endpoint.'/tag/'.$slug);
		$this->assertEquals(200, $response->getStatusCode());
		$result = $response->getOriginalContent()->toArray();
		$this->assertTrue(is_array($result));
		$this->assertTrue(count($result)>0);

		// tes apakah hasil return adalah yang sesuai
		foreach ($this->obj->attributesToArray() as $attr => $attr_val)
			$this->assertArrayHasKey($attr, $result[0]);
		foreach ($result as $r) {
			$slugs = array_map(function($x) {return $x['slug'];}, $r['tags']);
			$this->assertTrue(in_array($slug, $slugs));
		}
	}

}
