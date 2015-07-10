<?php namespace App\Exceptions;

class CrudException extends BaseException {

	public static $base_message = 'CRUD gagal coy, controllernya ';
	public static $base_code = '500';

}