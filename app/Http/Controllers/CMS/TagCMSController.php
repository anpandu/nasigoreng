<?php namespace App\Http\Controllers\CMS;

use Config;
use Request;
use App\Http\Controllers\Controller;


class TagCMSController extends BaseCMSController {

	public static $endpoint = 'api/tag';

	/**
	 * Halaman CMS Tag
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'endpoint' => self::$endpoint
		];
		return view('cms.tag.tag')->with($data);
	}

	/**
	 * Halaman CMS Tag Edit
	 * @return Response
	 */
	public function edit($id)
	{
		$url = url(self::$endpoint.'/'.$id);
		$tag = json_decode(@file_get_contents($url));

		$data = [
			'tag' => $tag
		];
		return view('cms.tag.tag_edit')->with($data);
	}

	/**
	 * Tag Update
	 * @return Response
	 */
	public function update($id)
	{
		$params = Request::all();
		$url = url(self::$endpoint.'/'.$params['id']);
		$this->_put($url, $params);
		
		return redirect('cms/tag');
	}

}
