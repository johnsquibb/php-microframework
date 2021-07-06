<?php declare(strict_types=1);

namespace PhpMicroframework\Framework;

use PhpMicroframework\Controller\NotFoundController;
use PhpMicroframework\Controller\Response\ResponseInterface;

/**
 * Class Core handles framework setup, execution, and teardown.
 *
 * @package PhpMicroframework\Framework
 */
final class Core
{
    /**
     * Initialize core.
     */
    public static function initialize()
    {
        set_error_handler(array(Problem::class, 'handler'));
        set_exception_handler(array(Problem::class, 'handler'));
        register_shutdown_function(array(self::class, 'shutdown'));

        Router::current();
    }

    /**
     * Run the framework.
     */
    public static function run(): void
    {
        self::initialize();

        if (class_exists(Router::$controller)) {
            $method = array(new Router::$controller, Router::$method);
            if (is_callable($method)) {
                $response = call_user_func_array($method, Router::$arguments);
                self::render($response);
                return;
            }
        }

        self::error404();
    }

    /**
     * Show 404 Page Not Found error.
     */
    public static function error404(): void
    {
        $controller = new NotFoundController();
        self::render($controller->main());
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