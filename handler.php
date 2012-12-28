<?php

define('IN_WGSL', true);
define('DS', DIRECTORY_SEPARATOR);
define('WEB_ROOT', dirname(__FILE__) . DS);


require_once(WEB_ROOT . 'init.php');

Main::run($request);