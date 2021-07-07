<?php

namespace PhpMicroframework\Framework\Controller;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

/**
 * Class TemplateController provides abstraction for Twig template renders in controllers.
 * @package PhpMicroframework\Framework\Controller
 */
class TemplateController implements ControllerInterface
{
    /**
     * Render twig template using context.
     * @param string $template
     * @param array $context
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function render(string $template, array $context = []): string
    {
        $templatePath = dirname(__DIR__, 3) . '/templates';
        $loader = new FilesystemLoader($templatePath);
        $twig = new Environment($loader);

        return $twig->render($template, $context);
    }
}