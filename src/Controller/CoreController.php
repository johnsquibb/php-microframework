<?php declare(strict_types=1);

namespace PhpMicroframework\Controller;

use PhpMicroframework\Controller\Response\HtmlResponse;
use PhpMicroframework\Controller\Response\JsonResponse;
use PhpMicroframework\Controller\Response\ResponseInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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
        $templatePath = dirname(dirname(__DIR__)) . '/templates';
        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);
        $html = $twig->render('demo/main.html.twig', []);

        return new HtmlResponse($html);
    }

    public function error(): void
    {
        throw new \Exception("Example of an error.");
    }
}