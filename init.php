<?php

if(! defined('IN_WGSL')) {
	header('HTTP/1.1 404 Not Found');
	die();
}

error_reporting(0);

$request = array(
	'uri'       => $_SERVER['REQUEST_URI'],
	'referer'   => $_SERVER['HTTP_REFERER'],
	'time'      => microtime(true),
);

require_once(WEB_ROOT . 'template.php');
require_once(WEB_ROOT . 'error.php');
require_once(WEB_ROOT . 'config.php');