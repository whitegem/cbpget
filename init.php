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
	'get'       => $_GET,
	'post'      => $_POST,
);

require_once(WEB_ROOT . 'template.php');
require_once(WEB_ROOT . 'error.php');
require_once(WEB_ROOT . 'config.php');
require_once(WEB_ROOT . 'mysql.php');
require_once(WEB_ROOT . 'session.php');
require_once(WEB_ROOT . 'main.php');
require_once(WEB_ROOT . 'cookie.php');

$conf = Config::getInstance();
var_dump($conf(''));