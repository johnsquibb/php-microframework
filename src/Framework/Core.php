<?php

declare(strict_types=1);

namespace PhpMicroframework\Framework;

use PhpMicroframework\Framework\Controller\NotFoundController;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;

/**
 * Class Core handles framework setup, execution, and teardown.
 * @package PhpMicroframework\Framework
 */
class Core
{
    /**
     * Initialize core.
     */
    public static function initialize(): void
    {
        set_error_handler(array(Problem::class, 'handler'));
        set_exception_handler(array(Problem::class, 'handler'));
        register_shutdown_function(array(static::class, 'shutdown'));

        Router::current();
    }

    /**
     * Run the framework.
     */
    public static function run(): void
    {
        static::initialize();

        if (class_exists(Router::$controller)) {
            $method = array(new Router::$controller(), Router::$method);
            if (is_callable($method)) {
                $response = call_user_func_array($method, Router::$arguments);
                static::render($response);
                return;
            }
        }

        static::error404();
    }

    /**
     * Show 404 Page Not Found error.
     */
    public static function error404(): void
    {
        $controller = new NotFoundController();
        static::render($controller->main());
    }

    /**
     * Shut the framework down, print outstanding buffers, handle any errors.
     */
    public static function shutdown(): void
    {
        $error = error_get_last();

        if (isset($error)) {
            Problem::handler(
                $error['type'],
                $error['message'],
                $error['file'],
                $error['line'],
                array('Core::shutdown()')
            );
        }

        print ob_get_clean();
    }

    /**
     * Render a response.
     * @param ResponseInterface $response
     */
    public static function render(ResponseInterface $response): void
    {
        $response->render();
    }
}
