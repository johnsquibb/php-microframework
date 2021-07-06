<?php declare(strict_types=1);

namespace PhpMicroframework\Controller;

use PhpMicroframework\Controller\Response\HtmlResponse;
use PhpMicroframework\Controller\Response\ResponseInterface;
use stdClass;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ErrorController extends AbstractController
{
    public function __construct(private stdClass $debugger)
    {
    }

    public function main(): ResponseInterface
    {
        header('HTTP/1.1 500 Internal Server Error');

        $templatePath = dirname(dirname(__DIR__)) . '/templates';
        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);
        $html = $twig->render('core/error.html.twig', ['debug' => print_r($this->debugger, true)]);

        return new HtmlResponse($html);
    }
}