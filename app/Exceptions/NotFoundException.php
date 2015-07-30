<?php namespace App\Exceptions;

class NotFoundException extends BaseException {

	public static $base_message = 'Not Found! ';
	public static $base_code = '404';

}