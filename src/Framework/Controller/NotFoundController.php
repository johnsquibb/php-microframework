<?php declare(strict_types=1);

namespace PhpMicroframework\Framework\Controller;

use PhpMicroframework\Framework\Controller\Response\HtmlResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class NotFoundController handles the display of 404 Page Not Found errors.
 * @package PhpMicroframework\Framework\Controller
 */
class NotFoundController extends AbstractController
{
    public function main(): ResponseInterface
    {
        header('HTTP/1.0 404 Not Found');

        $templatePath = dirname(dirname(dirname(__DIR__))) . '/templates';
        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);
        $html = $twig->render('core/not-found.html.twig');

        return new HtmlResponse($html);
    }
}