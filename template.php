<?php

if(! defined('IN_WGSL')) {
	header('HTTP/1.1 404 Not Found');
	die();
}

require_once(WEB_ROOT . 'Smarty' . DS . 'Smarty.class.php');

class Template {
	private static $instance = NULL;

	private function __construct() {
	}

	public static function getInstance() {
		if(self::$instance === NULL) {
			self::$instance = new Smarty();
			self::$instance -> left_delimiter = '{{';
			self::$instance -> right_delimiter = '}}';
			self::$instance -> debugging = false;
			self::$instance -> setCompileDir(WEB_ROOT . 'tmp' . DS . 'compiled');
			self::$instance -> setCacheDir(WEB_ROOT . 'tmp' . DS . 'cached');
			Smarty::muteExpectedErrors();
		}
		return self::$instance;
	}
}