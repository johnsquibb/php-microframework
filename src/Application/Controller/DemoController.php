<?php declare(strict_types=1);

namespace PhpMicroframework\Application\Controller;

use PhpMicroframework\Framework\Controller\AbstractController;
use PhpMicroframework\Framework\Controller\Response\HtmlResponse;
use PhpMicroframework\Framework\Controller\Response\JsonResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class DemoController extends AbstractController
{
    public function hello(): ResponseInterface
    {
        $templatePath = dirname(dirname(dirname(__DIR__))) . '/templates';
        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);
        $html = $twig->render('demo/main.html.twig', []);

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