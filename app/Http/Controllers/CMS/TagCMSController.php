<?php namespace App\Http\Controllers\CMS;

use Config;
use Request;
use App\Http\Controllers\Controller;


class TagCMSController extends Controller {

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
		$this->put($url, $params);
		
		return redirect('cms/tag');
	}

	public function put($url, $fields)
	{
	    $tag_field_string = http_build_query($fields, '', '&');
	    $ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $tag_field_string);
		$response = curl_exec($ch);
		curl_close ($ch);
	    return $response;
	}

}
