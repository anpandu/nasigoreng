<?php namespace App\Http\Controllers\CMS;

use Config;
use Request;
use App\Http\Controllers\Controller;


class CategoryCMSController extends BaseCMSController {

	public static $endpoint = 'api/category';

	/**
	 * Halaman CMS Category
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'endpoint' => self::$endpoint
		];
		return view('cms.category.category')->with($data);
	}

	/**
	 * Halaman CMS Category Edit
	 * @return Response
	 */
	public function edit($id)
	{
		$url = url(self::$endpoint.'/'.$id);
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
		$url = url(self::$endpoint.'/'.$params['id']);
		$this->_put($url, $params);
		
		return redirect('cms/category');
	}

}
