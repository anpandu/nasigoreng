<?php namespace App\Http\Controllers\CMS;

use Config;
use Request;
use App\Http\Controllers\Controller;


class ImageCMSController extends Controller {

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
		$this->put($url, $params);
		
		return redirect('cms/image');
	}

	public function put($url, $fields)
	{
	    $image_field_string = http_build_query($fields, '', '&');
	    $ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $image_field_string);
		$response = curl_exec($ch);
		curl_close ($ch);
	    return $response;
	}

}
