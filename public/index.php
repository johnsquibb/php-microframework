<?php declare(strict_types=1);

use PhpMicroframework\Application\Controller\DemoController;
use PhpMicroframework\Framework\Core;
use PhpMicroframework\Framework\Router;

require dirname(__DIR__) . '/vendor/autoload.php';

// Set errors for development.
error_reporting(E_ALL | E_STRICT);

// This can be set in php.ini and removed here.
date_default_timezone_set('UTC');

// Set to true to view error messages.
// This should only be set in non-production environments.
const DEBUG = true;

// Register all PSR-4 namespaces where the framework should search for controllers.
Router::$namespaces = [
    'PhpMicroframework\\Application\\Controller',
    'PhpMicroframework\\Framework\\Controller',
];

// Override the default controller to use demo::hello().
Router::$defaultController = DemoController::class;
Router::$defaultMethod = 'hello';

// Run the framework.
Core::run();