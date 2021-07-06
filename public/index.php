<?php declare(strict_types=1);


use PhpMicroframework\Framework\Core;
use PhpMicroframework\Framework\Router;

error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('UTC');

require dirname(__DIR__) . '/vendor/autoload.php';

// Set to true to view error messages.
// This should only be set in non-production environments.
const DEBUG = true;

Router::$namespaces[] = 'PhpMicroframework\\Controller';
Core::run();