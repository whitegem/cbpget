<?php

if (! defined('IN_WGSL')) {
	header('HTTP/1.1 404 Not Found');
	die();
}

class Config {

	private static $instance = NULL;

	private $tree = array();

	private function __construct() {

	}

	public static function getInstance() {
		if(self::$instance === NULL) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function get($node) {
		$path = explode('.', $node);
		$cur = $this -> tree;
		foreach($path as $nodeName) {
			if(! array_key_exists($nodeName, $cur)) {

			}
		}
	}

	public function asArray() {
		return $this -> tree;
	}

	public function __get($node) {
		return $this -> get($node);
	}
}