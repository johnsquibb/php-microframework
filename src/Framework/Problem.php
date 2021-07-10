<?php

namespace PhpMicroframework\Framework;

use PhpMicroframework\Framework\Controller\ErrorController;
use stdClass;

/**
 * Class Problem handles errors that occur during framework execution.
 * @package PhpMicroframework\Framework
 */
final class Problem
{
    private static bool $displayErrorsEnabled = false;


    /**
     * Capture and format error for display.
     */
    public static function handler(): void
    {
        if (!error_reporting()) {
            return;
        }

        // Exceptions will contain only an object
        $args = func_get_args();

        // Build debugger
        $debugger = new stdClass();

        try {
            switch (count($args)) {
                // Errors will supply 2-5 parameters
                case 5:
                    $debugger->context = $args[4];
                    // no break
                case 4:
                    $debugger->line_number = $args[3];
                    // no break
                case 3:
                    $debugger->file_name = $args[2];
                    // no break
                case 2:
                    $debugger->message = $args[1];
                    $debugger->error_type = self::getErrorType($args[0]);
                    $debugger->backtrace = debug_backtrace();
                    break;
                // Exceptions will supply only an object
                case 1:
                    $exception = $args[0];
                    $debugger->message = $exception->getMessage();
                    $debugger->file_name = $exception->getFile();
                    $debugger->line_number = $exception->getLine();
                    $debugger->error_type = get_class($exception);
                    $debugger->backtrace = $exception->getTrace();
                    break;
                default:
                    $debugger->message = 'Invalid argument count supplied to Framework Exception handler.';
            }

            // Flush any open output buffers. We only want to see errors.
            ob_get_clean();
        } catch (\Exception $e) {
            $debugger->message = "Error in framework error handler: " . $e->getMessage();
        } finally {
            $debugger->displayErrors = self::$displayErrorsEnabled;
            $controller = new ErrorController($debugger);
            Core::render($controller->main());
        }
    }

    /**
     * Return the string representation for supplied PHP error constant.
     *
     * @param $errorNumber
     * @return string $type
     */
    private static function getErrorType($errorNumber): string
    {
        // Display custom error type. We group similar types.
        return match ($errorNumber) {
            E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR => 'Fatal Error',
            E_WARNING, E_CORE_WARNING, E_COMPILE_WARNING, E_USER_WARNING => 'Warning',
            E_PARSE => 'Parse Error',
            E_NOTICE, E_USER_NOTICE => 'Notice',
            E_STRICT => 'Strict Error',
            E_RECOVERABLE_ERROR => 'Recoverable Error',
            E_DEPRECATED, E_USER_DEPRECATED => 'Deprecated',
            default => 'Unknown Error',
        };
    }

    /**
     * Set whether to display error messages in output.
     * @param bool $displayErrorsEnabled
     */
    public static function setDisplayErrorsEnabled(bool $displayErrorsEnabled): void
    {
        self::$displayErrorsEnabled = $displayErrorsEnabled;
    }
}
