<?php namespace App\Http\Controllers\CMS;

use Config;
use Request;
use App\Http\Controllers\Controller;
use Auth;


class PostCMSController extends Controller {

	/**
	 * Halaman CMS Post
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'endpoint' => 'post'
		];
		return view('cms.post.post')->with($data);
	}

	/**
	 * Halaman CMS Post by Category
	 * @return Response
	 */
	public function category($slug)
	{
		$data = [
			'endpoint' => 'post/category/' . $slug
		];
		return view('cms.post.post')->with($data);
	}

	/**
	 * Halaman CMS Post by Tag
	 * @return Response
	 */
	public function tag($slug)
	{
		$data = [
			'endpoint' => 'post/tag/' . $slug
		];
		return view('cms.post.post')->with($data);
	}

	/**
	 * Halaman CMS Post Add
	 * @return Response
	 */
	public function add()
	{
		$tags = json_decode(@file_get_contents(url('/tag')));
		$categories = json_decode(@file_get_contents(url('/category')));

		$data = [
			'user_id' => Auth::user()->id, 
			'categories' => $categories, 
			'tags' => $tags
		];
		return view('cms.post.post_add')->with($data);
	}

	/**
	 * Halaman CMS Post Edit
	 * @return Response
	 */
	public function edit($id)
	{
		$url = url('/post/'.$id);
		$post = json_decode(@file_get_contents($url));
		$available_tag_ids = array_map(function($x){return $x->id;}, $post->tags);

		$tags = json_decode(@file_get_contents(url('/tag')));
		$tags = array_map(function ($x) use ($available_tag_ids) {
			$x->available = in_array($x->id, $available_tag_ids);
			return $x;
		}, $tags);

		$categories = json_decode(@file_get_contents(url('/category')));
		$categories = array_map(function ($x) use ($post) {
			$x->available = $x->id == $post->category_id;
			return $x;
		}, $categories);

		$data = [
			'post' => $post, 
			'categories' => $categories, 
			'tags' => $tags
		];
		return view('cms.post.post_edit')->with($data);
	}

	/**
	 * Post Update
	 * @return Response
	 */
	public function store()
	{
		$params = Request::all();
		$url = url('/post/');
		$this->pos($url, $params);
		
		return redirect('cms/post');
	}

	/**
	 * Post Update
	 * @return Response
	 */
	public function update($id)
	{
		$params = Request::all();
		$url = url('/post/'.$params['id']);
		$this->put($url, $params);
		
		return redirect('cms/post');
	}

	public function pos($url, $fields)
	{
	    $post_field_string = http_build_query($fields, '', '&');
	    $ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
		$response = curl_exec($ch);
		curl_close ($ch);
	    return $response;
	}

	public function put($url, $fields)
	{
	    $post_field_string = http_build_query($fields, '', '&');
	    $ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
		$response = curl_exec($ch);
		curl_close ($ch);
	    return $response;
	}

}
