<?php declare(strict_types=1);

namespace PhpMicroframework\Controller;

use PhpMicroframework\Controller\Response\HtmlResponse;
use PhpMicroframework\Controller\Response\JsonResponse;
use PhpMicroframework\Controller\Response\ResponseInterface;

class CoreController extends AbstractController
{
    public function json(): ResponseInterface
    {
        return new JsonResponse(
            [
                'controller' => self::class,
                'method' => __FUNCTION__,
                'message' => 'PHP Microframework'
            ]
        );
    }

    public function params(string ...$parameters): ResponseInterface
    {
        return new JsonResponse(
            [
                'controller' => self::class,
                'method' => __FUNCTION__,
                'message' => 'PHP Microframework',
                'parameters' => $parameters,
            ]
        );
    }

    public function main(): ResponseInterface
    {
        $context = <<<HTML
        <html>
        <head>
            <title>PHP Microframework</title>
        </head>
        <body>
            <h1>Hello</h1>
            <p>This output is generated by CoreController::main()</p>
            <p>Click <a href="/core/json">here</a> to view an example of JSON output.</p>
            <p>Click <a href="/core/params/a/b/c">here</a> to view an example of sending parameters to a controller.</p>
            <p>Click <a href="/core/error">here</a> to view an example of 500 error output.</p>
            <p>Click <a href="/core/not-found">here</a> to view an example of 404 error output.</p>
        </body>
        </html>
        HTML;

        return new HtmlResponse($context);
    }

    public function error(): void
    {
        throw new \Exception("Example of an error.");
    }
}