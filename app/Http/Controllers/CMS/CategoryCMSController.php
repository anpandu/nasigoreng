<?php namespace App\Http\Controllers\CMS;

use Config;
use Request;
use App\Http\Controllers\Controller;


class CategoryCMSController extends Controller {

	/**
	 * Halaman CMS Category
	 * @return Response
	 */
	public function index()
	{
		return view('cms.category.category');
	}

	/**
	 * Halaman CMS Category Edit
	 * @return Response
	 */
	public function edit($id)
	{
		$url = url('/category/'.$id);
		$category = json_decode(@file_get_contents($url));

		$data = [
			'category' => $category
		];
		return view('cms.category.category_edit')->with($data);
	}

	/**
	 * Category Update
	 * @return Response
	 */
	public function update($id)
	{
		$params = Request::all();
		$url = url('/category/'.$params['id']);
		$this->put($url, $params);
		
		return redirect('cms/category');
	}

	public function put($url, $fields)
	{
	    $category_field_string = http_build_query($fields, '', '&');
	    $ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $category_field_string);
		$response = curl_exec($ch);
		curl_close ($ch);
	    return $response;
	}

}
