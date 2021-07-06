<?php declare(strict_types=1);

namespace PhpMicroframework\Controller;

use PhpMicroframework\Controller\Response\HtmlResponse;
use PhpMicroframework\Controller\Response\ResponseInterface;

class NotFoundController extends AbstractController
{
    public function main(): ResponseInterface
    {
        header('HTTP/1.0 404 Not Found');
        $context = <<<HTML
        <html>
        <head>
            <title>Not Found</title>
        </head>
        <body>
            <h1>Not Found</h1>
            <p>The requested resource was not found on this server. Please check the URL and try again.</p>
        </body>
        </html>
        HTML;

        return new HtmlResponse($context);
    }
}