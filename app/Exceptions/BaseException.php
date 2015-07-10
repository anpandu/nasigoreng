<?php namespace App\Exceptions;

use Exception;

class BaseException extends Exception {

	public static $base_message = 'Failed, because ';
	public static $base_code = '500';

	public function errorMessage() {
		$err = [
			'message' => static::$base_message . $this->getMessage(),
			'code' => static::$base_code,
			'exception' => get_class($this),
		];
		return $err;
	}

}