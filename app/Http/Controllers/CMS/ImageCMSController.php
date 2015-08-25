<?php namespace App\Http\Controllers\CMS;

use Config;
use Request;
use App\Http\Controllers\Controller;


class ImageCMSController extends BaseCMSController {

	public static $endpoint = 'api/image';

	/**
	 * Halaman CMS Image
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'endpoint' => self::$endpoint
		];
		return view('cms.image.image')->with($data);
	}

	/**
	 * Halaman CMS Image Edit
	 * @return Response
	 */
	public function edit($id)
	{
		$url = url(self::$endpoint.'/'.$id);
		$image = json_decode(@file_get_contents($url));

		$data = [
			'image' => $image
		];
		return view('cms.image.image_edit')->with($data);
	}

	/**
	 * Image Update
	 * @return Response
	 */
	public function update($id)
	{
		$params = Request::all();
		$url = url(self::$endpoint.'/'.$params['id']);
		$this->_put($url, $params);
		
		return redirect('cms/image');
	}

}
