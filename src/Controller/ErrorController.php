<?php declare(strict_types=1);

namespace PhpMicroframework\Controller;

use PhpMicroframework\Controller\Response\HtmlResponse;
use PhpMicroframework\Controller\Response\ResponseInterface;
use stdClass;

class ErrorController extends AbstractController
{
    public function __construct(private stdClass $debugger)
    {
    }

    public function main(): ResponseInterface
    {
        header('HTTP/1.1 500 Internal Server Error');

        $debugOutput = '';
        if (defined('DEBUG') && DEBUG === true) {
            $debugOutput = print_r((array)$this->debugger, true);
        }

        $context = <<<HTML
        <html>
        <head>
            <title>Server Error</title>
        </head>
        <body>
            <h1>Server Error</h1>
            <p>There was a problem while executing the request.</p>
            <pre>$debugOutput</pre>
        </body>
        </html>
        HTML;

        return new HtmlResponse($context);
    }
}