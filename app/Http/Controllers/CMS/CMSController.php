<?php namespace App\Http\Controllers\CMS;

use Request;
use App\Http\Controllers\Controller;


class CMSController extends Controller {

	/**
	 * Halaman CMS Dashboard
	 * @return Response
	 */
	public function dashboard()
	{
		return view('cms.dashboard');
	}

}
