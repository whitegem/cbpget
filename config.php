<?php

if (! defined('IN_WGSL')) {
	header('HTTP/1.1 404 Not Found');
	die();
}

class Config {

	private static $instance = NULL;

	private $tree = array();

	private function __construct() {
		$this -> tree = yaml_parse_file(WEB_ROOT . 'config.yml');
	}

	public static function getInstance() {
		if(self::$instance === NULL) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function get($node) {
		if ($node == '') return $this -> tree; /* return $this -> asArray() */
		$path = explode('.', $node);
		$done = array('Root');
		$cur = $this -> tree;
		foreach($path as $nodeName) {
			if(! array_key_exists($nodeName, $cur)) {
				throw new ConfigException('No node named ' . $nodeName . ' in path ' . implode('.', $done));
			}
			$done[] = $nodeName;
			$cur = $cur[$nodeName];
		}
		return $cur;
	}

	public function asArray() {
		return $this -> tree;
	}

	public function __get($node) {
		return $this -> get($node);
	}

	public function __invoke($node) {
		return $this -> get($node);
	}
}

class ConfigException extends Exception{
}