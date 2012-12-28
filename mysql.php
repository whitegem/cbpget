<?php

if(! defined('IN_WGSL')) {
	header('HTTP/1.1 404 Not Found');
	die();
}

class MySQL {

	private static $instance = NULL;
	private $sql = NULL;

	public static function getInstance() {
		if(self::$instance === NULL) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$conf = Config::getInstance();
		$this -> sql = @new mysqli($conf('MySQL.Host'), $conf('MySQL.User'), $conf('MySQL.Pass'), $conf('MySQL.Database'));
		if($this -> sql -> connect_errno) {
			throw new MySQLException('Connect Failed with message: ' . $this -> sql -> connect_error);
		}
		if(! $this -> sql -> set_charset($conf('MySQL.Charset'))) {
			throw new MySQLException('Unable to set charset to ' . $conf('MySQL.Charset'));
		}
	}

	public function escape($str) {
		return $this -> sql -> real_escape_string($str);
	}

	public function query($query) {
		// WARNING: No more security escape to query!
		$result = @$this -> sql -> query($query);
		if($result === false) {
			throw new MySQLException('Query Error with message: ' . $this -> sql -> error);
		}
	}
}

class MySQLException extends Exception{
}