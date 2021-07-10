<?php

namespace PhpMicroframework\Framework;

/**
 * Class Router determines which controller should be invoked by examining the current URI request.
 * @package PhpMicroframework\Framework
 */
class Router
{
    /**
     * Controller name parsed from request.
     * @var string
     */
    public static string $controller = '';

    /**
     * Default controller name when not parsed from request.
     * @var string
     */
    public static string $defaultController = '';

    /**
     * Method name parsed from request.
     * @var string
     */
    public static string $method = '';

    /**
     * Default method name when not parsed from request.
     * @var string
     */
    public static string $defaultMethod = 'main';

    /**
     * Controller method arguments.
     * @var array
     */
    public static array $arguments = [];

    /**
     * The namespaces to search for matching controllers.
     * @var array
     */
    public static array $namespaces = [];

    /**
     * Determine the appropriate controller, method, and arguments from the current request.
     */
    public static function current(): void
    {
        $current = static::getRequestPath();

        $parts = array();

        if (strlen($current) > 0) {
            $parts = explode('/', $current);
        }

        if (empty($parts)) {
            static::$controller = static::$defaultController;
        } else {
            $controller = ucfirst(strtolower(array_shift($parts)));

            foreach (static::$namespaces as $namespace) {
                $controllerClass = $namespace . '\\' . $controller . 'Controller';
                if (class_exists($controllerClass)) {
                    static::$controller = $controllerClass;
                    static::$method = array_shift($parts) ?? '';
                    static::$arguments = $parts;
                    break;
                }
            }
        }

        if (empty(static::$method)) {
            static::$method = static::$defaultMethod;
        }
    }

    /**
     * Redirect the visitor to another location.
     * @param string $location
     */
    public static function redirect(string $location = '/'): void
    {
        if (!headers_sent()) {
            header('HTTP/1.1 302 Moved Temporarily');
            header("Location: {$location}");
        }

        exit;
    }

    /**
     * Parse the current request path.
     * @return string
     */
    protected static function getRequestPath(): string
    {
        $current = $_SERVER['PHP_SELF'];

        // Remove dot paths
        $current = preg_replace('#\.[\s./]*/#', '', $current);

        // Remove leading and redundant slashes.
        $current = ltrim($current, '/');
        $current = preg_replace('#//+#', '/', $current);

        // Remove front controller from URI if present (depends on variable used)
        $frontController = 'index.php';
        if (substr($current, 0, (strlen($frontController))) == $frontController) {
            $current = substr($current, (strlen($frontController)));
        }

        return trim($current, '/');
    }
}
