<?php

if(! defined('IN_WGSL')) {
	header('HTTP/1.1 404 Not Found');
	die();
}

class Main {
	public static function run($request) {
		$conf = Config::getInstance();
		$rules = $conf('URI.Rules');
		$prefix = $conf('URI.Prefix');
		if($prefix != ''){
			$length = strlen($prefix);
			if(substr($request['uri'], 0, $length) == $prefix) {
				$request['uri'] = substr($request['uri'], $length);
			}
		}
		foreach($rules as $rule) {
			$uri = str_replace('/', '\\/', $rule['Pattern']);
			if(preg_match('/^' . $uri . '$/', $request['uri'])) {
				$callable = explode('.', $rule['Backend']);
				if(is_callable($callable)) {
					call_user_func_array($callable, array());
					die();
				} else {
					throw new CoreException($rule['Backend'] . ' is not callable!');
				}
			}
		}
		$default = explode('.', $conf('URI.Default'));
		if(is_callable($default)) {
			call_user_func_array($default, array());
		} else {
			throw new CoreException('Default Method ' . $conf('URI.Default') . 'doesn\'t exist!');
		}
	}

	public static function NotMatched() {
		header('HTTP/1.1 404 Not Found');
		echo
<<<HTML
<!DOCTYPE HTML>
<html>
<head>
<title>404 Not Found</title>
</head>
<body>
<h1>404 Not Found</h1>
<p>Request URI {$_SERVER['REQUEST_URI']} can't be found on this server.</p>
</body>
</html>

HTML;

	}
}

class CoreException extends Exception{
}