<?php declare(strict_types=1);

namespace PhpMicroframework\Application\Controller;

use PhpMicroframework\Framework\Controller\Response\HtmlResponse;
use PhpMicroframework\Framework\Controller\Response\JsonResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;
use PhpMicroframework\Framework\Controller\TemplateController;

class DemoController extends TemplateController
{
    public function hello(): ResponseInterface
    {
        $html = $this->render('demo/main.html.twig', []);

        return new HtmlResponse($html);
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

    public function error(): void
    {
        throw new \Exception("This is a sample error message");
    }
}