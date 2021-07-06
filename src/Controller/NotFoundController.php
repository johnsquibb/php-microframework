<?php declare(strict_types=1);

namespace PhpMicroframework\Controller;

use PhpMicroframework\Controller\Response\HtmlResponse;
use PhpMicroframework\Controller\Response\ResponseInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class NotFoundController extends AbstractController
{
    public function main(): ResponseInterface
    {
        header('HTTP/1.0 404 Not Found');

        $templatePath = dirname(dirname(__DIR__)) . '/templates';
        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);
        $html = $twig->render('core/not-found.html.twig');

        return new HtmlResponse($html);
    }
}