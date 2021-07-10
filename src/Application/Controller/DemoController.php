<?php

declare(strict_types=1);

namespace PhpMicroframework\Application\Controller;

use Exception;
use PhpMicroframework\Framework\Controller\Response\HtmlResponse;
use PhpMicroframework\Framework\Controller\Response\JsonResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;
use PhpMicroframework\Framework\Controller\TemplateController;
use PhpMicroframework\Framework\Router;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class DemoController showcases some of the framework features after install.
 * Use this controller as a starting point, or remove it after installation.
 * @package PhpMicroframework\Application\Controller
 */
class DemoController extends TemplateController
{
    /**
     * Welcome page.
     * @return ResponseInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function hello(): ResponseInterface
    {
        $html = $this->render('demo/main.html.twig', []);

        return new HtmlResponse($html);
    }

    /**
     * Demonstrates JSON output with input parameters.
     * @param string ...$parameters
     * @return ResponseInterface
     */
    public function json(string ...$parameters): ResponseInterface
    {
        return new JsonResponse(
            [
                'controller' => self::class,
                'method' => __FUNCTION__,
                'message' => 'JSON Response with input parameters',
                'parameters' => $parameters,
            ]
        );
    }

    /**
     * Demonstrates error display.
     * @throws Exception
     */
    public function error(): void
    {
        throw new Exception("This is a sample error message");
    }

    /**
     * Demonstrates complex URL segments and redirects.
     * @param string ...$segments
     * @return ResponseInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function nested(string ...$segments): ResponseInterface
    {
        if ($segments === ['show', 'json', 'example']) {
            return $this->json(...$segments);
        }

        if ($segments === ['show', 'home', 'page']) {
            return $this->hello();
        }

        if ($segments === ['display-some-errors']) {
            $this->error();
        }

        // 302 Redirect to default page.
        Router::redirect('/');
    }
}
