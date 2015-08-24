<?php namespace App\Http\Controllers;

use App\Models\ORM\Post;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the main page.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::all()->sortByDesc('created_at')->toArray();
		$data = [
			'posts' => $posts
		];
		return view('blog.index')->with($data);
	}

	/**
	 * Show the about page.
	 *
	 * @return Response
	 */
	public function about()
	{
		return view('blog.about');
	}

	/**
	 * Show the contact page.
	 *
	 * @return Response
	 */
	public function contact()
	{
		return view('blog.contact');
	}

}
