<?php

declare(strict_types=1);

namespace PhpMicroframework\Framework\Controller;

use PhpMicroframework\Framework\Controller\Response\HtmlResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;

/**
 * Class NotFoundController handles the display of 404 Page Not Found errors.
 * @package PhpMicroframework\Framework\Controller
 */
class NotFoundController extends TemplateController
{
    public function main(): ResponseInterface
    {
        header('HTTP/1.0 404 Not Found');

        $html = $this->render('core/not-found.html.twig');

        return new HtmlResponse($html);
    }
}
