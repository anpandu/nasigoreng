<?php namespace App\Exceptions;

class CrudException extends BaseException {

	public static $base_message = 'failed at ';
	public static $base_code = '500';

}