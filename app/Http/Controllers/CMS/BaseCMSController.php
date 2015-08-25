<?php namespace App\Http\Controllers\CMS;

use Request;
use App\Http\Controllers\Controller;


class BaseCMSController extends Controller {

	public function _post($url, $fields)
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

	public function _put($url, $fields)
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
