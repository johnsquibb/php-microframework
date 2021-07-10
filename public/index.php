<?php

declare(strict_types=1);

use PhpMicroframework\Application\Controller\DemoController;
use PhpMicroframework\Framework\Core;
use PhpMicroframework\Framework\Problem;
use PhpMicroframework\Framework\Router;

require dirname(__DIR__) . '/vendor/autoload.php';

// Set error reporting level for development.
error_reporting(E_ALL | E_STRICT);

// This can be set in php.ini and removed here.
date_default_timezone_set('UTC');

// Enable error messages on 500 pages.
Problem::setDisplayErrorsEnabled(true);

// Register all PSR-4 namespaces where the framework should search for controllers.
// The framework will search in array order until the first controller match is found.
Router::$namespaces = [
    'PhpMicroframework\\Application\\Controller',
];

// Set the demo controller and method as home page.
Router::$defaultController = DemoController::class;
Router::$defaultMethod = 'hello';

// Run the framework.
Core::run();
