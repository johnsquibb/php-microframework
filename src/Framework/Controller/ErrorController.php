<?php declare(strict_types=1);

namespace PhpMicroframework\Framework\Controller;

use PhpMicroframework\Framework\Controller\Response\HtmlResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;
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

        $templatePath = dirname(dirname(dirname(__DIR__))) . '/templates';
        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);
        $html = $twig->render('core/error.html.twig', ['debug' => print_r($this->debugger, true)]);

        return new HtmlResponse($html);
    }
}